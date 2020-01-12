<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $faker = Faker\Factory::create();

        foreach (range(1, 5) as $index) {
            User::create([
                'name' => $faker->firstNameMale,
                'email' => Str::random(10) . '@gmail.com',
                'password' => bcrypt('password'),
                'phone' => $faker->randomDigit,
                'terms' => 1,
                'term_id' => 1,
                'terms_accepted_datetime' => date('Y-m-d H:i:s')
            ]);
        }
    }

}
