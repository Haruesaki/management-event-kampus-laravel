<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'type',
        'price',
        'quota',
    ];

    /**
     * Relasi ke Event
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
