<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index(){
        $data = array(
            "title"        => "Data Driver",
            "activeDriver" => "active",
            "drivers"       => Driver::with('user')->whereHas('user', function ($query) {$query->where('role', 'Driver'); })->get()
        );
        return view("admin.driver.index", $data);
    }

    public function create() {
        $data = array(
            "title"        => "Create Driver",
            "users"        => User::where('role', 'Driver')->get(),
        );
        return view("admin.driver.create", $data);
    }

    public function store(Request $request)
    {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'nohp' => 'nullable|string',
                'alamat' => 'nullable|string',
                'foto' => 'nullable|image|max:2048',
            ]);

            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('drivers', 'public');
            }

            Driver::create([
                'user_id' => $request->user_id,
                'nohp' => $request->nohp,
                'alamat' => $request->alamat,
                'foto' => $fotoPath,
            ]);

            return redirect()->route('driver')->with('success', 'Driver berhasil ditambahkan');
    }

    public function show($id) {
        $data = array(
            'title'=> 'Edit Driver',
            'driver' => Driver::findOrFail( $id ),
            'users'  => User::where('role', 'Driver')->get(),
        );
        return view('admin.driver.edit', $data);
    }

    public function update(Request $request, $id) {
        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'nohp' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        $driver = Driver::findOrFail($id);
        // $driver->user_id = $request->user_id;
        $driver->nohp = $request->nohp;
        $driver->alamat = $request->alamat;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('drivers', 'public');
            $driver->foto = $fotoPath;
        }

        $driver->save();

        return redirect()->route('driver')->with('success', 'Data driver berhasil diperbarui.');
    }

    public function destroy($id) {
       $driver = Driver::findOrFail($id);
       $driver->delete();
       return redirect()->route('driver')->with('success','Data Berhasil Di Hapus');
    }

}
