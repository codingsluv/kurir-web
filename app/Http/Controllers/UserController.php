<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $data = array(
            'title' => 'Data User',
            'activeUser'=> 'active',
            'user' => User::orderBy('role', 'asc')->get(),
        );
        return view("admin.user.index", $data);
    }

    public function create() {
        $data = array(
            "title"=> "Create User",
            "activeUser"=> "active",
        );
        return view("admin.user.create", $data);
    }

    public function store(Request $request) {
      $request->validate([
        'username' => 'required',
        'email' => 'required|unique:users,email',
        'role' => 'required',
        'password'=> 'required|confirmed',
        'nama' => 'required',
        'no_hp' => 'required|unique:users,no_hp',
        'alamat' => 'required',
      ], [
        'username.required'=> 'Username Tidak Boleh Kosong',
        'email.required'=> 'Email Tidak Boleh Kosong',
        'email.unique'=> 'Email Sudah Ada',
        'role.required'=> 'Role Harus di Pilih',
        'password.required' => 'Password Tidak Boleh Kosong',
        'password.confirmation'=> 'Passoword Konfirmasi Tidak Sesuai',
      ]);

      $user = new User();
      $user->username = $request->username;
      $user->email = $request->email;
      $user->role = $request->role;
      $user->password = Hash::make($request->password);
      $user->nama = $request->nama;
      $user->no_hp = $request->no_hp;
      $user->alamat = $request->alamat;
      $user->save();
      return redirect()->route('user')->with('success','User Berhasil Ditambahkan');
    }

    public function show($id) {
        $data = array(
            'title'=> 'Edit User',
            'user' => User::findOrFail($id),
        );
        return view('admin.user.edit', $data);
    }

    public function update(Request $request, $id) {
        $request->validate([
          'username' => 'required',
          'email' => 'required|unique:users,email,' .$id,
          'role' => 'required',
          'password'=> 'nullable',
          'nama' => 'required',
          'no_hp' => 'required|unique:users,no_hp,' .$id,
          'alamat' => 'required',
        ], [
          'username.required'=> 'Username Tidak Boleh Kosong',
          'email.required'=> 'Email Tidak Boleh Kosong',
          'email.unique'=> 'Email Sudah Ada',
          'role.required'=> 'Role Harus di Pilih',
        ]);


        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->nama = $request->nama;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        if($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('user')->with('success','User Berhasil Di Update');
      }

      public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user')->with('success','Berhasil Hapus Data User');
      }
}