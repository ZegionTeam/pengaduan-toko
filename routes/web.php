<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataPengaduan;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TokoController;
use App\Http\Middleware\LoginCheck;
use App\Models\FollowUpLaporan;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('pages.auth.authlogin');
});


// auth
Route::post('register', [UsersController::class, 'store']);
Route::post('login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);
Route::get('logout', [AuthController::class, 'logout']);


Route::middleware(LoginCheck::class)->group(function () {
    Route::get('/', [MainController::class, 'index']);

    Route::middleware('roles:karyawan')->group(function () {
        Route::get('/getbyjenis/{id}', [LaporanController::class, 'getByJenis']);
        Route::get('/all-laporan', [LaporanController::class, 'getall']);
        Route::resource('pengaduan', LaporanController::class);
        Route::get('/followupkaryawan/{id}', [FollowUpController::class, 'index']);
        Route::put('/laporan-selesai/{id}', [FollowUpController::class, 'tutupLaporan']);
    });

    Route::middleware('roles:pemeliharaan')->group(function () {
        Route::get('/getJenis/{id}', [DataPengaduan::class, 'getJenis']);
        Route::get('/getlapall', [DataPengaduan::class, 'getlapAll']);
        Route::get('/lap/{id}', [DataPengaduan::class, 'show']);
        Route::resource('data-pengaduan', DataPengaduan::class);
        Route::resource('users', UsersController::class);
        Route::resource('toko', TokoController::class);
        Route::get('/get-regencies/{id}', [LocationController::class, 'getRegencies']);
        Route::get('/get-districts/{id}', [LocationController::class, 'getDistricts']);
        Route::get('/get-villages/{id}', [LocationController::class, 'getVillages']);
    });


    Route::get('/profile', function () {
        return view('pages.profile');
    });
});
