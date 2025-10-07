<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentPlan extends Model
{
    protected $fillable = [
        'publish_date',
        'title',
        'pillar',
        'reference',
        'content_type',
        'goals',
        'executor_id',
        'result_url',
        'publisher_id',
        'caption',
        'status',
        'revision_notes',
    ];

    protected $casts = [
        'publish_date' => 'date',
    ];

    // Status constants
    const STATUS_PROGRESS = 'Progress';
    const STATUS_APPROVED = 'Approved';
    const STATUS_REVISION = 'Revision';
    const STATUS_DECLINED = 'Declined';

    // Get all available statuses
    public static function getStatuses(): array
    {
        return [
            self::STATUS_PROGRESS,
            self::STATUS_APPROVED,
            self::STATUS_REVISION,
            self::STATUS_DECLINED,
        ];
    }

    // Relationships
    public function executor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'executor_id');
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }

    // Accessors
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PROGRESS => 'blue',
            self::STATUS_APPROVED => 'green',
            self::STATUS_REVISION => 'yellow',
            self::STATUS_DECLINED => 'red',
            default => 'gray'
        };
    }

    public function getFormattedPublishDateAttribute(): string
    {
        return $this->publish_date?->locale('id')->translatedFormat('d F Y') ?? '';
    }

    // Scopes
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByExecutor($query, int $executorId)
    {
        return $query->where('executor_id', $executorId);
    }

    public function scopeByPublisher($query, int $publisherId)
    {
        return $query->where('publisher_id', $publisherId);
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('publish_date', [$startDate, $endDate]);
    }
}
