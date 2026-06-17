<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPraktek;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    //
    public function index()
    {
        $jadwal = JadwalPraktek::with('dokter')
            ->where('status_jadwal', 1)
            ->get();

        return view(
            'pasien.reservasi',
            compact('jadwal')
        );
    }
    public function store($jadwal)
    {
        $antrian = Reservasi::where(
            'jadwal_id',
            $jadwal
        )->count() + 1;

        Reservasi::create([

            'pasien_id' => Auth::user()->id_user,

            'staff_id' => null,

            'jadwal_id' => $jadwal,

            'tanggal_booking' => now(),

            'nomor_antrian' => $antrian,

            'status_reservasi' => 'menunggu'

        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Reservasi berhasil dibuat'
            );
    }
}
