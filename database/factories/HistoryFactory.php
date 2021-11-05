<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' => $this->faker->numberBetween(1, 30),
            'doctor_id' => $this->faker->numberBetween(1, 30),
            'comment' => $this->faker->paragraph(6)
        ];
    }
}
