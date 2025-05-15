<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Order;
use App\Models\Pengantaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import Carbon untuk manipulasi tanggal
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'Admin') {
            return $this->adminDashboard();
        } elseif ($user->role === 'Driver') {
            return $this->driverDashboard();
        }

        // Jika ada peran lain, Anda bisa tambahkan logika di sini
        return abort(403, 'Unauthorized action.');
    }

    /**
     * Menampilkan dashboard untuk admin.
     *
     * @return \Illuminate\Http\Response
     */
    private function adminDashboard()
    {
        $title = 'Dashboard Admin';

        // Mengambil data pertumbuhan pengguna 6 bulan terakhir
        $pertumbuhanPengguna = DB::table('users')
            ->select(DB::raw('DATE_FORMAT(created_at, "%M %Y") as bulan'), DB::raw('count(*) as jumlah_pengguna'))
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%M %Y")'))
            ->orderBy(DB::raw('MIN(created_at)'), 'ASC')
            ->get();

        // Data untuk grafik
        $chartData = [
            'labels' => $pertumbuhanPengguna->pluck('bulan')->toArray(),
            'series' => $pertumbuhanPengguna->pluck('jumlah_pengguna')->toArray(),
        ];

        // Mengambil data total driver
        $totalDriver = User::where('role', 'driver')->count();

        // Mengambil data total pendapatan dari ongkir
        $totalPendapatan = Order::where('status', 'Selesai')
            ->join('deliveries', 'orders.id', '=', 'deliveries.order_id')
            ->sum('deliveries.total_ongkir');

        // Mengambil data total gaji driver
        $totalGajiDriver = DB::table('orders')
            ->join('deliveries', 'orders.id', '=', 'deliveries.order_id')
            ->join('users', 'orders.driver_id', '=', 'users.id')
            ->where('orders.status', 'Selesai')
            ->where('users.role', 'driver')
            ->sum(DB::raw('deliveries.total_ongkir * 0.7'));

        $data = [
            'title' => $title,
            'pertumbuhanPengguna' => $pertumbuhanPengguna,
            'chartData' => $chartData,
            'totalDriver' => $totalDriver,
            'totalPendapatan' => $totalPendapatan,
            'totalGajiDriver' => $totalGajiDriver,
            'activeDashboard' => 'active'
        ];

        return view('dashboard', $data); // Menggunakan view dashboard
    }

    /**
     * Menampilkan dashboard untuk driver.
     *
     * @return \Illuminate\Http\Response
     */
    private function driverDashboard()
    {
        $driverId = Auth::id();

        // Hitung total ongkir driver
        $totalOngkirDriver = Order::where('status', 'Selesai')
            ->where('driver_id', $driverId)
            ->join('deliveries', 'orders.id', '=', 'deliveries.order_id')
            ->sum('deliveries.total_ongkir');

        // Hitung gaji driver
        $gajiDriver = $totalOngkirDriver * 0.7;

        // Hitung jumlah order yang telah diantar hari ini
        $jumlahOrderHariIni = Order::where('driver_id', $driverId)
            ->where('status', 'Selesai')
            ->whereDate('updated_at', today())
            ->count();

        // Ambil order yang harus diantar
        $orderYangHarusDiantar = Order::where('driver_id', $driverId)
            ->where('status', 'Menunggu')
            ->get();

        $data = [
            'title' => 'Dashboard Driver',
            'total_ongkir_driver' => $totalOngkirDriver,
            'gaji_driver' => $gajiDriver,
            'jumlah_order_hari_ini' => $jumlahOrderHariIni,
            'order_yang_harus_diantar' => $orderYangHarusDiantar,
            'activeDashboard' => 'active'
        ];

        return view('dashboard', $data); // Menggunakan view dashboard
    }

    public function handleAttendance(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'status' => 'required|array',
            'status.*' => 'required|in:hadir,tidak_hadir,izin',
        ]);

        $tanggal = $request->input('tanggal');

        foreach ($request->input('status') as $driver_id => $status) {
            Attendence::updateOrCreate(
                ['driver_id' => $driver_id, 'tanggal' => $tanggal],
                ['status' => $status]
            );
        }

        return redirect()->route('dashboard.today')->with('success', 'Data absensi berhasil disimpan.');
    }

    public function showTodayAttendance()
    {
        $today = Carbon::now()->toDateString();
        $user = Auth::user();

        if ($user->role == 'admin') {
            $attendances = Attendence::where('tanggal', $today)
                ->with('driver')
                ->orderBy('driver.nama')
                ->get();
            $data = [
                'title' => 'Absensi Hari Ini',
                'activeAbsensi' => 'active',
                'attendances' => $attendances,
                'today' => $today,
            ];
            return view('dashboard', $data); // Menggunakan view dashboard
        } else {
            $attendances = Attendence::where('tanggal', $today)
                ->where('driver_id', $user->id)
                ->with('driver')
                ->orderBy('driver.nama')
                ->get();
            $data = [
                'title' => 'Absensi Hari Ini',
                'activeAbsensi' => 'active',
                'attendances' => $attendances,
                'today' => $today,
            ];
            return view('dashboard', $data); // Menggunakan view dashboard
        }
    }

    public function showDailyReport(Request $request)
    {
        $date = $request->input('date', Carbon::now()->toDateString());
        $user = Auth::user();
        if ($user->role == 'admin') {
            $attendances = Attendence::where('tanggal', $date)
                ->with('driver')
                ->orderBy('driver.nama')
                ->get();

            $data = [
                'title' => 'Rekap Absensi Harian',
                'activeAbsensi' => 'active',
                'attendances' => $attendances,
                'report_date' => $date,
            ];

            return view('dashboard', $data); // Menggunakan view dashboard
        } else {
            $attendances = Attendence::where('tanggal', $date)
                ->where('driver_id', $user->id)
                ->with('driver')
                ->orderBy('driver.nama')
                ->get();

            $data = [
                'title' => 'Rekap Absensi Harian',
                'activeAbsensi' => 'active',
                'attendances' => $attendances,
                'report_date' => $date,
            ];

            return view('dashboard', $data); // Menggunakan view dashboard
        }
    }

    public function showMonthlyReport(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth()->toDateString();
        $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth()->toDateString();
        $user = Auth::user();

        if ($user->role == 'admin') {
            $attendances = Attendence::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
                ->with('driver')
                ->get()
                ->groupBy('driver_id')
                ->map(function ($driverAttendances) {
                    return $driverAttendances->sortBy(function ($attendance) {
                        return $attendance->driver->nama;
                    });
                });

            $data = [
                'title' => 'Rekap Absensi Bulanan',
                'activeAbsensi' => 'active',
                'attendances' => $attendances,
                'report_month' => Carbon::create($year, $month, 1)->format('F Y'),
                'month' => $month,
                'year' => $year,
            ];

            return view('dashboard', $data); // Menggunakan view dashboard
        } else {
            $attendances = Attendence::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
                ->where('driver_id', $user->id)
                ->with('driver')
                ->get()
                ->groupBy('driver_id')
                ->map(function ($driverAttendances) {
                    return $driverAttendances->sortBy(function ($attendance) {
                        return $attendance->driver->nama;
                    });
                });

            $data = [
                'title' => 'Rekap Absensi Bulanan',
                'activeAbsensi' => 'active',
                'attendances' => $attendances,
                'report_month' => Carbon::create($year, $month, 1)->format('F Y'),
                'month' => $month,
                'year' => $year,
            ];

            return view('dashboard', $data); // Menggunakan view dashboard
        }
    }
}
