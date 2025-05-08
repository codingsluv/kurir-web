<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $fillable = [
        'user_id', 'tanggal', 'jam_masuk', 'jam_pulang', 'status'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}