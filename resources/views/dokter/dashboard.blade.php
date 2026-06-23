@extends('layouts.dokter')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-speedometer2"></i> Dashboard Dokter</h1>
</div>

<div class="row g-4">
    <!-- Lihat Jadwal Konsultasi -->
    <div class="col-md-6 col-lg-4">
        <a href="/dokter/jadwal" class="menu-card">
            <i class="bi bi-calendar-check menu-card-icon"></i>
            <h3>Lihat Jadwal Konsultasi</h3>
            <p>Kelola dan lihat semua jadwal konsultasi Anda</p>
        </a>
    </div>

    <!-- Manajemen Konsultasi -->
    <div class="col-md-6 col-lg-4">
        <a href="/dokter/manajemen" class="menu-card">
            <i class="bi bi-clipboard-list menu-card-icon"></i>
            <h3>Manajemen Konsultasi</h3>
            <p>Kelola data pasien dan detail konsultasi</p>
        </a>
    </div>

    <!-- Update Status Konsultasi -->
    <div class="col-md-6 col-lg-4">
        <a href="/dokter/update-status" class="menu-card">
            <i class="bi bi-arrow-repeat menu-card-icon"></i>
            <h3>Update Status Konsultasi</h3>
            <p>Perbarui status konsultasi pasien Anda</p>
        </a>
    </div>
</div>
@endsection