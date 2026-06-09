<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $patient = Auth::user();
        return view('pasien.profile', compact('patient'));
    }

    public function edit()
    {
        $patient = Auth::user();
        return view('pasien.profile-edit', compact('patient'));
    }

    public function update(Request $request)
    {
        $patient = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $patient->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return redirect()->route('pasien.profile')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
