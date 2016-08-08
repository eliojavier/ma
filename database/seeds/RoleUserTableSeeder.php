<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoleUserTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $UserIds = App\User::lists('id')->toArray();
        //$RoleIds = App\Role::lists('id')->toArray();

        foreach ($UserIds as $id){
            DB::table('role_user')->insert([
                'user_id' => $id,
                'role_id' => 1//$faker->randomElement($RoleIds)
            ]);
        }
    }
}