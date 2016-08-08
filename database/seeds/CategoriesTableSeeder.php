<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder {

    public function run()
    {

        $categories = [
            [
                'slug'         => 'nutrition',
                'display_name' => 'Nutrición',
                'description'  => 'Nutricion categoría.',
                'style'        => 'motivapp-red'
            ],
            [
                'slug'         => 'health',
                'display_name' => 'Salud',
                'description'  => 'Mollitia consequatur est molestias.',
                'style'        => 'motivapp-green'
            ],
            [
                'slug'         => 'personal-grow',
                'display_name' => 'Crecimiento Personal',
                'description'  => 'Qui molestias ut corrupti.',
                'style'        => 'motivapp-purple',
            ],
            [
                'slug'         => 'physical-activity',
                'display_name' => 'Actividad Física',
                'description'  => 'Repellendus consequatur aut.',
                'style'        => 'motivapp-blue',
            ]
        ];

        foreach ($categories as $category) {
            App\Category::create($category);
        }
    }
}