<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Pengantaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GajiController extends Controller
{
    public function index()
    {
        $data = [
            "title" => "Data Gaji",
            "activeGaji" => "active",
            "gajis" => Gaji::with('user')->latest()->get(), // Menampilkan data gaji terbaru di atas
        ];
        return view("admin.gaji.index", $data);
    }

    public function create()
    {
        $data = [
            "title" => "Buat Data Gaji",
            "activeGaji" => "active",
            "users" => User::where('role', 'Driver')->orderBy('name')->get(), // Urutkan nama driver
        ];
        return view("admin.gaji.create", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bulan' => 'required|date_format:Y-m|unique:gajis,bulan,NULL,id,user_id,' . $request->user_id,
        ], [
            'bulan.unique' => 'Data gaji untuk driver ini pada bulan tersebut sudah ada.',
        ]);

        $bulan = Carbon::createFromFormat('Y-m', $request->bulan);

        $pengantarans = Pengantaran::where('user_id', $request->user_id)
            ->where('status', 'Selesai')
            ->whereMonth('tanggal', $bulan->month)
            ->whereYear('tanggal', $bulan->year)
            ->get();

        $jumlah_pengantaran = $pengantarans->count();
        $total_ongkir = $pengantarans->sum('ongkir'); // Mengambil total dari kolom ongkir yang diinput driver

        $gaji_driver = $total_ongkir * 0.7;
        $pendapatan_aplikasi = $total_ongkir * 0.3;

        Gaji::create([
            'user_id' => $request->user_id,
            'bulan' => $request->bulan,
            'jumlah_pengantaran' => $jumlah_pengantaran,
            'total_ongkir' => $total_ongkir,
            'gaji_driver' => $gaji_driver,
            'pendapatan_aplikasi' => $pendapatan_aplikasi,
        ]);

        return redirect()->route('gaji')->with('success', 'Data gaji berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = [
            "title" => "Edit Data Gaji",
            "activeGaji" => "active",
            'gaji'              => Gaji::with('user')->findOrFail($id), // Eager load the 'users' relationship
            'users'             => User::where('role', 'Driver')->orderBy('name')->get(),
        ];
        return view("admin.gaji.edit", $data);
    }

    public function update(Request $request, Gaji $gaji)
    {
        $request->validate([
            'jumlah_pengantaran' => 'required|integer|min:0',
            'total_ongkir' => 'required|numeric|min:0',
        ]);

        $gaji_driver = $request->total_ongkir * 0.7;
        $pendapatan_aplikasi = $request->total_ongkir * 0.3;

        $gaji->update([
            'jumlah_pengantaran' => $request->jumlah_pengantaran,
            'total_ongkir' => $request->total_ongkir,
            'gaji_driver' => $gaji_driver,
            'pendapatan_aplikasi' => $pendapatan_aplikasi,
        ]);

        return redirect()->route('gaji')->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();
        return redirect()->route('gaji')->with('success', 'Data gaji berhasil dihapus.');
    }
}
