<?php

namespace App\Http\Controllers;

use App\Models\Pengantaran;
use App\Models\Kas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KasController extends Controller
{
    /**
     * Menghitung dan menyimpan data kas bulanan dari 30% total ongkir.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function hitungKasBulanan()
    // {
    //     // Mendapatkan bulan saat ini dalam format YYYY-MM
    //     $bulan = Carbon::now()->format('Y-m');

    //     // Memeriksa apakah data kas untuk bulan ini sudah ada
    //     $kas = Kas::where('bulan', $bulan)->first();

    //     if (!$kas) {
    //         // Jika data kas untuk bulan ini belum ada, hitung 30% dari total ongkir tabel pengantarans untuk bulan ini
    //         $totalOngkir = Pengantaran::where(DB::raw('DATE_FORMAT(tanggal, "%Y-%m")'), $bulan)
    //             ->sum('ongkir');
    //         $kasMasuk = $totalOngkir * 0.3; // Hitung 30% dari total ongkir

    //         // Membuat entri baru di tabel kas
    //         Kas::create([
    //             'bulan' => $bulan,
    //             'total_ongkir' => $totalOngkir,
    //             'total_kas_masuk' => $kasMasuk, // Simpan 30% dari total ongkir
    //         ]);

    //         // Redirect ke halaman index dengan pesan sukses
    //         return redirect()->route('kas.index')->with('success', 'Data kas bulanan berhasil dihitung dan disimpan.');
    //     } else {
    //         // Jika data kas untuk bulan ini sudah ada
    //         return redirect()->route('kas.index')->with('info', 'Data kas untuk bulan ini sudah ada.');
    //     }
    // }

    /**
     * Menampilkan data kas bulanan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mendapatkan semua data kas bulanan dari database, diurutkan dari yang terbaru
        $kasBulanan = Kas::latest()->paginate(12);

        // Mengirimkan data kas bulanan ke view
        $data = [
            "title" => "Data Kas",
            "activeKas" => "active",
            "kasBulanan" => $kasBulanan,
        ];
        return view('admin.kas.index', $data);
    }

    /**
     * Menampilkan detail data kas bulanan.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Mendapatkan data kas bulanan berdasarkan ID
        $kas = Kas::findOrFail($id);

        // Mengirimkan data kas bulanan ke view
         $data = [
            "title" => "Detail Data Kas",
            "kas" => $kas,
        ];
        return view('admin.kas.show', $data);
    }
}