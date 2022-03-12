<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Projet;
class ProjetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Projet::factory()->count(10)->create();
    }
}
