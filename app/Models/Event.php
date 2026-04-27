<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'title',
        'description',
        'event_date',
        'location',
        'quota',
        'ticket_price',
        'poster_url',
    ];

    protected $casts = [
        'event_date'   => 'datetime',
        'ticket_price' => 'decimal:2',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function getRegisteredCountAttribute(): int
    {
        return $this->registrations()->where('status', 'Registered')->count();
    }

    public function getRemainingQuotaAttribute(): int
    {
        return $this->quota - $this->registered_count;
    }

    public function getIsFreeAttribute(): bool
    {
        return $this->ticket_price == 0;
    }
}