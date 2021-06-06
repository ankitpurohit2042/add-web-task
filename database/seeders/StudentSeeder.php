<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $gender = $faker->randomElement(['male', 'female']);

    	foreach (range(1,20) as $index) {
            DB::table('students')->insert([
                'studentName' => $faker->name($gender),
                'grade' => 'A',
                'image' => $faker->image('storage/app/public/images/studentImages',400,300),
                'address' => $faker->address,
                'city' => $faker->city,
                'country' => $faker->country,
                'state' => $faker->state,
                'dateOfBirth' => $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
        }
    }
}
