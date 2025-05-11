<?php

namespace App\Http\Controllers;

use App\Models\Pengantaran;
use App\Models\User;
use Illuminate\Http\Request;
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
                })->get()
        );
        return view("admin.pengantaran.index", $data);
    }

    public function create(){
        $data = array(
            "title"             => "Create Data Pengantaran",
            "activePengantaran" => "active",
            "users"             => User::where('role', 'Driver')->get(),
        );
        return view("admin.pengantaran.create", $data);
    }

    public function store(Request $request){

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_pemesan'=> 'required',
            'no_telepon' => 'required',
            'status' => 'required',
            'tanggal'=> 'required',
            'alamat'=> 'required',
            'catatan'=> 'nullable',
        ]);

        Pengantaran::create($validated);
        return redirect()->route('pengantaran')->with('success','Data pengantaran berhasil di tambah');
    }

    public function show($id){
        $data = array(
            'title'=> 'Edit Data Pengantaran',
            'activePengantaran'=> 'active',
            'pengantaran' => Pengantaran::findOrFail( $id ),
            'users'  => User::where('role', 'Driver')->get(),
        );
        return view('admin.pengantaran.edit', $data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'tanggal' => 'required',
            'nama_pemesan'=> 'required',
            'no_telepon'=> 'required',
            'status'=> 'required',
            'alamat' => 'required',
        ]);
        $pengantaran = Pengantaran::findOrFail($id);
        $pengantaran->update($request->all());
        return redirect()->route('pengantaran')->with('success','Data Berhasil Diupdate');
    }

    public function destroy($id){
        $pengantaran = Pengantaran::findOrFail($id);
        $pengantaran->delete();
        return redirect()->route('pengantaran')->with('success','Data Berhasil Dihapus');
    }
}