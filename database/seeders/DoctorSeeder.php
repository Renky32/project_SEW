<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 sample doctors with schedules and consultations
        \App\Models\Doctor::factory(5)->create()->each(function ($doctor) {
            // Create schedules for each doctor
            $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            foreach ($daysOfWeek as $day) {
                \App\Models\DoctorSchedule::create([
                    'doctor_id' => $doctor->id,
                    'day_of_week' => $day,
                    'start_time' => '09:00',
                    'end_time' => '17:00',
                    'max_consultations' => 10,
                    'status' => 'active',
                ]);
            }
        });
    }
}
