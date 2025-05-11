<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengantaran extends Model
{
    protected $fillable = [
        'user_id',
        'nama_pemesan',
        'no_telepon',
        'status',
        'tanggal',
        'alamat',
        'catatan',
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
