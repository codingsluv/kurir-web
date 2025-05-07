<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengantaranController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Data Pengantaran',
            'activePengantaran' => 'active',
        );
        return view("admin.pengantaran.index", $data);
    }
}
