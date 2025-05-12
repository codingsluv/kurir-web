<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Pengantaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PengantaranController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Data Pengantaran',
            'activePengantaran' => 'active',
            'pengantarans' => Pengantaran::with('users')
                ->whereHas('users', function ($query) {
                    $query->where('role', 'driver');
                })->latest()->get() // Menambahkan latest() agar data terbaru di atas
        );
        return view("admin.pengantaran.index", $data);
    }

    public function create(){
        $data = array(
            "title"             => "Create Data Pengantaran",
            "activePengantaran" => "active",
            "users"             => User::where('role', 'Driver')->orderBy('name')->get(), // Menambahkan urutan nama
        );
        return view("admin.pengantaran.create", $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'nama_pemesan'  => 'required',
            'no_telepon'    => 'required',
            'status'        => 'required',
            'tanggal'       => 'required|date',
            'alamat'        => 'required',
            'ongkir'        => 'nullable|numeric|min:0',
        ]);
        DB::transaction(function () use ($validatedData) {
            $pengantaran = Pengantaran::create($validatedData);
            History::create([
                'user_id' => $pengantaran->user_id,
                'nama_pemesan' => $pengantaran->nama_pemesan,
                'no_telepon' => $pengantaran->no_telepon,
                'alamat' => $pengantaran->alamat,
                'ongkir' => $pengantaran->ongkir,
                'status' => $pengantaran->status,
                'tanggal' => $pengantaran->tanggal,
            ]);
        });
       return redirect()->route('pengantaran')->with('success', 'Data pengantaran berhasil ditambahkan dan disimpan ke history.');
    }

     public function show($id)
    {
        $data = array(
            'title'             => 'Edit Data Pengantaran',
            'activePengantaran' => 'active',
            'pengantaran'       => Pengantaran::findOrFail($id),
            'users'             => User::where('role', 'Driver')->orderBy('name')->get(), // Menambahkan urutan nama
        );
        return view('admin.pengantaran.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal'       => 'required|date', // Pastikan format tanggal sesuai
            'nama_pemesan'  => 'required',
            'no_telepon'    => 'required',
            'status'        => 'required',
            'alamat'        => 'required',
            'ongkir'        => 'nullable|numeric|min:0', // Menambahkan validasi untuk ongkir
        ]);

        DB::transaction(function () use ($request, $id, $validatedData) {
            $pengantaran = Pengantaran::findOrFail($id);
            $pengantaran->update($validatedData);

            // Cari di history, jika ada, update. Jika tidak, buat baru.
            $historyPengantaran = History::where('nama_pemesan', $pengantaran->nama_pemesan)->first();

            if ($historyPengantaran) {
                $historyPengantaran->update($validatedData);
            } else {
                History::create([
                    'user_id'       => $pengantaran->user_id,
                    'nama_pemesan'  => $validatedData['nama_pemesan'],
                    'no_telepon'    => $validatedData['no_telepon'],
                    'alamat'        => $validatedData['alamat'],
                    'ongkir'        => $validatedData['ongkir'],
                    'status'        => $validatedData['status'],
                    'tanggal'       => $validatedData['tanggal'],
                ]);
            }
        });

        return redirect()->route('pengantaran')->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy($id){
        $pengantaran = Pengantaran::findOrFail($id);
        $pengantaran->delete();
        return redirect()->route('pengantaran')->with('success','Data Berhasil Dihapus');
    }
}
