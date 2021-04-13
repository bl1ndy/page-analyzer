<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $count = 0;
        while ($count < 5) {
            DB::table('urls')->insert([
                'name' => $faker->url(),
                'created_at' => $faker->date(),
                'updated_at' => $faker->date(),
            ]);

            $count += 1;
        }
    }
}
