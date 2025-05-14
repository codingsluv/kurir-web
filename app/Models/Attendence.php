<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    protected $table = 'attendences'; 
    protected $fillable = [
        'driver_id',
        'tanggal',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];


    /**
     * Get the driver that owns the attendance record.
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
