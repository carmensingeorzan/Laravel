<?php

use Illuminate\Database\Seeder;
use App\TermService;

class TermServicesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();

        TermService::create([
            'administrative_name' => $faker->firstNameMale,
            'content' => $faker->text,
            'published' => 1,
            'publication_date' => date('Y-m-d H:i:s')
        ]);

        TermService::create([
            'administrative_name' => $faker->firstNameMale,
            'content' => $faker->text,
            'published' => 0,
            'publication_date' => date('Y-m-d H:i:s')
        ]);
    }

}
