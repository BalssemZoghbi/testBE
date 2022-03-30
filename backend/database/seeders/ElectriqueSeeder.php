<?php

namespace Database\Seeders;

use App\Models\Donnees\Electrique;
use Illuminate\Database\Seeder;

class ElectriqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Electrique::factory()->count(10)->create();
    }
}
