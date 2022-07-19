<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Nationality;
use App\Models\SkinColor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People>
 */
class PeopleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cpf' => $this->faker->randomNumber(9, true) . $this->faker->randomNumber(2, true),
            'name' => $this->faker->name(),
            'rg' => $this->faker->randomNumber(8),
            'cns' => $this->faker->randomNumber(9, true) . $this->faker->randomNumber(6, true),
            'birth_date' => $this->faker->date('Y-m-d'),
            'mother_name' => $this->faker->name('female'),
            'father_name' => $this->faker->name('male'),
            'unknown_father' => false,
            'gender' => $this->faker->randomElement(['masculino', 'feminino']),
            'nationality' => Nationality::inRandomOrder()->first()->description,
            'skin_color' => SkinColor::inRandomOrder()->first()->description,
            'profession' => $this->faker->word()
        ];
    }

    public function createPeople()
    {
        $id = $this->create()->id;

        Address::factory()->create([
            'people_id' => $id
        ]);

        Contact::factory()->create([
            'people_id' => $id
        ]);
    }
}
