<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nim',
        'email',
        'password',
        'rfid_uid',
        'department_id',
        'position_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Check if user has access to secretary features (Ketua, Wakil Ketua, Sekertaris)
     */
    public function hasSecretaryAccess(): bool
    {
        return $this->position && in_array($this->position->name, ['Ketua', 'Wakil Ketua', 'Sekertaris']);
    }

    /**
     * Check if user has access to treasurer features (Ketua, Wakil Ketua, Bendahara)
     */
    public function hasTreasurerAccess(): bool
    {
        return $this->position && in_array($this->position->name, ['Ketua', 'Wakil Ketua', 'Bendahara']);
    }

    /**
     * Check if user has access to schedule management (BPH members and Koordinator)
     */
    public function hasScheduleManagementAccess(): bool
    {
        if (!$this->position || !$this->department) {
            return false;
        }

        // Check if user is from BPH department
        $isBPH = $this->department->name === 'Badan Pengurus Harian';
        
        // Check if user has Koordinator position
        $isKoordinator = $this->position->name === 'Koordinator';

        return $isBPH || $isKoordinator;
    }

    /**
     * Check if user has access to organizational structure (Ketua, Wakil Ketua)
     */
    public function hasOrganizationalAccess(): bool
    {
        return $this->position && in_array($this->position->name, ['Ketua', 'Wakil Ketua']);
    }

    /**
     * Check if user has access to attendance reports (Ketua, Wakil Ketua, Sekertaris)
     */
    public function hasAttendanceReportAccess(): bool
    {
        return $this->position && in_array($this->position->name, ['Ketua', 'Wakil Ketua', 'Sekertaris']);
    }

    /**
     * Check if user has access to Kominfo features (Ketua, Wakil Ketua, All Kominfo Department Members)
     */
    public function hasKominfoAccess(): bool
    {
        // Check if user has BPH positions (Ketua, Wakil Ketua)
        if ($this->position && in_array($this->position->name, ['Ketua', 'Wakil Ketua'])) {
            return true;
        }

        // Check if user is from Kominfo department
        if ($this->department && str_contains(strtolower($this->department->name), 'kominfo')) {
            return true;
        }

        return false;
    }
}
