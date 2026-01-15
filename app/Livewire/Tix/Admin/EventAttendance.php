<?php

namespace App\Livewire\Tix\Admin;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EventAttendee;
use Livewire\Attributes\Title;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

#[Title('Kehadiran Event')]
#[Layout('components.layouts.app')]
class EventAttendance extends Component
{
    use WithPagination;

    public $eventId;
    public $event;
    public $showModal = false;
    public $scanMode = 'qr'; // qr or manual
    public $ticketCode = '';
    public $digit1 = '';
    public $digit2 = '';
    public $digit3 = '';
    public $digit4 = '';
    public $digit5 = '';
    public $digit6 = '';
    public $search = '';
    public $filterStatus = 'all'; // all, checked_in, not_checked_in

    protected $queryString = [
        'search' => ['except' => ''],
        'filterStatus' => ['except' => 'all'],
    ];

    public function mount($eventId)
    {
        $this->eventId = $eventId;
        $this->event = Event::findOrFail($eventId);
    }

    public function openModal($mode = 'qr')
    {
        $this->scanMode = $mode;
        $this->showModal = true;
        $this->resetTicketInput();
        
        // Dispatch event for JavaScript to listen
        $this->dispatch('show-modal');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetTicketInput();
        $this->dispatch('close-modal');
    }

    public function resetTicketInput()
    {
        $this->ticketCode = '';
        $this->digit1 = '';
        $this->digit2 = '';
        $this->digit3 = '';
        $this->digit4 = '';
        $this->digit5 = '';
        $this->digit6 = '';
    }

    public function scanQRCode($code)
    {
        // Extract ticket code from QR code (might be a URL or just the code)
        $ticketCode = $this->extractTicketCode($code);
        
        if ($ticketCode) {
            $this->checkInAttendee($ticketCode);
        } else {
            $this->dispatch('show-alert', [
                'type' => 'error',
                'title' => 'Gagal!',
                'message' => 'QR Code tidak valid!'
            ]);
        }
    }

    private function extractTicketCode($code)
    {
        // Clean the code - remove whitespace and sanitize
        $code = trim(strip_tags($code));
        
        // Prevent XSS attacks
        $code = htmlspecialchars($code, ENT_QUOTES, 'UTF-8');
        
        // If it's a URL, extract the code from it
        if (filter_var($code, FILTER_VALIDATE_URL)) {
            // Try to extract ticket code from URL parameters
            $parts = parse_url($code);
            parse_str($parts['query'] ?? '', $params);
            return $params['ticket'] ?? $params['code'] ?? null;
        }
        
        // If it's 6 characters alphanumeric (like S4JX13), return it
        if (preg_match('/^[A-Z0-9]{6}$/i', $code)) {
            return strtoupper($code);
        }
        
        // If it's just 6 digits, return it
        if (preg_match('/^\d{6}$/', $code)) {
            return $code;
        }
        
        // Try to find 6-character alphanumeric code in the string
        if (preg_match('/[A-Z0-9]{6}/i', $code, $matches)) {
            return strtoupper($matches[0]);
        }
        
        return null;
    }

    public function updatedDigit1($value)
    {
        if (strlen($value) === 1) {
            $this->dispatch('focus-digit', digit: 2);
        }
    }

    public function updatedDigit2($value)
    {
        if (strlen($value) === 1) {
            $this->dispatch('focus-digit', digit: 3);
        }
    }

    public function updatedDigit3($value)
    {
        if (strlen($value) === 1) {
            $this->dispatch('focus-digit', digit: 4);
        }
    }

    public function updatedDigit4($value)
    {
        if (strlen($value) === 1) {
            $this->dispatch('focus-digit', digit: 5);
        }
    }

    public function updatedDigit5($value)
    {
        if (strlen($value) === 1) {
            $this->dispatch('focus-digit', digit: 6);
        }
    }

    public function updatedDigit6($value)
    {
        if (strlen($value) === 1) {
            $this->submitTicketCode();
        }
    }

    public function submitTicketCode()
    {
        $fullCode = strtoupper($this->digit1 . $this->digit2 . $this->digit3 . $this->digit4 . $this->digit5 . $this->digit6);

        if (strlen($fullCode) !== 6) {
            session()->flash('error', 'Kode tiket harus 6 karakter');
            return;
        }

        $this->checkInAttendee($fullCode);
    }

