<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TagsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $CategoriesIds = App\Category::lists('id')->toArray();

        foreach (range(1, 40) as $index) {
            App\Tag::Create([
                'slug'         => $faker->sentence(5),
                'display_name' => $faker->word(5),
                'category_id'  => $faker->randomElement($CategoriesIds)
            ]);
        }
    }
}