<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    protected $fillable = [
        'driver_id',
        'tanggal',
        'status',
    ];

    /**
     * Get the driver that owns the attendance record.
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
