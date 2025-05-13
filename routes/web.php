<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\OrderanMasukController;
use App\Http\Controllers\PengantaranController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Pengantaran;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/loginProcess', [AuthController::class,'loginProcess'])->name('loginProcess');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');


Route::middleware(['checkLogin'])->group(function() {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');


    Route::get('/user', [UserController::class,'index'])->name('user');
    Route::get('/user/create', [UserController::class,'create'])->name('createUser');
    Route::post('/user/store', [UserController::class,'store'])->name('storeUser');
    Route::get('/user/edit/{id}', [UserController::class,'show'])->name('showUser');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('updateUser');
    Route::delete('/user/delete{id}', [UserController::class,'destroy'])->name('deleteUser');

    
});
