<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(){
        $data = array(
            "title"=> "Data History",
            "activeHistory"=> "active",
        );
        return view("admin.history.index", $data);
    }
}