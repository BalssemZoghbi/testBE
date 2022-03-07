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
            'appareil' => $this->faker->word,
            'reference' => $this->faker->word,
            'elaborateur' => $this->faker->word,
            'client' => $this->faker->word,
            'refClient' => $this->faker->word,
            'created_at' => now()
        ];
    }
}
