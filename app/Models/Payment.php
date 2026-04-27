<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'registration_id',
        'amount',
        'payment_status',
        'payment_method',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'amount'     => 'decimal:2',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function getRemainingSecondsAttribute(): int
    {
        if (!$this->expired_at || $this->payment_status !== 'Pending') {
            return 0;
        }
        return max(0, now()->diffInSeconds($this->expired_at, false));
    }
}