    public function checkInAttendee($ticketCode)
    {
        // Validate ticket code format (6 alphanumeric characters)
        if (!preg_match('/^[A-Z0-9]{6}$/i', $ticketCode)) {
            $this->closeModal();
            $this->resetTicketInput();
            $this->dispatch('$refresh');
            $this->dispatch('show-alert', [
                'type' => 'error',
                'title' => 'Gagal!',
                'message' => 'Format kode tiket tidak valid!'
            ]);
            return;
        }
        
        $ticketCode = strtoupper($ticketCode);
        
        DB::beginTransaction();
        try {
            // Find attendee by ticket code and ensure it belongs to current event with verified payment
            $attendee = EventAttendee::where('ticket_code', $ticketCode)
                ->whereHas('order', function($query) {
                    $query->where('event_id', $this->eventId)
                          ->where('status', 'verified');
                })
                ->first();

            if (!$attendee) {
                DB::rollBack();
                
                // Close modal and stop camera
                $this->closeModal();
                $this->resetTicketInput();
                
                // Refresh component
                $this->dispatch('$refresh');
                
                // Show error alert
                $this->dispatch('show-alert', [
                    'type' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'Kode tiket tidak valid atau pembayaran belum diverifikasi!'
                ]);
                return;
            }

            if ($attendee->is_checked_in) {
                DB::rollBack();
                
                // Close modal and stop camera
                $this->closeModal();
                $this->resetTicketInput();
                
                // Refresh component
                $this->dispatch('$refresh');
                
                // Show warning alert
                $this->dispatch('show-alert', [
                    'type' => 'warning',
                    'title' => 'Perhatian!',
                    'message' => 'Tiket ini sudah check-in sebelumnya pada ' . $attendee->checked_in_at->format('d M Y H:i')
                ]);
                return;
            }

            $attendee->update([
                'is_checked_in' => true,
                'checked_in_at' => now(),
            ]);

            DB::commit();
            
            // Close modal and stop camera
            $this->closeModal();
            $this->resetTicketInput();
            
            // Refresh component to update statistics and attendee list
            $this->dispatch('$refresh');
            
            // Show success alert
            $this->dispatch('show-alert', [
                'type' => 'success',
                'title' => 'Berhasil!',
                'message' => 'Check-in berhasil! Selamat datang ' . $attendee->name
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Close modal and stop camera
            $this->closeModal();
            $this->resetTicketInput();
            
            // Refresh component
            $this->dispatch('$refresh');
            
            // Show error alert
            $this->dispatch('show-alert', [
                'type' => 'error',
                'title' => 'Error!',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function exportPdf()
    {
        // Authorization check - only authorized positions can export PDF
        $user = Auth::user();
        if (!$user->hasRole('bph') && 
            (!$user->position || !in_array($user->position->name, ['Ketua', 'Wakil Ketua', 'Sekertaris']))) {
            $this->dispatch('swal:error', message: 'Anda tidak memiliki akses untuk export PDF.');
            return;
        }
        
        // Get filtered attendees data (only verified payments)
        $query = EventAttendee::with(['order.event', 'order.paymentMethod'])
            ->whereHas('order', function ($q) {
                $q->where('event_id', $this->eventId)
                  ->where('status', 'verified');
            });

        // Apply search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('ticket_code', 'like', '%' . $this->search . '%');
            });
        }

        // Apply status filter
        if ($this->filterStatus === 'checked_in') {
            $query->where('is_checked_in', true);
        } elseif ($this->filterStatus === 'not_checked_in') {
            $query->where('is_checked_in', false);
        }

        $attendees = $query->orderBy('name', 'asc')->get();

        // Statistics
        $stats = [
            'total' => $attendees->count(),
            'hadir' => $attendees->where('is_checked_in', true)->count(),
            'tidak_hadir' => $attendees->where('is_checked_in', false)->count(),
        ];

        $pdf = Pdf::loadView('pdf.attendance', [
            'event' => $this->event,
            'attendees' => $attendees,
            'stats' => $stats,
            'exportDate' => now()->format('d M Y H:i'),
        ]);

        $filename = 'Daftar-Hadir-' . str_replace(' ', '-', $this->event->title) . '-' . now()->format('Y-m-d') . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }

    public function render()
    {
        // Only show attendees with verified payment orders
        $query = EventAttendee::with(['order.event', 'order.paymentMethod'])
            ->whereHas('order', function ($q) {
                $q->where('event_id', $this->eventId)
                  ->where('status', 'verified');
            });

        // Search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('ticket_code', 'like', '%' . $this->search . '%');
            });
        }

        // Status filter
        if ($this->filterStatus === 'checked_in') {
            $query->where('is_checked_in', true);
        } elseif ($this->filterStatus === 'not_checked_in') {
            $query->where('is_checked_in', false);
        }

        $attendees = $query->orderBy('checked_in_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Statistics (only verified payments)
        $stats = [
            'total' => EventAttendee::whereHas('order', function ($q) {
                $q->where('event_id', $this->eventId)
                  ->where('status', 'verified');
            })->count(),
            'checked_in' => EventAttendee::whereHas('order', function ($q) {
                $q->where('event_id', $this->eventId)
                  ->where('status', 'verified');
            })->where('is_checked_in', true)->count(),
            'not_checked_in' => EventAttendee::whereHas('order', function ($q) {
                $q->where('event_id', $this->eventId)
                  ->where('status', 'verified');
            })->where('is_checked_in', false)->count(),
        ];

        return view('livewire.tix.admin.event-attendance', [
            'attendees' => $attendees,
            'stats' => $stats,
        ]);
    }
}
