<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use App\Models\JadwalKonsultasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:dokter']);
    }

    // Dashboard
    public function dashboard()
    {
        return view('dokter.dashboard');
    }

    // LIHAT JADWAL KONSULTASI
    public function jadwal(Request $request)
    {
        $dokter_id = Auth::id();
        $query = JadwalKonsultasi::where('dokter_id', $dokter_id);

        if ($request->has('tanggal') && $request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $jadwal = $query->with('pasien')->orderBy('tanggal', 'desc')->paginate(10);

        return view('dokter.jadwal', compact('jadwal'));
    }

    public function jadwalDetail($id)
    {
        $jadwal = JadwalKonsultasi::with('pasien', 'dokter')->findOrFail($id);

        if ($jadwal->dokter_id !== Auth::id()) {
            abort(403);
        }

        return response()->json($jadwal);
    }

    // MANAJEMEN KONSULTASI
    public function manajemen(Request $request)
    {
        $dokter_id = Auth::id();
        $query = Konsultasi::where('dokter_id', $dokter_id);

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('pasien', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('nomor_telepon', 'like', "%$search%");
            });
        }

        if ($request->has('diagnosis') && $request->diagnosis) {
            $query->where('diagnosis', $request->diagnosis);
        }

        $konsultasi = $query->with('pasien')->orderBy('tanggal_konsultasi', 'desc')->paginate(10);

        return view('dokter.manajemen', compact('konsultasi'));
    }

    public function tambahKonsultasi()
    {
        $pasien = User::where('role', 'pasien')->get();
        return view('dokter.form-konsultasi', compact('pasien'));
    }

    public function simpanKonsultasi(Request $request)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:users,id',
            'tanggal_konsultasi' => 'required|date',
            'diagnosis' => 'required|string|max:255',
            'resep_obat' => 'required|string',
            'catatan' => 'required|string'
        ]);

        $validated['dokter_id'] = Auth::id();
        $validated['status'] = 'selesai';

        Konsultasi::create($validated);

        return redirect('/dokter/manajemen')->with('success', 'Konsultasi berhasil ditambahkan');
    }

    public function editKonsultasi($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        if ($konsultasi->dokter_id !== Auth::id()) {
            abort(403);
        }

        $pasien = User::where('role', 'pasien')->get();
        return view('dokter.form-konsultasi', compact('konsultasi', 'pasien'));
    }

    public function updateKonsultasi(Request $request, $id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        if ($konsultasi->dokter_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'pasien_id' => 'required|exists:users,id',
            'tanggal_konsultasi' => 'required|date',
            'diagnosis' => 'required|string|max:255',
            'resep_obat' => 'required|string',
            'catatan' => 'required|string'
        ]);

        $konsultasi->update($validated);

        return redirect('/dokter/manajemen')->with('success', 'Konsultasi berhasil diperbarui');
    }

    public function hapusKonsultasi($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);

        if ($konsultasi->dokter_id !== Auth::id()) {
            abort(403);
        }

        $konsultasi->delete();

        return redirect('/dokter/manajemen')->with('success', 'Konsultasi berhasil dihapus');
    }

    public function lihatResep($id)
    {
        $konsultasi = Konsultasi::with('pasien', 'dokter')->findOrFail($id);

        if ($konsultasi->dokter_id !== Auth::id()) {
            abort(403);
        }

        return view('dokter.resep', compact('konsultasi'));
    }

    // UPDATE STATUS KONSULTASI
    public function updateStatusPage()
    {
        $dokter_id = Auth::id();
        $jadwal = JadwalKonsultasi::where('dokter_id', $dokter_id)
            ->with('pasien')
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('dokter.update-status', compact('jadwal'));
    }

    public function prosesUpdateStatus(Request $request, $id)
    {
        $jadwal = JadwalKonsultasi::findOrFail($id);

        if ($jadwal->dokter_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'keterangan' => 'nullable|string'
        ]);

        $jadwal->status = $validated['status'];
        $jadwal->save();

        return redirect('/dokter/update-status')->with('success', 'Status berhasil diperbarui');
    }
}
