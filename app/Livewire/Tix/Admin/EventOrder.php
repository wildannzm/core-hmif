<?php

namespace App\Livewire\Tix\Admin;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\EventOrder as EventOrderModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

#[Title('Pemesanan Event')]
#[Layout('components.layouts.app')]
class EventOrder extends Component
{
    use WithPagination, AuthorizesRequests;

    public $eventId;
    public $search = '';
    public $statusFilter = 'all';
    public $selectedOrder;
    public $processing = false;

    public function mount($eventId)
    {
        // Validate event exists
        $event = Event::findOrFail($eventId);
        $this->eventId = $eventId;

    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function viewPaymentProof($orderId)
    {
        try {
            $this->selectedOrder = EventOrderModel::with(['event', 'paymentMethod', 'attendees'])
                ->findOrFail($orderId);

            $this->dispatch('open-payment-modal');
        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error',
                'title' => 'Error',
                'text' => 'Pesanan tidak ditemukan.'
            ]);
        }
    }

    public function verifyPayment($orderId)
    {
        // Prevent double processing
        if ($this->processing) {
            return;
        }

        $this->processing = true;

        try {
            // Authorization check - only authorized positions can verify
            $user = Auth::user();
            if (!$user->hasRole('bph') &&
                (!$user->position || !in_array($user->position->name, ['Ketua', 'Wakil Ketua', 'Bendahara']))) {
                throw new \Exception('Unauthorized action.');
            }

            DB::beginTransaction();

            $order = EventOrderModel::with('event')->lockForUpdate()->findOrFail($orderId);

            // Validate order status
            if ($order->status !== 'pending') {
                throw new \Exception('Pesanan ini sudah diproses sebelumnya.');
            }

            // Validate payment proof exists if order is not free and not using cash method
            if ($order->total_amount > 0 && (!$order->paymentMethod || !$order->paymentMethod->is_cash) && !$order->payment_proof) {
                throw new \Exception('Bukti pembayaran tidak ditemukan.');
            }

            // Update order status
            $order->update([
                'status' => 'verified'
            ]);

            DB::commit();

            $successMessage = "Pembayaran untuk pesanan {$order->invoice_code} telah diverifikasi.";

            // Close modal and refresh
            $this->selectedOrder = null;
            $this->dispatch('close-payment-modal');

            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Berhasil!',
                'text' => $successMessage
            ]);

            // Refresh the page data
            $this->dispatch('$refresh');

        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatch('alert', [
                'type' => 'error',
                'title' => 'Gagal Memverifikasi',
                'text' => $e->getMessage()
            ]);
        } finally {
            $this->processing = false;
        }
    }

    public function rejectPayment($orderId)
    {
        // Prevent double processing
        if ($this->processing) {
            return;
        }

        $this->processing = true;

        try {
            // Authorization check - only authorized positions can reject
            $user = Auth::user();
            if (!$user->hasRole('bph') &&
                (!$user->position || !in_array($user->position->name, ['Ketua', 'Wakil Ketua', 'Bendahara']))) {
                throw new \Exception('Unauthorized action.');
            }

            DB::beginTransaction();

            $order = EventOrderModel::with('event')->lockForUpdate()->findOrFail($orderId);

            // Validate order status
            if ($order->status !== 'pending') {
                throw new \Exception('Pesanan ini sudah diproses sebelumnya.');
            }

            // Restore event quota
            $order->event->increment('available_quota', $order->quantity);

            // Update order status
            $order->update([
                'status' => 'rejected',
            ]);

            DB::commit();

            // Close modal and refresh
            $this->selectedOrder = null;
            $this->dispatch('close-payment-modal');

            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Berhasil!',
                'text' => "Pesanan {$order->invoice_code} telah ditolak dan kuota dikembalikan."
            ]);

            // Refresh the page data
            $this->dispatch('$refresh');

        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatch('alert', [
                'type' => 'error',
                'title' => 'Gagal Menolak',
                'text' => $e->getMessage()
            ]);
        } finally {
            $this->processing = false;
        }
    }

    public function downloadTickets($orderId)
    {
        try {
            // Authorization check
            $user = Auth::user();
            if (!$user->hasRole('bph') &&
                (!$user->position || !in_array($user->position->name, ['Ketua', 'Wakil Ketua', 'Bendahara']))) {
                $this->dispatch('alert', [
                    'type' => 'error',
                    'title' => 'Unauthorized',
                    'text' => 'You are not authorized to download tickets.'
                ]);
                return;
            }

            $order = EventOrderModel::with(['event', 'attendees'])->findOrFail($orderId);

            if ($order->status !== 'verified') {
                $this->dispatch('alert', [
                    'type' => 'warning',
                    'title' => 'Peringatan',
                    'text' => 'Pesanan belum diverifikasi.'
                ]);
                return;
            }

            // Generate PDF on-the-fly
            $attendees = $order->attendees;

            if ($attendees->isEmpty()) {
                $this->dispatch('alert', [
                    'type' => 'error',
                    'title' => 'Error',
                    'text' => 'Tidak ada attendee untuk pesanan ini.'
                ]);
                return;
            }

            // Generate multi-page PDF for all tickets
            $pdf = $this->generateMultiPageTicketPDF($order);

            return response()->streamDownload(function() use ($pdf) {
                echo $pdf->output();
            }, 'e-tickets - ' . $order->invoice_code . '.pdf', [
                'Content-Type' => 'application/pdf',
            ]);

        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error',
                'title' => 'Error',
                'text' => $e->getMessage()
            ]);
        }
    }

    protected function generateMultiPageTicketPDF($order)
    {
        $tickets = [];

        // Get event banner URL (if exists)
        $eventBannerUrl = null;
        if ($order->event->banner) {
            $bannerPath = storage_path('app/public/' . $order->event->banner);
            if (file_exists($bannerPath)) {
                $eventBannerUrl = $bannerPath;
            }
        }

        // Prepare data for each ticket
        foreach ($order->attendees as $index => $attendee) {
            $ticketCode = $attendee->ticket_code ?? strtoupper(substr(md5($attendee->id . $order->id), 0, 10));

            // Generate QR code with ticket code as primary data
            $qrCodeSvg = QrCode::size(200)
                ->margin(1)
                ->errorCorrection('H')
                ->generate($ticketCode);

            // Convert SVG to base64 data URI
            $qrCodeBase64 = 'data:image/svg+xml;base64,' . base64_encode($qrCodeSvg);

            $tickets[] = [
                'eventBannerUrl' => $eventBannerUrl,
                'eventTitle' => $order->event->title ?? 'EVENT',
                'location' => $order->event->location ?? 'TBA',
                'orderId' => $order->invoice_code,
                'ticketCode' => $ticketCode,
                'eventDate' => \Carbon\Carbon::parse($order->event->event_start_date)->locale('id')->translatedFormat('d M Y'),
                'eventTime' => $this->getEventTime($order),
                'attendeeName' => $attendee->name,
                'category' => $order->event->category ?? 'Tribun A',
                'qrCodeUrl' => $qrCodeBase64,
            ];
        }

        // Generate PDF with A5 size (portrait)
        return Pdf::loadView('pdf.ticket', ['tickets' => $tickets])->setPaper('a5', 'portrait');
    }

    protected function getEventTime($order)
    {
        if (!$order->event->event_start_date) {
            return 'TBA';
        }

        $startTime = \Carbon\Carbon::parse($order->event->event_start_date)->format('H:i');
        $endTime = $order->event->event_end_date ?
                  \Carbon\Carbon::parse($order->event->event_end_date)->format('H:i') : '';

        return $endTime ? "$startTime - $endTime" : $startTime;
    }

    public function sendToWhatsApp($orderId)
    {
        try {
            $order = EventOrderModel::with(['event', 'attendees'])->findOrFail($orderId);

            if ($order->status !== 'verified') {
                $this->dispatch('alert', [
                    'type' => 'warning',
                    'title' => 'Peringatan',
                    'text' => 'Pesanan belum diverifikasi.'
                ]);
                return;
            }

            // Create WhatsApp message
            $phone = preg_replace('/[^0-9]/', '', $order->buyer_phone);
            if (substr($phone, 0, 1) === '0') {
                $phone = '62' . substr($phone, 1);
            }

            $eventDate = \Carbon\Carbon::parse($order->event->event_start_date)->locale('id')->translatedFormat('d F Y');
            $eventTime = $this->getEventTime($order);

            $message = "Halo *{$order->buyer_name}*!\n\n";
            $message .= "Selamat! Pembayaran Anda untuk event *{$order->event->title}* telah *TERVERIFIKASI*\n\n";
            $message .= "*DETAIL PESANAN*\n";
            $message .= "━━━━━━━━━━━━━━━━━━━━\n";
            $message .= "Invoice: {$order->invoice_code}\n";
            $message .= "Jumlah Tiket: {$order->quantity} tiket\n";
            $message .= "Total Bayar: Rp " . number_format($order->total_amount, 0, ',', '.') . "\n";
            $message .= "Tanggal Event: {$eventDate}\n";
            $message .= "Waktu: {$eventTime}\n";
            $message .= "Lokasi: {$order->event->location}\n";
            $message .= "━━━━━━━━━━━━━━━━━━━━\n\n";
            $message .= "*E-TICKET ANDA SUDAH SIAP!*\n";
            $message .= "Silakan download e-ticket Anda\n\n";
            $message .= "*PENTING!*\n";
            $message .= "• Simpan e-ticket ini dengan baik\n";
            $message .= "• Tunjukkan QR Code saat check-in\n";
            $message .= "• Bawa KTP/identitas untuk verifikasi\n";
            $message .= "• E-ticket berlaku untuk {$order->quantity} orang\n\n";
            $message .= "Sampai jumpa di event *{$order->event->title}*! \n";
            $message .= "Terima kasih";

            $waUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

            // Open WhatsApp Web in new tab
            $this->dispatch('open-whatsapp', ['url' => $waUrl]);

        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error',
                'title' => 'Error',
                'text' => $e->getMessage()
            ]);
        }
    }

    public function deleteOrder($orderId)
    {
        // Prevent double processing
        if ($this->processing) {
            return;
        }

        $this->processing = true;

        try {
            // Authorization check
            $user = Auth::user();
            if (!$user->hasRole('bph') &&
                (!$user->position || !in_array($user->position->name, ['Ketua', 'Wakil Ketua', 'Bendahara']))) {
                throw new \Exception('Unauthorized action.');
            }

            DB::beginTransaction();

            $order = EventOrderModel::findOrFail($orderId);

            // Validate order status
            if ($order->status !== 'rejected') {
                throw new \Exception('Hanya pesanan yang ditolak yang dapat dihapus.');
            }

            // Delete payment proof if exists to save storage
            if ($order->payment_proof) {
                // Delete from public disk (storage/app/public)
                if (Storage::disk('public')->exists($order->payment_proof)) {
                    Storage::disk('public')->delete($order->payment_proof);
                }

                // Delete from local disk (storage/app) - fallback
                if (Storage::disk('local')->exists($order->payment_proof)) {
                    Storage::disk('local')->delete($order->payment_proof);
                }

                // Also try default disk if different
                if (Storage::exists($order->payment_proof)) {
                    Storage::delete($order->payment_proof);
                }
            }

            // Perform deletion
            $order->delete();

            DB::commit();

            // Close modal if open
            $this->selectedOrder = null;
            $this->dispatch('close-payment-modal');

            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Pesanan telah dihapus.'
            ]);

            // Refresh the page data
            $this->dispatch('$refresh');

        } catch (\Exception $e) {
            DB::rollBack();

            $this->dispatch('alert', [
                'type' => 'error',
                'title' => 'Gagal Menghapus',
                'text' => $e->getMessage()
            ]);
        } finally {
            $this->processing = false;
        }
    }

    public function render()
    {
        $query = EventOrderModel::with(['event', 'paymentMethod', 'attendees'])
            ->where('event_id', $this->eventId)
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('invoice_code', 'like', '%' . $this->search . '%')
                        ->orWhere('buyer_name', 'like', '%' . $this->search . '%')
                        ->orWhere('buyer_email', 'like', '%' . $this->search . '%')
                        ->orWhereHas('event', function ($q) {
                            $q->where('title', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->statusFilter !== 'all', function ($q) {
                $q->where('status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc');

        $orders = $query->paginate(10);

        $stats = [
            'total' => EventOrderModel::where('event_id', $this->eventId)->count(),
            'pending' => EventOrderModel::where('event_id', $this->eventId)->where('status', 'pending')->count(),
            'verified' => EventOrderModel::where('event_id', $this->eventId)->where('status', 'verified')->count(),
            'rejected' => EventOrderModel::where('event_id', $this->eventId)->where('status', 'rejected')->count(),
        ];

        return view('livewire.tix.admin.event-order', [
            'orders' => $orders,
            'stats' => $stats,
        ]);
    }
}
