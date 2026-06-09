<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Consultation;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::where('status', 'active')
            ->with('schedules')
            ->get();

        return view('pasien.doctors.index', compact('doctors'));
    }

    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        $schedules = $doctor->schedules()
            ->where('status', 'active')
            ->get();

        $patientConsultations = Consultation::where('patient_id', Auth::user()->id_user)
            ->where('doctor_id', $id)
            ->count();

        return view('pasien.doctors.show', compact('doctor', 'schedules', 'patientConsultations'));
    }
}
