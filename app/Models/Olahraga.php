<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Olahraga extends Model
{
    use HasFactory;

    protected $table = 'olahraga';
    protected $fillable = [
        'cabor',
        'jenis_olahraga',
        'jumlah_pemain',
        'lokasi_bermain',
        'deskripsi'
    ];
}
