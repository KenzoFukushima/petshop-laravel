<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);

        Pet::factory()->create([
            'id_dono' => 1,
            'nome' => 'nome',
            'especie' => 'especie',
            'raça' => 'raça',
            'peso' => 8.5,
            'idade' => 5,
        ]);
    }
}   