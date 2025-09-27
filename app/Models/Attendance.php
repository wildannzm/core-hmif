<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'tap_time',
        'status',
        'lateness_duration_minutes',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'tap_time' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }
}
