<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Consultation;
use Illuminate\Http\Request;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        $doctor = Doctor::where('user_id', auth()->id())->firstOrFail();
        
        $totalConsultations = Consultation::where('doctor_id', $doctor->id)->count();
        $pendingConsultations = Consultation::where('doctor_id', $doctor->id)
            ->where('status', 'pending')
            ->count();
        $completedConsultations = Consultation::where('doctor_id', $doctor->id)
            ->where('status', 'completed')
            ->count();
        
        $todayConsultations = Consultation::where('doctor_id', $doctor->id)
            ->whereDate('consultation_datetime', today())
            ->orderBy('consultation_datetime')
            ->with(['patient', 'schedule'])
            ->get();

        return view('doctor.dashboard', [
            'doctor' => $doctor,
            'totalConsultations' => $totalConsultations,
            'pendingConsultations' => $pendingConsultations,
            'completedConsultations' => $completedConsultations,
            'todayConsultations' => $todayConsultations,
        ]);
    }
}

