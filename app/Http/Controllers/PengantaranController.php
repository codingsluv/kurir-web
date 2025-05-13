<?php

namespace App\Http\Controllers;

use App\Models\Pengantaran;
use App\Models\Pesanan;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class PengantaranController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Pengantaran',
            'activePengantaran' => 'active',
            'pengantarans' => Pengantaran::all(),
            'pesanans' => Pesanan::all(),
            'products' => Product::all(),
            'users' => User::where('role', 'Driver')->get()
        );
        return view('admin.pengantaran.index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => 'Tambah Pengantaran',
            'activePengantaran' => 'active',
            'pesanans' => Pesanan::all(),
            'products' => Product::all(),
            'users' => User::where('role', 'Driver')->get()
        );
        return view('admin.pengantaran.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required',
            'user_id' => 'nullable',
            'tanggal_pengiriman' => 'required|date',
            'status_pengantaran' => 'required|in:Menunggu,Dijemput,Dikirim,Selesai,Gagal',
            'tarif_driver' => 'required|numeric|min:0',
        ]);

        $pengantaran = new Pengantaran();
        $pengantaran->pesanan_id = $request->pesanan_id;
        $pengantaran->user_id = $request->user_id;
        $pengantaran->tanggal_pengiriman = $request->tanggal_pengiriman;
        $pengantaran->status_pengantaran = $request->status_pengantaran;
        $pengantaran->tarif_driver = $request->tarif_driver;
        $pengantaran->save();

        return redirect()->route('pengantaran')->with('success', 'Pengantaran berhasil ditambahkan');
    }
}
