<?php

namespace Database\Factories;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_dono' => fake()->numberBetween(1, 10),
            'nome' => fake()->firstName(),
            'especie' => fake()->randomElement(['Cachorro', 'Gato', 'Ave', 'Coelho']),
            'raça' => fake()->word(),
            'peso' => fake()->randomFloat(2, 1, 50),
            'idade' => fake()->dateTimeBetween('-15 years', '-1 months')->format('Y-m-d'),
        ];
    }
}