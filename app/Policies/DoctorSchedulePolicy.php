<?php

namespace App\Policies;

use App\Models\DoctorSchedule;
use App\Models\Doctor;
use App\Models\User;

class DoctorSchedulePolicy
{
    public function update(User $user, DoctorSchedule $doctorSchedule): bool
    {
        $doctor = Doctor::where('user_id', $user->id)->first();
        return $doctor && $doctorSchedule->doctor_id === $doctor->id;
    }

    public function delete(User $user, DoctorSchedule $doctorSchedule): bool
    {
        $doctor = Doctor::where('user_id', $user->id)->first();
        return $doctor && $doctorSchedule->doctor_id === $doctor->id;
    }
}
