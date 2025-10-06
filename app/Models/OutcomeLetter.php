<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OutcomeLetter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'letter_number',  // nomor surat
        'letter_date',    // tanggal surat
        'sent_to',        // dikirim kepada
        'subject',        // perihal
        'attachments',    // lampiran
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'letter_date' => 'date',
    ];
}
