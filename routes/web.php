<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\PengantaranController;
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

    Route::get('/driver', [DriverController::class, 'index'])->name('driver');
    Route::get('/driver/create', [DriverController::class, 'create'])->name('createDriver');
    Route::post('/driver/store', [DriverController::class,'store'])->name('storeDriver');
    Route::get('/driver/edit/{id}', [DriverController::class,'show'])->name('showDriver');
    Route::put('/driver/update/{id}', [DriverController::class, 'update'])->name('updateDriver');
    Route::delete('/driver/delete/{id}', [DriverController::class, 'destroy'])->name('deleteDriver');

    Route::get('/absen', [AbsenController::class,'index'])->name('absen');
    Route::get('/absen/create', [AbsenController::class, 'create'])->name('createAbsen');
    Route::post('/absen/store', [AbsenController::class, 'store'])->name('storeAbsen');
    Route::get('/absen/edit/{id}', [AbsenController::class,'show'])->name('showAbsen');
    Route::put('/absen/update/{id}', [AbsenController::class,'update'])->name('updateAbsen');
    Route::delete('/absen/delete/{id}', [AbsenController::class,'destroy'])->name('deleteAbsen');

    Route::get('/pengantaran', [PengantaranController::class, 'index'])->name('pengantaran');
    Route::get('/pengantaran/create', [PengantaranController::class, 'create'])->name('createPengantaran');
    Route::post('/pengantarn/store', [PengantaranController::class, 'store'])->name('storePengantaran');
    Route::get('/pengantaran/edit/{id}', [PengantaranController::class,'show'])->name('showPengantaran');
    Route::put('/pengantaran/update/{id}', [PengantaranController::class,'update'])->name('updatePengantaran');
    Route::delete('/pengantaran/delete/{id}', [PengantaranController::class,'destroy'])->name('deletePengantaran');

    Route::get('/gaji', [GajiController::class,'index'])->name('gaji');
    Route::get('/gaji/create', [GajiController::class,'create'])->name('createGaji');
    Route::post('/gaji/store', [GajiController::class,'store'])->name('storeGaji');
    Route::get('/gaji/edit/{id}', [GajiController::class,'edit'])->name('showGaji');
    Route::put('/gaji/update/{id}', [GajiController::class,'update'])->name('updateGaji');
    Route::delete('/gaji/delete/{id}', [GajiController::class, 'destroy'])->name('deleteGaji');
    Route::get('/export/gaji', [GajiController::class, 'exportGajiToExcel'])->name('export.gaji');
    Route::get('/export/gaji/pdf', [GajiController::class, 'exportGajiToPdf'])->name('export.gaji.pdf');

    Route::get('/history', [HistoryController::class,'index'])->name('history');
    // Route::get('/history/create', [HistoryController::class,'create'])->name('createHistory');

    Route::get('/kas', [KasController::class,'index'])->name('kas');
});