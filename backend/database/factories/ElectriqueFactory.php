<?php

namespace Database\Factories;

use App\Models\Donnees\Electrique;
use App\Models\Donnees\TensionElectrique;
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
            'colonnes' => $this->faker-> randomElement(['3','4']),
            'frequence' => $this->faker-> randomElement(['50','60']),
            'pn' => $this->faker->randomDigit,
            'u1n' => $this->faker->randomDigit,
            'u2o' => $this->faker->randomDigit,
            'couplagePrimaire' => $this->faker-> randomElement(['YN','Y','D']),
            'couplageSecondaire' => $this->faker-> randomElement(['d','zn','z','yn','y']),
            'indiceHoraire' => $this->faker-> randomElement(['0','1','2','3','4','5','6','7','8','9','10','11']),
            'couplage' => $this->faker->word,
            'classeU1' =>$this->faker->randomDigit,
            'tenueFr1' =>$this->faker->randomDigit,
            'tenueChoc1' =>$this->faker->randomDigit,
            'tenueFr2' =>$this->faker->randomDigit,
            'tenueChoc2' =>$this->faker->randomDigit,
            'classeU2' =>$this->faker->randomDigit,
            'priseSoustractive' => $this->faker->randomDigit,
            'priseAdditive' => $this->faker->randomDigit,
            'echelonSousctractive' => $this->faker->randomFloat,
            'echelonAdditive' => $this->faker->randomFloat,
            'puissance' => $this->faker->randomDigit,
            'PrimaireUligne' => $this->faker->randomDigit,
            'PrimaireUPhase' => $this->faker->randomDigit,
            'PrimaireIligne' => $this->faker->randomFloat,
            'PrimaireIPhase' => $this->faker->randomFloat,
            'secondaireUligne' => $this->faker->randomDigit,
            '' => $this->faker->randomDigit,
            'secondaireIligne' => $this->faker->randomDigit,
            'secondaireIPhase' => $this->faker->randomDigit,
            'nbrePosition' => $this->faker->randomDigit,
            'created_at' => now()
        ];
    }
}
