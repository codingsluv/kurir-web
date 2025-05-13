<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';
    
    protected $fillable = [
        'nama_pemesan',
        'no_telp',
        'alamat',
        'total_harga',
        'status_pemesanan',
        'ongkir',
    ];

    public function pengantarans()
    {
        return $this->hasMany(Pengantaran::class);
    }

    public function produk()
    {
        return $this->belongsToMany(Product::class, 'pesanan_produk', 'pesanan_id', 'produk_id')
                    ->withPivot('jumlah', 'harga_satuan');
    }

    public function productsThroughPengantaran()
    {
        return $this->hasManyThrough(Product::class, Pengantaran::class);
    }
}
