<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Consultation;
use App\Models\Doctor;

class DashboardController extends Controller
{
    public function index()
    {
        $patient = Auth::user();
        
        $totalConsultations = Consultation::where('patient_id', $patient->id_user)->count();
        $completedConsultations = Consultation::where('patient_id', $patient->id_user)
            ->where('status', 'completed')
            ->count();
        $upcomingConsultations = Consultation::where('patient_id', $patient->id_user)
            ->where('status', 'confirmed')
            ->orderBy('datetime', 'asc')
            ->take(5)
            ->get();
        
        $recentConsultations = Consultation::where('patient_id', $patient->id_user)
            ->with('doctor')
            ->orderBy('datetime', 'desc')
            ->take(5)
            ->get();

        $stats = [
            'total_consultations' => $totalConsultations,
            'completed_consultations' => $completedConsultations,
            'pending_consultations' => Consultation::where('patient_id', $patient->id_user)
                ->where('status', 'pending')
                ->count(),
            'cancelled_consultations' => Consultation::where('patient_id', $patient->id_user)
                ->where('status', 'cancelled')
                ->count(),
        ];

        return view('pasien.dashboard', compact(
            'upcomingConsultations',
            'recentConsultations',
            'stats'
        ));
    }
}
