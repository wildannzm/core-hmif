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
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->boolean('is_cash')->default(false)->after('account_name');
            $table->string('account_number')->nullable()->change();
            $table->string('account_name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->dropColumn('is_cash');
            $table->string('account_number')->nullable(false)->change();
            $table->string('account_name')->nullable(false)->change();
        });
    }
};
