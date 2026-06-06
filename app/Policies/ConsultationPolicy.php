<?php

namespace App\Policies;

use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\User;

class ConsultationPolicy
{
    public function view(User $user, Consultation $consultation): bool
    {
        $doctor = Doctor::where('user_id', $user->id)->first();
        return $doctor && $consultation->doctor_id === $doctor->id;
    }

    public function update(User $user, Consultation $consultation): bool
    {
        $doctor = Doctor::where('user_id', $user->id)->first();
        return $doctor && $consultation->doctor_id === $doctor->id;
    }
}
