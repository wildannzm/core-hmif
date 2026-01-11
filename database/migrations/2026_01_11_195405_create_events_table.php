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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // Untuk URL ramah (seo-friendly)
            $table->text('description')->nullable();
            $table->string('banner')->nullable(); // Path gambar banner
            $table->string('location');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();

            $table->decimal('price', 12, 2)->default(0);
            $table->integer('quota')->default(0); // Kuota Total
            $table->integer('available_quota')->default(0); // Kuota Tersedia (Untuk Locking)

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
