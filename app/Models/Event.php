<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'banner',
        'location',
        'start_date',
        'end_date',
        'event_start_date',
        'event_end_date',
        'price',
        'strike_price',
        'quota',
        'available_quota', // Penting untuk logika locking/pengurangan stok
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'event_start_date' => 'datetime',
        'event_end_date' => 'datetime',
        'is_active' => 'boolean',
        'price' => 'integer',
        'strike_price' => 'integer',
        'quota' => 'integer',
        'available_quota' => 'integer',
    ];

    public function orders()
    {
        return $this->hasMany(EventOrder::class);
    }
}
