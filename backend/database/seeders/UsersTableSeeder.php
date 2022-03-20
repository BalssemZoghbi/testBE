<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();
        // DB::table('users')->insert([
        //     'name' => 'John Doe',
        //     'email' => 'john@doe.com',
        //     'password' => Hash::make('123456')
        // ]);
    }
}
