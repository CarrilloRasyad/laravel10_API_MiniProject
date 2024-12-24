<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = "orders";

    protected $fillable = [ 
        'name',
        'alamat',
        'jasa_pengiriman',
        'qty',
        'harga',
    ];
    
    protected $casts = [
        'qty' => 'integer',
        // 'harga'=> 'decimal:2',
     ];
}
