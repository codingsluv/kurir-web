<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(){
        $data = array(
            "title"=> "Data History",
            "activeHistory"=> "active",
            "history"=> History::with('user')->latest()->get(),
        );
        return view("admin.history.index", $data);
    }
}