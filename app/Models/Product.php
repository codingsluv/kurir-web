<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_product',
        'deskripsi',
        'harga',
        'kategori',
        'gambar',
    ];

    public function pengantarans()
    {
        return $this->hasMany(Pengantaran::class);
    }

    public function pesanansThroughPengantaran()
    {
        return $this->hasManyThrough(Pesanan::class, Pengantaran::class);
    }
}
