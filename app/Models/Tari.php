<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tari extends Model
{
    use HasFactory;

    protected $table = 'tari';

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'gambar',
    ];
}
