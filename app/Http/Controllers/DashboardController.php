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
        // 1. Pertumbuhan Pengguna (Contoh: Pertumbuhan Bulanan dalam 6 Bulan Terakhir)
        $pertumbuhanPengguna = User::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as bulan'), DB::raw('count(*) as jumlah_pengguna'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->where('role', '!=', 'Admin') // Tidak termasuk admin
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->get();

        $data = [
            'title' => 'Dashboard',
            'menuDashboard' => 'active',
            'pertumbuhanPengguna' => $pertumbuhanPengguna,
        ];

        return view('dashboard', $data);
    }
}
