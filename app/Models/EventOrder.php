<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_code',
        'event_id',
        'payment_method_id',
        'buyer_name',
        'buyer_email',
        'buyer_phone',
        'quantity',
        'total_amount',
        'payment_proof',
        'status', // pending, verified, rejected, canceled
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function attendees()
    {
        return $this->hasMany(EventAttendee::class);
    }
}
