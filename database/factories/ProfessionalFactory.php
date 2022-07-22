<?php

namespace Database\Factories;

use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professional>
 */
class ProfessionalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'people_id' => People::factory()->createPeople(),
            'schedule' => $this->faker->randomElement(['12x36hrs', '20hrs', '40hrs']),
            'scale' => $this->faker->randomElement(['Mensal', 'Plantão']),
            'sector' => $this->faker->word(),
            'admission_date' => $this->faker->date('d/m/Y'),
            'departure_date' => null,
        ];
    }
}
