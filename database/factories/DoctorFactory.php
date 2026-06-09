<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'name' => $this->faker->name(),
            'specialty' => $this->faker->randomElement(['Umum', 'Gigi', 'Jantung', 'Bedah', 'Saraf', 'Psikologi']),
            'phone' => $this->faker->phoneNumber(),
            'license_number' => 'LIC' . $this->faker->unique()->numerify('####'),
            'bio' => $this->faker->paragraph(),
            'consultation_fee' => $this->faker->numberBetween(150000, 500000),
            'status' => 'active',
        ];
    }
}
