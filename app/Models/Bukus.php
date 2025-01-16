<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukus extends Model
{
    use HasFactory;

    protected $table = 'bukus';

    protected $fillable = [
        'nama_buku',
        'judul',
        'pengarang',
        'tanggal_publikasi'
    ];

    protected $casts = [
        'nama_buku' => 'string',
        'pengarang' => 'string'
    ];
}
