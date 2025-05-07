<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view("auth.login");
    }

    public function loginProcess(Request $request){
        $request->validate([
            "email"=> "required",
            "password"=> "required",
        ]);

        $data = array(
            'email' => $request->email,
            'password'=> $request->password,
        );
        if(Auth::attempt($data)){
            return redirect()->route('dashboard')->with('success','Login Berhasil');
        } else {
            return redirect()->back()->with('error', 'Email Atau Password Salah');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','Berhasil Logout');
    }
}