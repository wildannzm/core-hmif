<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncomeLetter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'letter_number',    // nomor surat
        'received_date',    // tanggal terima
        'execution_date',   // tanggal pelaksanaan
        'sender',          // pengirim
        'recipient',       // penerima
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'received_date' => 'date',
        'execution_date' => 'date',
    ];
}
