<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tari_id',
        'nama_pemesan',
        'alamat_pentas',
        'no_telp',
        'tanggal_tampil',
        'catatan',
        'jumlah_penari',
        'harga_per_penari',
        'total_harga',
        'status',
        'approved_at',
        'payment_deadline',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_tampil' => 'date',
            'jumlah_penari' => 'integer',
            'harga_per_penari' => 'decimal:2',
            'total_harga' => 'decimal:2',
            'approved_at' => 'datetime',
            'payment_deadline' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tari(): BelongsTo
    {
        return $this->belongsTo(Tari::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function latestPayment(): HasOne
    {
        return $this->hasOne(Payment::class)->latestOfMany();
    }

    public function isPaymentExpired(): bool
    {
        if (! $this->payment_deadline) {
            return false;
        }

        return now()->greaterThan($this->payment_deadline);
    }
}
