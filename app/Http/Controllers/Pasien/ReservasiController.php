<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPraktek;

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
}
