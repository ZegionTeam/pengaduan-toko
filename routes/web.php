<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataPengaduan;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LocationController;
use App\Http\Middleware\LoginCheck;
use App\Models\FollowUpLaporan;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('pages.auth.authlogin');
});

Route::get('/register', function () {
    return view('pages.auth.authregister');
});

Route::get('/datatoko', function () {
    return view('pages.pemeliharaan.data-toko');
});

Route::get('/tambahdatatoko', function () {
    return view('pages.pemeliharaan.tambah-toko');
});



Route::get('/add-store', [LocationController::class, 'create']);
Route::post('/get-regencies', [LocationController::class, 'getRegencies'])->name('getRegencies');
Route::post('/get-districts', [LocationController::class, 'getDistricts'])->name('getDistricts');
Route::post('/get-villages', [LocationController::class, 'getVillages'])->name('getVillages');

Route::get('/stores/create', [LocationController::class, 'create'])->name('stores.create');
Route::post('/stores', [LocationController::class, 'store'])->name('stores.store');
Route::post('/get-regencies', [LocationController::class, 'getRegencies'])->name('getRegencies');
Route::post('/get-districts', [LocationController::class, 'getDistricts'])->name('getDistricts');
Route::post('/get-villages', [LocationController::class, 'getVillages'])->name('getVillages');
Route::put('/stores/{id}', [LocationController::class, 'update'])->name('stores.update');
Route::delete('/stores/{id}', [LocationController::class, 'destroy'])->name('stores.destroy');


// auth
Route::post('register', [UsersController::class, 'store']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);


Route::middleware(LoginCheck::class)->group(function () {
    Route::get('/', [MainController::class, 'index']);

    Route::middleware('roles:karyawan,pemeliharaan')->group(function () {
        Route::resource('pengaduan', LaporanController::class);
        Route::get('/getbyjenis/{id}', [LaporanController::class, 'getByJenis']);
        Route::get('/all-laporan', [LaporanController::class, 'getall']);

        Route::get('/followupkaryawan/{id}', [FollowUpController::class, 'index']);
        Route::put('/laporan-selesai/{id}', [FollowUpController::class, 'tutupLaporan']);
    });

    Route::middleware('roles:pemeliharaan,karyawan')->group(function () {
        Route::resource('data-pengaduan', DataPengaduan::class);
        Route::resource('users', UsersController::class);
    });


    Route::get('/profile', function () {
        return view('pages.profile');
    });
});
