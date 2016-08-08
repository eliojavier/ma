<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MediaTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();


        foreach (range(1, 5) as $index) {
            App\Media::Create([
                'path'         => $faker->imageUrl($width = 640, $height = 480),
                'display_name' => $faker->word(5),
            ]);
        }
    }
}