<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [ 
        'name',
        'merk',
        'jasa_pengiriman',
        'berat',
        'alamat',
        'qty',
        'harga',   
    ];

    protected $casts = [
        'berat' => 'integer',
        'qty'=> 'integer',
        'harga'=> 'integer',
    ];   
}
