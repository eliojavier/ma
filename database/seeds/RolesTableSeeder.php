<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RolesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $roles = [
            [
                'name'         => 'admin',
                'display_name' => 'Administrador',
                'description'  => $faker->paragraph()
            ],
            [
                'name'         => 'collaborator',
                'display_name' => 'Colaborador',
                'description'  => $faker->paragraph()
            ],
            [
                'name'         => 'subscriber',
                'display_name' => 'Subscriptor',
                'description'  => $faker->paragraph()
            ]
        ];

        foreach ($roles as $role) {
            App\Role::create($role);
        }
    }
}