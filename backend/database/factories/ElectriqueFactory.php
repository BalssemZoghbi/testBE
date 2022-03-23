<?php

namespace Database\Factories;

use App\Models\Electrique;
use Illuminate\Database\Eloquent\Factories\Factory;

class ElectriqueFactory extends Factory
{
    protected $model = Electrique::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'frequence' => $this->faker-> randomElement([30,40,50,60]),
            'pn' => $this->faker->randomDigit,
            'u1n' => $this->faker->randomDigit,
            'u2o' => $this->faker->randomDigit,
            'couplagePrimaire' => $this->faker->word,
            'couplageSecondaire' => $this->faker->word,
            'indiceHoraire' => $this->faker-> randomElement([0,6]),
            'couplage' => $this->faker->word,
            'priseSoustractive' => $this->faker->randomDigit,
            'priseAdditive' => $this->faker->randomDigit,
            'echelonSousctractive' => $this->faker->randomFloat,
            'echelonAdditive' => $this->faker->randomFloat,
            'variation' => $this->faker->word,
            'puissance' => $this->faker->randomDigit,
            'PrimaireUligne' => $this->faker->randomDigit,
            'PrimaireUPhase' => $this->faker->randomDigit,
            'PrimaireIligne' => $this->faker->randomFloat,
            'PrimaireIPhase' => $this->faker->randomFloat,
            'secondaireUligne' => $this->faker->randomDigit,
            'secondaireUPhase' => $this->faker->randomDigit,
            'secondaireIligne' => $this->faker->randomDigit,
            'secondaireIPhase' => $this->faker->randomDigit,
            'created_at' => now()
        ];
    }
}
