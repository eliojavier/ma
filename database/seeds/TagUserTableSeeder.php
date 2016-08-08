<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TagUserTableSeeder extends Seeder{

    public function run(){
        $faker = Faker::create();

        $TagIds = App\Tag::lists('id')->toArray();
        $UserIds = App\User::lists('id')->toArray();

        foreach(range(1,30) as $index){
            DB::table('tag_user')->insert([
                'tag_id' => $faker->randomElement($TagIds),
                'user_id'   => $faker->randomElement($UserIds)
            ]);
        }
    }
}