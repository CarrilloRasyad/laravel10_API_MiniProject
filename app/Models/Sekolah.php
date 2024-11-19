<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $table = 'sekolah';

    protected $fillable = [
        'nama_guru',
        'email',
        'NUPTK',
        'umur',
        'jenis_kelamin',
        'wali_kelas',
        'matpel',
        'gaji',
        'alamat'

    ];
}
