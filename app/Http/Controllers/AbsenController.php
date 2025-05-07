<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index(){
        $data = array(
            "title"=> "Data Absen",
            "activeAbsen"=> "active",
        );
        return view("admin.absen.index", $data);
    }
}
