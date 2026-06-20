<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Pasien\ReservasiController;
use App\Http\Controllers\Dokter\DokterController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {

    $user = Auth::user();

    return match ($user->role) {
        'staff' => redirect('/admin/dashboard'),
        'dokter' => redirect('/dokter/dashboard'),
        'pasien' => redirect('/pasien/dashboard'),
        default => abort(403),
    };
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:staff'])->group(function () {

    Route::view('/admin/dashboard', 'admin.dashboard');
});

Route::middleware(['auth', 'role:dokter'])->group(function () {

    Route::get('/dokter/dashboard', [DokterController::class, 'dashboard']);
    Route::get('/dokter/jadwal', [DokterController::class, 'jadwal']);
    Route::get('/dokter/jadwal/{id}', [DokterController::class, 'jadwalDetail']);
    
    Route::get('/dokter/manajemen', [DokterController::class, 'manajemen']);
    Route::get('/dokter/manajemen/tambah', [DokterController::class, 'tambahKonsultasi']);
    Route::post('/dokter/manajemen/simpan', [DokterController::class, 'simpanKonsultasi']);
    Route::get('/dokter/manajemen/edit/{id}', [DokterController::class, 'editKonsultasi']);
    Route::put('/dokter/manajemen/update/{id}', [DokterController::class, 'updateKonsultasi']);
    Route::delete('/dokter/manajemen/hapus/{id}', [DokterController::class, 'hapusKonsultasi']);
    Route::get('/dokter/manajemen/resep/{id}', [DokterController::class, 'lihatResep']);
    
    Route::get('/dokter/update-status', [DokterController::class, 'updateStatusPage']);
    Route::put('/dokter/update-status/{id}', [DokterController::class, 'prosesUpdateStatus']);
});

Route::middleware(['auth', 'role:pasien'])->group(function () {

    Route::view('/pasien/dashboard', 'pasien.dashboard');

    Route::view('/pasien/profil', 'pasien.profil');


    Route::get(
        '/pasien/reservasi',
        [ReservasiController::class, 'index']
    );

    Route::view('/pasien/riwayat', 'pasien.riwayat');
});

Route::get('/login', [LoginController::class, 'index'])
    ->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

