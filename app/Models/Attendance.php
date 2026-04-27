<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    protected $fillable = [
        'registration_id',
        'status_kehadiran',
        'waktu_kehadiran',
    ];

    protected $casts = [
        'waktu_kehadiran' => 'datetime',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}