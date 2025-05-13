<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{

    protected $fillable = [
        'bulan',
        'total_ongkir',
        'total_kas_masuk',
    ];
}