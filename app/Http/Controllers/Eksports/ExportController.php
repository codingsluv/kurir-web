<?php

namespace App\Http\Controllers\Eksports;

use App\Exports\AbsensiExport;
use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportAbsensiExcel(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Tentukan jenis laporan berdasarkan parameter yang diberikan
        if ($tanggal) {
            $namaFile = 'Laporan Absensi Harian ' . Carbon::parse($tanggal)->format('d-m-Y') . '.xlsx';
            $attendances = Attendence::where('tanggal', $tanggal)->get();
        } else if ($bulan && $tahun) {
            $namaFile = 'Laporan Absensi Bulanan ' . Carbon::create($tahun, $bulan, 1)->format('F Y') . '.xlsx';
            $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth()->toDateString();
            $endOfMonth = Carbon::create($tahun, $bulan, 1)->endOfMonth()->toDateString();
            $attendances = Attendence::whereBetween('tanggal', [$startOfMonth, $endOfMonth])->get();
        } else {
            $namaFile = 'Laporan Absensi Keseluruhan.xlsx';
            $attendances = Attendence::all();
        }

        return Excel::download(new AbsensiExport($attendances), $namaFile);
    }

    // Fungsi untuk export ke PDF Absensi
    public function exportAbsensiPdf(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Tentukan jenis laporan berdasarkan parameter yang diberikan
        if ($tanggal) {
            $namaFile = 'Laporan Absensi Harian ' . Carbon::parse($tanggal)->format('d-m-Y') . '.pdf';
            $attendances = Attendence::where('tanggal', $tanggal)->get();
        } else if ($bulan && $tahun) {
            $namaFile = 'Laporan Absensi Bulanan ' . Carbon::create($tahun, $bulan, 1)->format('F Y') . '.pdf';
            $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth()->toDateString();
            $endOfMonth = Carbon::create($tahun, $bulan, 1)->endOfMonth()->toDateString();
            $attendances = Attendence::whereBetween('tanggal', [$startOfMonth, $endOfMonth])->get();
        } else {
            $namaFile = 'Laporan Absensi Keseluruhan.pdf';
            $attendances = Attendence::all();
        }

        $data = [
            'title' => 'Laporan Absensi',
            'attendances' => $attendances,
        ];

        $pdf = Pdf::loadView('exports.absensi', $data); // Membuat view untuk laporan PDF (exports/absensi.blade.php)
        return $pdf->download($namaFile);
    }

    // Fungsi untuk export ke Excel Order
    public function exportOrderExcel(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Tentukan jenis laporan berdasarkan parameter yang diberikan
        if ($tanggal) {
            $namaFile = 'Laporan Order Harian ' . Carbon::parse($tanggal)->format('d-m-Y') . '.xlsx';
            $orders = Order::whereDate('created_at', $tanggal)->get();
        } else if ($bulan && $tahun) {
            $namaFile = 'Laporan Order Bulanan ' . Carbon::create($tahun, $bulan, 1)->format('F Y') . '.xlsx';
            $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth()->toDateString();
            $endOfMonth = Carbon::create($tahun, $bulan, 1)->endOfMonth()->toDateString();
            $orders = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();
        } else {
            $namaFile = 'Laporan Order Keseluruhan.xlsx';
            $orders = Order::all();
        }

        return Excel::download(new OrderExport($orders), $namaFile);
    }

    // Fungsi untuk export ke PDF Order
    public function exportOrderPdf(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Tentukan jenis laporan berdasarkan parameter yang diberikan
        if ($tanggal) {
            $namaFile = 'Laporan Order Harian ' . Carbon::parse($tanggal)->format('d-m-Y') . '.pdf';
            $orders = Order::whereDate('created_at', $tanggal)->get();
        } else if ($bulan && $tahun) {
            $namaFile = 'Laporan Order Bulanan ' . Carbon::create($tahun, $bulan, 1)->format('F Y') . '.pdf';
            $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth()->toDateString();
            $endOfMonth = Carbon::create($tahun, $bulan, 1)->endOfMonth()->toDateString();
            $orders = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();
        } else {
            $namaFile = 'Laporan Order Keseluruhan.pdf';
            $orders = Order::all();
        }

        $data = [
            'title' => 'Laporan Order',
            'orders' => $orders,
        ];

        $pdf = Pdf::loadView('exports.order', $data); // Membuat view untuk laporan PDF (exports/order.blade.php)
        return $pdf->download($namaFile);
    }
}
