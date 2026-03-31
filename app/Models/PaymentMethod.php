<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'account_number',
        'account_name',
        'is_active',
        'is_cash',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_cash' => 'boolean',
    ];
}
