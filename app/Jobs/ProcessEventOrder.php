<?php

namespace App\Jobs;

use App\Models\Event;
use App\Models\EventOrder;
use App\Models\EventAttendee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProcessEventOrder implements ShouldQueue
{
    use Queueable;

    public $tries = 3;
    public $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $eventId,
        public string $buyerName,
        public string $buyerEmail,
        public string $buyerPhone,
        public int $quantity,
        public ?int $paymentMethodId,
        public ?string $paymentProofPath,
        public int $totalAmount,
        public array $attendeeNames
    ) {
        //
    }

    /**
     * Execute the job with pessimistic locking to prevent race conditions.
     */
    public function handle(): void
    {
        try {
            DB::transaction(function () {
                // Lock the event row for update to prevent concurrent access
                $event = Event::where('id', $this->eventId)
                    ->lockForUpdate()
                    ->first();

                if (!$event) {
                    throw new \Exception('Event tidak ditemukan.');
                }

                // Check available quota with locked row
                if ($this->quantity > $event->available_quota) {
                    throw new \Exception('Kuota tiket tidak mencukupi. Hanya tersisa ' . $event->available_quota . ' tiket.');
                }

                // Generate unique invoice code
                $invoiceCode = $this->generateUniqueInvoiceCode();

                // Create order
                $order = EventOrder::create([
                    'invoice_code' => $invoiceCode,
                    'event_id' => $this->eventId,
                    'buyer_name' => $this->buyerName,
                    'buyer_email' => $this->buyerEmail,
                    'buyer_phone' => $this->buyerPhone,
                    'quantity' => $this->quantity,
                    'payment_method_id' => $this->paymentMethodId,
                    'payment_proof' => $this->paymentProofPath,
                    'total_amount' => $this->totalAmount,
                    'status' => 'pending',
                ]);

                // Create attendees with unique ticket codes
                foreach ($this->attendeeNames as $attendeeName) {
                    $ticketCode = $this->generateUniqueTicketCode();

                    EventAttendee::create([
                        'event_order_id' => $order->id,
                        'ticket_code' => $ticketCode,
                        'name' => $attendeeName,
                        'is_checked_in' => false,
                    ]);
                }

                // Update quota atomically
                $event->decrement('available_quota', $this->quantity);

                // Log successful order creation
                Log::info('Order created successfully', [
                    'invoice_code' => $invoiceCode,
                    'event_id' => $this->eventId,
                    'quantity' => $this->quantity,
                ]);

                // TODO: Send email notification to buyer
                // TODO: Send notification to admin
            });
        } catch (\Exception $e) {
            // Log the error
            Log::error('Order processing failed', [
                'event_id' => $this->eventId,
                'buyer_email' => $this->buyerEmail,
                'error' => $e->getMessage(),
            ]);

            // Delete uploaded payment proof if order fails
            if ($this->paymentProofPath && Storage::disk('public')->exists($this->paymentProofPath)) {
                Storage::disk('public')->delete($this->paymentProofPath);
            }

            // Re-throw to mark job as failed
            throw $e;
        }
    }

    /**
     * Generate unique invoice code (HMIFTIX-XXXXX-YYYYMMDD)
     */
    private function generateUniqueInvoiceCode(): string
    {
        do {
            $code = 'HMIFTIX-' . strtoupper(substr(uniqid(), -5)) . '-' . date('Ymd');
            $exists = EventOrder::where('invoice_code', $code)->exists();
        } while ($exists);

        return $code;
    }

    /**
     * Generate unique ticket code (6 characters: uppercase letters and numbers)
     */
    private function generateUniqueTicketCode(): string
    {
        do {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $ticketCode = '';

            for ($i = 0; $i < 6; $i++) {
                $ticketCode .= $characters[random_int(0, strlen($characters) - 1)];
            }

            $exists = EventAttendee::where('ticket_code', $ticketCode)->exists();
        } while ($exists);

        return $ticketCode;
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('Order processing job failed permanently', [
            'event_id' => $this->eventId,
            'buyer_email' => $this->buyerEmail,
            'error' => $exception->getMessage(),
        ]);

    }
}
