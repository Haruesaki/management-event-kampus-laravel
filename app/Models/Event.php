<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'title',
        'category',
        'description',
        'event_date',
        'gates_open',
        'duration',
        'location',
        'google_maps_url',
        'poster_url',
        'is_closed',
    ];

    /**
     * Relasi ke User (Panitia pembuat)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relasi ke Tiket
     */
    public function tickets()
    {
        return $this->hasMany(EventTicket::class);
    }
}
