<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;

class DoctorScheduleController extends Controller
{
    public function index()
    {
        $doctor = Doctor::where('user_id', auth()->id())->firstOrFail();
        $schedules = $doctor->schedules()->get();
        
        return view('doctor.schedules.index', [
            'schedules' => $schedules,
            'doctor' => $doctor,
        ]);
    }

    public function create()
    {
        $doctor = Doctor::where('user_id', auth()->id())->firstOrFail();
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        
        return view('doctor.schedules.create', [
            'daysOfWeek' => $daysOfWeek,
            'doctor' => $doctor,
        ]);
    }

    public function store(Request $request)
    {
        $doctor = Doctor::where('user_id', auth()->id())->firstOrFail();
        
        $validated = $request->validate([
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_consultations' => 'required|integer|min:1',
        ]);

        $doctor->schedules()->create($validated);

        return redirect()->route('doctor.schedules.index')
            ->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit(DoctorSchedule $schedule)
    {
        $this->authorize('update', $schedule);
        
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        
        return view('doctor.schedules.edit', [
            'schedule' => $schedule,
            'daysOfWeek' => $daysOfWeek,
        ]);
    }

    public function update(Request $request, DoctorSchedule $schedule)
    {
        $this->authorize('update', $schedule);
        
        $validated = $request->validate([
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_consultations' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        $schedule->update($validated);

        return redirect()->route('doctor.schedules.index')
            ->with('success', 'Jadwal berhasil diupdate');
    }

    public function destroy(DoctorSchedule $schedule)
    {
        $this->authorize('delete', $schedule);
        
        $schedule->delete();

        return redirect()->route('doctor.schedules.index')
            ->with('success', 'Jadwal berhasil dihapus');
    }
}
