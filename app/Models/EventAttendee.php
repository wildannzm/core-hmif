<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventAttendee extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_order_id',
        'ticket_code',
        'name',
        'is_checked_in',
        'checked_in_at',
    ];

    protected $casts = [
        'is_checked_in' => 'boolean',
        'checked_in_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(EventOrder::class, 'event_order_id');
    }
    
    public function eventOrder()
    {
        return $this->belongsTo(EventOrder::class, 'event_order_id');
    }
}
