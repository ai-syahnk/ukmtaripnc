<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
