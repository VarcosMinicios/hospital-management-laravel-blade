<?php

namespace Database\Factories;

use App\Models\People;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cep' => $this->faker->randomNumber(8),
            'street_type' => $this->faker->randomElement(['Rua', 'Avenida', 'Travessa', 'Praça', 'Alameda']),
            'street' => $this->faker->streetName(),
            'number' => $this->faker->randomNumber(4),
            'state' => State::inRandomOrder()->first()->abbreviation,
            'city' => $this->faker->city,
            'neighborhood' => $this->faker->word(),
            'ibge' => $this->faker->randomNumber(7, true),
            'reference' => $this->faker->text(50),
            'complement' => $this->faker->text(50)
        ];
    }
}
