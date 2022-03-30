<?php

namespace Database\Seeders;

use App\Models\Donnees\Projet ;
use App\Models\Donnees\Electrique;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Electrique::factory()->count(10)->create();
        Projet::factory()->count(10)->create();
    }
}
