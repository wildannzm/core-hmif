<?php

namespace App\Livewire\Tix\User;

use App\Models\Event;
use App\Models\EventOrder;
use App\Models\EventAttendee;
use App\Models\PaymentMethod;
use App\Jobs\ProcessEventOrder;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

#[Title('Checkout Event')]
#[Layout('layouts.tix')]
class CheckoutEvent extends Component
{
    use WithFileUploads;

    public Event $event;

    // Step 1: Quantity
    public int $quantity = 1;

    // Step 2: Buyer Info
    public string $buyerName = '';
    public string $buyerEmail = '';
    public string $buyerPhone = '';

    // Step 3: Attendee Details (Dynamic Array)
    public array $attendees = [];

    // Step 4: Payment Method
    public ?int $selectedPaymentMethodId = null;

    // Step 5: Payment Proof
    public $paymentProof = null;

    protected function rules(): array
    {
        return [
            'quantity' => 'required|integer|min:1|max:' . $this->event->available_quota,
            'buyerName' => 'required|string|min:3|max:255',
            'buyerEmail' => 'required|email:rfc,dns|max:255',
            'buyerPhone' => 'required|string|regex:/^[0-9]{10,15}$/|max:20',
            'attendees' => 'required|array|size:' . $this->quantity,
            'attendees.*' => 'required|string|min:3|max:255',
            'selectedPaymentMethodId' => 'required|exists:payment_methods,id',
            'paymentProof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    protected $validationAttributes = [
        'quantity' => 'jumlah tiket',
        'buyerName' => 'nama pembeli',
        'buyerEmail' => 'email',
        'buyerPhone' => 'nomor WhatsApp',
        'attendees.*' => 'nama peserta',
        'selectedPaymentMethodId' => 'metode pembayaran',
        'paymentProof' => 'bukti pembayaran',
    ];

    public function mount(string $slug): void
    {
        $this->event = Event::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Initialize attendees array
        $this->attendees = [''];
    }

    public function updatedQuantity(): void
    {
        // Ensure quantity doesn't exceed available quota
        if ($this->quantity > $this->event->available_quota) {
            $this->quantity = $this->event->available_quota;
        }
        
        // Ensure quantity is at least 1
        if ($this->quantity < 1) {
            $this->quantity = 1;
        }

        // Resize attendees array based on quantity
        $currentCount = count($this->attendees);
        if ($this->quantity > $currentCount) {
            // Add more fields
            for ($i = $currentCount; $i < $this->quantity; $i++) {
                $this->attendees[] = '';
            }
        } elseif ($this->quantity < $currentCount) {
            // Remove excess fields
            $this->attendees = array_slice($this->attendees, 0, $this->quantity);
        }
    }

    public function incrementQuantity(): void
    {
        if ($this->quantity < $this->event->available_quota) {
            $this->quantity++;
            $this->updatedQuantity();
        }
    }

    public function decrementQuantity(): void
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->updatedQuantity();
        }
    }

    public function submit(): void
    {
        // Rate limiting: Prevent spam submissions (max 3 per minute per user IP)
        $key = 'checkout_attempt_' . request()->ip();
        $attempts = cache()->get($key, 0);
        
        if ($attempts >= 3) {
            $this->dispatch('swal:error', 
                message: 'Terlalu banyak percobaan. Silakan tunggu beberapa saat.'
            );
            return;
        }
        
        cache()->put($key, $attempts + 1, now()->addMinutes(1));
        
        $this->validate();

        try {
            // Sanitize inputs to prevent XSS
            $this->buyerName = strip_tags($this->buyerName);
            $this->buyerEmail = filter_var($this->buyerEmail, FILTER_SANITIZE_EMAIL);
            $this->buyerPhone = preg_replace('/[^0-9]/', '', $this->buyerPhone);
            
            foreach ($this->attendees as $key => $name) {
                $this->attendees[$key] = strip_tags(trim($name));
            }
            
            // Refresh event to get latest data
            $this->event->refresh();
            
            // Pre-check quota before dispatching job
            if ($this->quantity > $this->event->available_quota) {
                $this->dispatch('swal:error', 
                    message: 'Maaf, kuota tiket tidak mencukupi. Hanya tersisa ' . $this->event->available_quota . ' tiket.'
                );
                return;
            }

            // Check if event booking period is still valid
            if (now()->lt($this->event->start_date)) {
                $this->dispatch('swal:error', 
                    message: 'Pemesanan tiket belum dibuka. Akan dibuka pada ' . $this->event->start_date->format('d M Y, H:i') . ' WIB.'
                );
                return;
            }

            if (now()->gt($this->event->end_date)) {
                $this->dispatch('swal:error', 
                    message: 'Pemesanan tiket telah ditutup.'
                );
                return;
            }

            // Verify payment method is still active
            $paymentMethod = PaymentMethod::where('id', $this->selectedPaymentMethodId)
                ->where('is_active', true)
                ->first();

            if (!$paymentMethod) {
                $this->dispatch('swal:error', 
                    message: 'Metode pembayaran tidak valid. Silakan pilih metode pembayaran lain.'
                );
                return;
            }

            // Store payment proof with unique filename
            $paymentProofPath = $this->paymentProof->store('payment-proofs', 'public');
            $totalAmount = $this->event->price * $this->quantity;

            // Generate invoice code for display
            $invoiceCode = 'HMIFTIX-' . strtoupper(substr(uniqid(), -5)) . '-' . date('Ymd');

            // Dispatch job to queue for processing
            ProcessEventOrder::dispatch(
                eventId: $this->event->id,
                buyerName: $this->buyerName,
                buyerEmail: $this->buyerEmail,
                buyerPhone: $this->buyerPhone,
                quantity: $this->quantity,
                paymentMethodId: $this->selectedPaymentMethodId,
                paymentProofPath: $paymentProofPath,
                totalAmount: $totalAmount,
                attendeeNames: $this->attendees
            );

            // Log order submission
            Log::info('Order submitted to queue', [
                'event_id' => $this->event->id,
                'buyer_email' => $this->buyerEmail,
                'quantity' => $this->quantity,
            ]);

            // Show success notification
            $this->dispatch('swal:success', 
                title: 'Pesanan Sedang Diproses!',
                message: 'Pesanan Anda sedang diproses. Anda akan menerima konfirmasi setelah pembayaran diverifikasi oleh admin.',
            );

        } catch (\Exception $e) {
            Log::error('Order submission failed', [
                'event_id' => $this->event->id,
                'buyer_email' => $this->buyerEmail,
                'error' => $e->getMessage(),
            ]);

            $this->dispatch('swal:error', 
                message: 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.'
            );
        }
    }

    public function render()
    {
        $paymentMethods = PaymentMethod::where('is_active', true)->get();

        return view('livewire.tix.user.checkout-event', [
            'paymentMethods' => $paymentMethods,
        ]);
    }
}
