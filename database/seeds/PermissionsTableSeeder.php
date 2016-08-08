<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $permissions = [
            [
                'name'         => 'manage-admins',
                'display_name' => 'Manage Admins',
                'description'  => $faker->paragraph()
            ],
            [
                'name'         => 'create-user',
                'display_name' => 'Create Users',
                'description'  => $faker->paragraph()
            ],
            [
                'name'         => 'edit-users',
                'display_name' => 'Edit Users',
                'description'  => $faker->paragraph()
            ],
            [
                'name'         => 'delete-users',
                'display_name' => 'Delete Users',
                'description'  => $faker->paragraph()
            ]
        ];

        foreach ($permissions as $permission) {
            App\Permission::create($permission);
        }
    }
}