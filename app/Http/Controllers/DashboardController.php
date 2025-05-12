<?php

namespace App\Http\Controllers;

use App\Models\Pengantaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import Carbon untuk manipulasi tanggal

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total Pengantaran Hari Ini
        $totalPengantaranHariIni = Pengantaran::whereDate('tanggal', today())->count();

        // 2. Pengantaran Berdasarkan Status
        $statusPengantaran = Pengantaran::select('status', DB::raw('count(*) as jumlah'))
            ->groupBy('status')
            ->get();

        // 3. Total Pendapatan Hari Ini
        $totalPendapatanHariIni = Pengantaran::whereDate('tanggal', today())->sum('ongkir');

        // 4. Performa Driver (Contoh: 5 Driver dengan Pengantaran Terbanyak)
        $performaDriver = User::where('role', 'Driver')
            ->select('name', DB::raw('count(*) as total_pengantaran'))
            ->join('pengantarans', 'users.id', '=', 'pengantarans.user_id')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_pengantaran')
            ->limit(5)
            ->get();

        // 5. Lokasi Pengantaran Terbaru (Contoh: 10 Pengantaran Terbaru)
        $lokasiPengantaranTerbaru = Pengantaran::latest()->take(10)->get();

        // 6. Pertumbuhan Pengguna (Contoh: Pertumbuhan Bulanan dalam 6 Bulan Terakhir)
        $pertumbuhanPengguna = User::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'), DB::raw('count(*) as jumlah_pengguna'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->where('role', '!=', 'Admin') // Tidak termasuk admin
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->get();

        //  // 7. Umpan Balik/Ulasan Terbaru (Asumsi ada kolom 'ulasan' di tabel pengantaran)
        // $umpanBalikTerbaru = Pengantaran::whereNotNull('ulasan')->latest()->take(5)->get();

        // 8. Peringatan/Notifikasi (Contoh: Pengantaran yang Terlambat)
        $peringatanPengantaranTerlambat = Pengantaran::where('tanggal', '<', today())
            ->where('status', '!=', 'Selesai')
            ->get();

        $data = [
            'title' => 'Dashboard',
            'menuDashboard' => 'active', // Pastikan ini sesuai dengan struktur menu Anda
            'totalPengantaranHariIni' => $totalPengantaranHariIni,
            'statusPengantaran' => $statusPengantaran,
            'totalPendapatanHariIni' => $totalPendapatanHariIni,
            'performaDriver' => $performaDriver,
            'lokasiPengantaranTerbaru' => $lokasiPengantaranTerbaru,
            'pertumbuhanPengguna' => $pertumbuhanPengguna,
            'peringatanPengantaranTerlambat' => $peringatanPengantaranTerlambat,
        ];

        return view('dashboard', $data); // Sesuaikan nama view-nya
    }
}
