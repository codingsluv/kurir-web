<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'user_id',
        'nama_pemesan',
        'no_telepon',
        'alamat',
        // 'ongkir',
        'status',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}