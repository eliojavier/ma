<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TagPostTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $PostIds = App\Post::lists('id')->toArray();
        $TagIds = App\Tag::lists('id')->toArray();

        foreach (range(1, 30) as $index) {
            DB::table('tag_post')->insert([
                'post_id'     => $faker->randomElement($PostIds),
                'tag_id' => $faker->randomElement($TagIds)
            ]);
        }
    }
}