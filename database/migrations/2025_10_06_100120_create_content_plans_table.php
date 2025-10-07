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
        Schema::create('content_plans', function (Blueprint $table) {
            $table->id();
            $table->date('publish_date');
            $table->string('title');
            $table->string('pillar');
            $table->text('reference')->nullable();
            $table->string('content_type');
            $table->string('goals')->nullable();
            $table->foreignId('executor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('result_url')->nullable();
            $table->foreignId('publisher_id')->nullable()->constrained('users')->onDelete('set null');
            $table->text('caption')->nullable();
            $table->enum('status', ['Progress', 'Approved', 'Revision', 'Declined'])->nullable();
            $table->text('revision_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_plans');
    }
};
