<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $reservasi = Reservasi::with([
            'jadwal.dokter'
        ])
            ->where(
                'pasien_id',
                Auth::user()->id_user
            )
            ->orderBy(
                'id_reservasi',
                'desc'
            )
            ->get();

        return view(
            'pasien.riwayat',
            compact('reservasi')
        );
    }
    public function show($id)
    {
        $reservasi = Reservasi::with([
            'jadwal.dokter'
        ])
            ->where(
                'pasien_id',
                Auth::user()->id_user
            )
            ->findOrFail($id);

        return view(
            'pasien.detail-reservasi',
            compact('reservasi')
        );
    }
    public function cancel($id)
    {
        $reservasi = Reservasi::where(
            'pasien_id',
            Auth::user()->id_user
        )
            ->findOrFail($id);

        if ($reservasi->status_reservasi != 'Menunggu') {

            return back()->with(
                'error',
                'Reservasi tidak dapat dibatalkan'
            );
        }

        $reservasi->status_reservasi = 'Dibatalkan';

        $reservasi->save();

        return redirect('/pasien/riwayat')
            ->with(
                'success',
                'Reservasi berhasil dibatalkan'
            );
    }
}
