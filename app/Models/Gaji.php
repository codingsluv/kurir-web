<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
     protected $fillable = [
        'user_id',
        'bulan',
        'jumlah_pengantaran',
        'total_ongkir',
        'gaji_driver',
        'pendapatan_aplikasi',
    ];

    // Relasi ke User (Driver)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}