<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $users= [
            [
                'first_name' => 'Enrique',
                'last_name' => 'La Cruz',
                'email' => 'lacruzenrique@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'first_name' => 'Hansel',
                'last_name' => 'Lander',
                'email' => 'hansel.lander@hlandagency.com',
                'password' => bcrypt('123456'),
            ],
            [
                'first_name' => 'José',
                'last_name' => 'Grillo',
                'email' => 'ingjosegrillo@gmail.com ',
                'password' => bcrypt('123456'),
            ],
            [
                'first_name' => 'Carlos',
                'last_name' => 'Urbina',
                'email' => 'carlosluisurbina@gmail.com',
                'password' => bcrypt('123456'),
            ]
        ];

        foreach($users as $user){
            App\User::create($user);
        }

    }
}