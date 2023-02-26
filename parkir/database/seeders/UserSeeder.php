<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        DB::table('users')->insert([
            'email' => 'andrew@gmail.com',
            'password' => bcrypt('andrew123'),
            'role' => 1

        ]);

        DB::table('users')->insert([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 2

        ]);

    }
}
