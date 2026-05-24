<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';

    protected $fillable = [
        'registration_id',
        'status_kehadiran',
        'waktu_kehadiran',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
