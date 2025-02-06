<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motors extends Model
{
    use HasFactory;

    protected $table = 'motors';
    protected $fillable = [
        'nama',
        'merk',
        'harga',
        'jenis',
        'kecepatan'
    ];

    protected $casts = [
        'harga' => 'integer'
    ];
}
