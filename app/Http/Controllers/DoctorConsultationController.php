<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Consultation;
use Illuminate\Http\Request;

class DoctorConsultationController extends Controller
{
    public function index()
    {
        $doctor = Doctor::where('user_id', auth()->id())->firstOrFail();
        $status = request('status');
        
        $query = $doctor->consultations()
            ->with(['patient', 'schedule'])
            ->orderByDesc('consultation_datetime');
        
        if ($status && in_array($status, ['pending', 'confirmed', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }
        
        $consultations = $query->paginate(10);

        return view('doctor.consultations.index', [
            'consultations' => $consultations,
            'currentStatus' => $status,
            'doctor' => $doctor,
        ]);
    }

    public function show(Consultation $consultation)
    {
        $doctor = Doctor::where('user_id', auth()->id())->firstOrFail();
        $this->authorize('view', $consultation);
        
        return view('doctor.consultations.show', [
            'consultation' => $consultation->load(['patient', 'schedule.doctor', 'doctor']),
        ]);
    }

    public function edit(Consultation $consultation)
    {
        $doctor = Doctor::where('user_id', auth()->id())->firstOrFail();
        $this->authorize('update', $consultation);
        
        return view('doctor.consultations.edit-status', [
            'consultation' => $consultation->load(['patient', 'schedule']),
        ]);
    }

    public function update(Request $request, Consultation $consultation)
    {
        $doctor = Doctor::where('user_id', auth()->id())->firstOrFail();
        $this->authorize('update', $consultation);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'doctor_notes' => 'nullable|string',
        ]);

        $consultation->update($validated);

        return redirect()->route('doctor.consultations.index')
            ->with('success', 'Status konsultasi berhasil diupdate');
    }
}
