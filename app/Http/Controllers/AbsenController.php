<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AbsenController extends Controller
{
    public function index(){
        $data = array(
            "title" => "Data Absen",
            "activeAbsen" => "active",
            'absens' => Absen::with('users')
                ->whereHas('users', function ($query) {
                    $query->where('role', 'driver');
                })
                ->orderByDesc('tanggal')
                ->get()
        );

        return view("admin.absen.index", $data);
    }

    public function create() {
        $data = array(
            'title' => 'Create Absen',
            'users' => User::where('role', 'Driver')->get()
        );

        return view('admin.absen.create', $data);
    }


    public function store(Request $request)
    {
            // Validasi input
        $validated = $request->validate([
            'user_id'    => 'required|exists:users,id',
            'tanggal'    => 'required|date',
            'jam_masuk'  => 'nullable|date_format:H:i',
            'jam_pulang' => 'nullable|date_format:H:i',
            'status'     => 'required|string',
        ]);

        // Pastikan hanya admin yang bisa akses
        if (auth()->user()->role !== 'Admin') {
            return back()->with('error', 'Hanya admin yang boleh menginput absen.');
        }

        // Simpan absen
        Absen::create($validated);

        return redirect()->route('absen')->with('success', 'Data absen berhasil ditambahkan.');
    }

    public function show($id) {
        $data = array(
            'title' => 'Edit Absen',
            'absen' => Absen::with('users')->findOrFail($id),
            'user'  => User::where('role', 'Driver')->get(),
        );

        return view('admin.absen.edit', $data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'status' => 'required',
        ]);
        $absen = Absen::findOrFail($id);
        $absen->status = $request->status;

        $absen->save();
        return redirect()->route('absen')->with('success','Berhasil Edit Status');
    }

    public function destroy($id){
        $absen = Absen::findOrFail($id);
        $absen->delete();
        return redirect()->route('absen')->with('success','Data Berhasil Dihapus');
    }
}