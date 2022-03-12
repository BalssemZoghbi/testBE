<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Projet;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       Projet::factory(10)->create();
    }
}
