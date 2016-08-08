<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $UserIds = App\User::lists('id')->toArray();
        $CategoryIds = App\Category::lists('id')->toArray();
        $MediaIds = App\Media::lists('id')->toArray();

        foreach (range(1, 15) as $index) {
            App\Post::Create([
                'title'          => $faker->word(),
                'slug'           => $faker->slug(),
                'body'           => $faker->paragraph(1),
                'author'         => $faker->word(5),
                'published_date' => $faker->dateTime(),
                'user_id'        => $faker->randomElement($UserIds),
                'category_id'    => $faker->randomElement($CategoryIds),
                'excerpt'        => $faker->sentence(3),
                'media_id'       => $faker->randomElement($MediaIds),
            ]);
        }
    }
}