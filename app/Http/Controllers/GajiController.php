<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index(){
        $data = array(
            "title" => "Data Gaji",
            "activeGaji"=> "active",
        );
        return view("admin.gaji.index", $data);
    }
}