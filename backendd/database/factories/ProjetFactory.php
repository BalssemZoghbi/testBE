<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Projet;
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
            'appreil' => $this->faker->word,
            'reference' => $this->faker->word,
            'temperatureMax' => $this->faker->randomDigit,
            'attitudeMax' => $this->faker->randomDigit,
            'type' => $faker-> randomElement(),
            'remplissage' => $faker-> randomElement(),
            'installation' => $faker-> randomElement(),
            'montage' => $faker-> randomElement(),
            'echangeurs' => $faker-> randomElement(),
            'dielectrique' => $faker-> randomElement(),
            'fonctionnement' => $faker-> randomElement(),
            'refroidissement' => $faker-> randomElement(),
            'client' => $this->faker->word,
            'refClient' => $this->faker->word,
            'created_at' => now()
        ];
    }
}
