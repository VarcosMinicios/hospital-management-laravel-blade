<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\People;
use App\Models\Professional;
use App\Models\Reception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reception>
 */
class ReceptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'people_id' => $this->faker->randomElement([People::factory()->createPeople(), People::inRandomOrder()->first()->id]),
            'professional_id' => $this->faker->randomElement([Professional::factory()->create()->id, Professional::inRandomOrder()->first()->id]),
            'doctor_id' => $this->faker->randomElement([Doctor::factory()->create()->id, Doctor::inRandomOrder()->first()->id]),
            'nurse_id' => $this->faker->randomElement([Nurse::factory()->create()->id, Nurse::inRandomOrder()->first()->id]),
            'admission_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'diagnosis' => $this->faker->word(),
            'dependency' => $this->faker->randomElement(Reception::getDependencies()),
            'clinic' => $this->faker->randomElement(Reception::getClinics())
        ];
    }
}
