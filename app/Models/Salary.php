<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'driver_id',
        'delivery_id',
        'gaji_driver',
        'pendapatan_babang',
        'bulan',
    ];

    /**
     * Get the driver associated with the salary record.
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    /**
     * Get the delivery associated with the salary record.
     */
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}
