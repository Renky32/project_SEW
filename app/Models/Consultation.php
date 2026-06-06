<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultation extends Model
{
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'doctor_schedule_id',
        'consultation_datetime',
        'status',
        'notes',
        'doctor_notes',
        'fee_paid',
    ];

    protected $casts = [
        'consultation_datetime' => 'datetime',
        'fee_paid' => 'decimal:2',
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(DoctorSchedule::class, 'doctor_schedule_id');
    }
}

