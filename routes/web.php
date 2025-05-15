<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\DriverController as AdminDriverController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Driver\DelivieryController;
use App\Http\Controllers\UserController;

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


    Route::resource('driver', AdminDriverController::class);

    Route::get('/absensi', [AbsensiController::class, 'index'])->name('admin.absensi.index');
    Route::post('/mark', [AbsensiController::class, 'markAttendance'])->name('admin.absensi.mark');
    Route::get('/today', [AbsensiController::class, 'todayAttendance'])->name('admin.absensi.today'); // Ubah '/today-attendance' menjadi '/today'
    Route::get('/harian', [AbsensiController::class, 'dailyReport'])->name('admin.absensi.harian');
    Route::get('/bulanan', [AbsensiController::class, 'monthlyReport'])->name('admin.absensi.bulanan');


    Route::resource('order', OrderController::class);
    Route::get('/order/masuk', [OrderController::class, 'orderMasuk'])->name('order.masuk');
    Route::get('/order/complete', [OrderController::class, 'complete'])->name('order.complete');

    Route::get('/driver/deliveries', [DelivieryController::class, 'index'])->name('driver.deliveries.index');
    Route::get('/driver/deliveries/{order}', [DelivieryController::class, 'show'])->name('driver.deliveries.show');
    Route::put('/driver/deliveries/{order}', [DelivieryController::class, 'update'])->name('driver.deliveries.update');
    Route::get('/admin/deliveries/history', [DelivieryController::class, 'history'])->name('admin.deliveries.history');
});
