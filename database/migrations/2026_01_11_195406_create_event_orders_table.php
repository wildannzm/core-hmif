<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_code')->unique(); // Contoh: TIX-202501-ABC
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            // Jika metode pembayaran dihapus admin, order lama tetap aman (set null)
            $table->foreignId('payment_method_id')->nullable()->constrained()->nullOnDelete();

            // Data Pembeli (Buyer) - Guest Checkout
            $table->string('buyer_name');
            $table->string('buyer_email');
            $table->string('buyer_phone'); // Untuk kirim WA

            // Detail Transaksi
            $table->integer('quantity'); // Total tiket yang dibeli
            $table->decimal('total_amount', 12, 2);
            $table->string('payment_proof')->nullable(); // Path gambar bukti transfer

            // Status: pending=baru, verified=lunas/dikirim, rejected=tolak, canceled=batal antri
            $table->enum('status', ['pending', 'verified', 'rejected', 'canceled'])->default('pending');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_orders');
    }
};
