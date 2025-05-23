<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'deliveries';
    protected $fillable = [
        'order_id',
        'total_ongkir',
        'jenis_pembayaran',
        'bukti_transfer',
        'status_pengantaran',
    ];
    /**
     * Get the order associated with the delivery.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the salary record associated with the delivery.
     */
    public function salary()
    {
        return $this->hasOne(Salary::class);
    }
}
