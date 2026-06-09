<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ConsultationController extends Controller
{
    public function index()
    {
        $patient = Auth::user();
        $consultations = Consultation::where('patient_id', $patient->id_user)
            ->with('doctor')
            ->orderBy('datetime', 'desc')
            ->paginate(10);

        return view('pasien.consultations.index', compact('consultations'));
    }

    public function create(Request $request)
    {
        $doctorId = $request->query('doctor_id');
        $scheduleId = $request->query('schedule_id');
        
        $doctor = Doctor::findOrFail($doctorId);
        $schedule = DoctorSchedule::findOrFail($scheduleId);

        // Check available slots
        $bookedCount = Consultation::where('doctor_id', $doctorId)
            ->where('schedule_id', $scheduleId)
            ->count();

        if ($bookedCount >= $schedule->max_consultations) {
            return redirect()->back()->with('error', 'Jadwal ini sudah penuh');
        }

        return view('pasien.consultations.create', compact('doctor', 'schedule'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'schedule_id' => 'required|exists:doctor_schedules,id',
            'datetime' => 'required|date_format:Y-m-d H:i',
            'notes' => 'nullable|string|max:500',
        ]);

        $schedule = DoctorSchedule::findOrFail($request->schedule_id);
        
        // Check slot availability
        $bookedCount = Consultation::where('doctor_id', $request->doctor_id)
            ->where('schedule_id', $request->schedule_id)
            ->count();

        if ($bookedCount >= $schedule->max_consultations) {
            return redirect()->back()->with('error', 'Jadwal ini sudah penuh');
        }

        // Check if patient already has consultation at this time
        $existing = Consultation::where('patient_id', Auth::user()->id_user)
            ->where('schedule_id', $request->schedule_id)
            ->exists();

        if ($existing) {
            return redirect()->back()->with('error', 'Anda sudah memiliki konsultasi di jadwal ini');
        }

        $doctor = Doctor::findOrFail($request->doctor_id);
        
        $consultation = Consultation::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => Auth::user()->id_user,
            'schedule_id' => $request->schedule_id,
            'datetime' => $request->datetime,
            'status' => 'pending',
            'notes' => $request->notes,
            'fee_paid' => false,
        ]);

        return redirect()->route('pasien.consultations.show', $consultation->id)
            ->with('success', 'Konsultasi berhasil dibuat. Menunggu konfirmasi dokter.');
    }

    public function show($id)
    {
        $consultation = Consultation::findOrFail($id);
        
        // Check authorization
        if ($consultation->patient_id != Auth::user()->id_user) {
            abort(403);
        }

        $consultation->load('doctor', 'schedule');

        return view('pasien.consultations.show', compact('consultation'));
    }

    public function cancel($id)
    {
        $consultation = Consultation::findOrFail($id);
        
        if ($consultation->patient_id != Auth::user()->id_user) {
            abort(403);
        }

        if ($consultation->status == 'completed' || $consultation->status == 'cancelled') {
            return redirect()->back()->with('error', 'Konsultasi tidak dapat dibatalkan');
        }

        // Check if cancellation is allowed (at least 1 hour before)
        if (Carbon::parse($consultation->datetime)->diffInHours(now()) < 1) {
            return redirect()->back()->with('error', 'Konsultasi hanya dapat dibatalkan 1 jam sebelumnya');
        }

        $consultation->update(['status' => 'cancelled']);

        return redirect()->route('pasien.consultations.index')
            ->with('success', 'Konsultasi berhasil dibatalkan');
    }
}
