<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'bukti_pembayaran',
        'nama_pengirim',
        'bank_pengirim',
        'jumlah_transfer',
        'catatan_admin',
        'status',
        'confirmed_at',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_transfer' => 'decimal:2',
            'confirmed_at' => 'datetime',
        ];
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
