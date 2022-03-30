<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Donnees\Projet;
use App\Models\User;

class ProjetFactory extends Factory
{
    protected $model = Projet::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'appareil' => $this->faker->word,
            'reference' => $this->faker->word,
            'temperatureMax' => $this->faker->randomDigit,
            'attitudeMax' => $this->faker->randomDigit,
            'type' => $this->faker-> randomElement(['cabine','poteau','h61','h59','sec']),
            'remplissage' => $this->faker-> randomElement(['à matelas d`air','integral','respirant']),
            'installation' => $this->faker-> randomElement(['interieure', 'exterieure','interieur&exterieure']),
            'montage' => $this->faker-> randomElement( ['sur galets','sur pieds']),
            'echangeurs' => $this->faker-> randomElement(['ondes','radiateurs','parois']),
            'dielectrique' => $this->faker-> randomElement(['huile biodegradable','huile minerale inhibée','huile siliconne','huile minerale non inhibée']),
            'fonctionnement' => $this->faker-> randomElement(['abaisseur','elevateur','isolement']),
            'refroidissement' => $this->faker-> randomElement(['onan','onaf']),
            'client' => $this->faker->word,
            'refClient' => $this->faker->word,
            'user_id' =>User::get('id')->random(),
            'created_at' => now()
        ];
    }
}
