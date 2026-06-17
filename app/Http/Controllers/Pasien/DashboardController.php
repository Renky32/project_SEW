<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $reservasiTerdekat = Reservasi::with([
            'jadwal.dokter'
        ])
            ->where('pasien_id', Auth::user()->id_user)
            ->where('status_reservasi', 'menunggu')
            ->orderBy('tanggal_booking')
            ->take(5)
            ->get();
        $userId = Auth::user()->id_user;

        $totalReservasi = Reservasi::where(
            'pasien_id',
            $userId
        )->count();

        $reservasiAktif = Reservasi::where(
            'pasien_id',
            $userId
        )
            ->where('status_reservasi', 'menunggu')
            ->count();

        $reservasiSelesai = Reservasi::where(
            'pasien_id',
            $userId
        )
            ->where('status_reservasi', 'selesai')
            ->count();

        $reservasiBatal = Reservasi::where(
            'pasien_id',
            $userId
        )
            ->where('status_reservasi', 'dibatalkan')
            ->count();

        return view(
            'pasien.dashboard',
            compact(
                'totalReservasi',
                'reservasiAktif',
                'reservasiSelesai',
                'reservasiBatal',
                'reservasiTerdekat'
            )
        );
    }
}
