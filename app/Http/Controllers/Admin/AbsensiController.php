<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function todayAttendance()
    {
        $today = Carbon::now()->toDateString();
        $attendances = Attendence::where('tanggal', $today)
            ->with('driver') // Eager load relasi 'driver'
            ->get()
            ->sortBy(function ($attendance) {
                return $attendance->driver->nama; // Akses nama melalui relasi
            });

        $data = [
            'title' => 'Absensi Hari Ini',
            'activeAbsensi' => 'active',
            'attendances' => $attendances,
            'today' => $today,
        ];

        return view('admin.absensi.today', $data);
    }

        public function index()
    {
        $today = Carbon::now()->toDateString();
        $drivers = User::where('role', 'Driver')->orderBy('nama')->get();
        $attendances = Attendence::where('tanggal', $today)
            ->get()
            ->keyBy('driver_id');

        $data = [
            'title' => 'Absensi Driver',
            'activeAbsensi' => 'active',
            'drivers' => $drivers,
            'attendances' => $attendances,
            'today' => $today,
        ];

        return view('admin.absensi.index', $data);
    }

        public function markAttendance(Request $request)
        {
            $request->validate([
                'tanggal' => 'required|date',
                'status' => 'required|array',
                'status.*' => 'required|in:hadir,tidak_hadir,izin',
            ]);

            $tanggal = $request->tanggal; // Use $request->tanggal
            $driverStatus = $request->input('status');

            foreach ($driverStatus as $driverId => $status) {
                Attendence::updateOrCreate(
                    ['driver_id' => $driverId, 'tanggal' => $tanggal],
                    ['status' => $status]
                );
            }


            return redirect()->route('admin.absensi.today')->with('success', 'Absensi driver berhasil disimpan.');
        }


        public function dailyReport(Request $request)
        {
            $date = $request->input('date', Carbon::now()->toDateString());
            $attendances = Attendence::where('tanggal', $date)
                ->with('driver') // Eager load relasi 'driver'
                ->get()
                ->sortBy(function ($attendance) {
                    return $attendance->driver->nama; // Akses nama melalui relasi
                });

            $data = [
                'title' => 'Rekap Absensi Harian',
                'activeAbsensi' => 'active',
                'attendances' => $attendances,
                'report_date' => $date,
            ];

            return view('admin.absensi.harian', $data);
        }

        public function monthlyReport(Request $request)
        {
            $month = $request->input('month', Carbon::now()->month);
            $year = $request->input('year', Carbon::now()->year);
            $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth()->toDateString();
            $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth()->toDateString();

            $attendances = Attendence::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
                ->with('driver') // Eager load relasi 'driver'
                ->get()
                ->groupBy('driver_id')
                ->map(function ($driverAttendances) {
                    return $driverAttendances->sortBy(function ($attendance) {
                        return $attendance->driver->nama; // Akses nama melalui relasi
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

            return view('admin.absensi.bulanan', $data);
        }
}