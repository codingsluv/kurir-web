<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasController extends Controller
{
    public function index(){
        $data = array(
          "title"=> "Data Kas",
          "activeKas"=> "active",
        );
        return view("admin.kas.index", $data);
    }
}
