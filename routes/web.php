<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\DoctorConsultationController;
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
use App\Http\Controllers\Pasien\DoctorController as PasienDoctorController;
use App\Http\Controllers\Pasien\ConsultationController as PasienConsultationController;
use App\Http\Controllers\Pasien\ProfileController as PasienProfileController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {

    $user = Auth::user();

    return match ($user->role) {
        'staff' => redirect('/admin/dashboard'),
        'dokter' => redirect('/doctor/dashboard'),
        'pasien' => redirect('/pasien/dashboard'),
        default => abort(403),
    };
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:staff'])->group(function () {

    Route::view('/admin/dashboard', 'admin.dashboard');
});

Route::middleware(['auth', 'role:dokter'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('schedules', DoctorScheduleController::class);
    
    Route::resource('consultations', DoctorConsultationController::class, ['only' => ['index', 'show', 'edit', 'update']]);
});

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/dashboard', [PasienDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/doctors', [PasienDoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/{id}', [PasienDoctorController::class, 'show'])->name('doctors.show');
    
    Route::get('/consultations', [PasienConsultationController::class, 'index'])->name('consultations.index');
    Route::get('/consultations/create', [PasienConsultationController::class, 'create'])->name('consultations.create');
    Route::post('/consultations', [PasienConsultationController::class, 'store'])->name('consultations.store');
    Route::get('/consultations/{id}', [PasienConsultationController::class, 'show'])->name('consultations.show');
    Route::post('/consultations/{id}/cancel', [PasienConsultationController::class, 'cancel'])->name('consultations.cancel');
    
    Route::get('/profile', [PasienProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [PasienProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [PasienProfileController::class, 'update'])->name('profile.update');
});

Route::get('/login', [LoginController::class, 'index'])
    ->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
