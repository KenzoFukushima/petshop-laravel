<?php

namespace Database\Factories;

use App\Models\Dono;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class DonoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telefone' => fake()->numerify('(##) #####-####'),
            'cpf' => fake()->unique()->numerify('###.###.###-##'),
            'endereco' => fake()->address(),
        ];
    }
}
