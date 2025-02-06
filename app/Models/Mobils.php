<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobils extends Model
{
    use HasFactory;

    protected $table = 'mobils';

    protected $fillable = [
        'jenis_mobil',
        'nama_mobil',
        'merk',
        'nopol',
        'harga'
    ];


    protected $casts = [
        'harga' => 'integer'
    ];
}
