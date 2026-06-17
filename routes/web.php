<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Pasien\ReservasiController;
use App\Http\Controllers\Pasien\RiwayatController;
use App\Http\Controllers\Pasien\DashboardController;

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

    Route::view('/dokter/dashboard', 'dokter.dashboard');
});

Route::middleware(['auth', 'role:pasien'])->group(function () {

    Route::view('/pasien/dashboard', 'pasien.dashboard');
});

Route::get('/login', [LoginController::class, 'index'])
    ->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


Route::middleware(['auth', 'role:pasien'])->group(function () {

    Route::get(
        '/pasien/dashboard',
        [DashboardController::class, 'index']
    );

    Route::view('/pasien/profil', 'pasien.profil');


    Route::get(
        '/pasien/reservasi',
        [ReservasiController::class, 'index']
    );
    Route::post(
        '/pasien/reservasi/{jadwal}',
        [ReservasiController::class, 'store']
    );

    Route::get(
        '/pasien/riwayat',
        [RiwayatController::class, 'index']
    );
    Route::get(
        '/pasien/riwayat/{id}',
        [RiwayatController::class, 'show']

    );
    Route::put(
        '/pasien/reservasi/{id}/batal',
        [RiwayatController::class, 'cancel']
    );
    Route::view(
        '/pasien/profil',
        'pasien.profil'
    );
});
