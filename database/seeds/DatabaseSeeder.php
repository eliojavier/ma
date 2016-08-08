<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    private $tables = [
        'users',
        'roles',
        'role_user',
        'permissions',
        'permission_role',
        'categories',
        'tags',
        'posts',
        'tag_post',
        'tag_user',
        'media'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

//        $this->call(MediaTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
////        $this->call(PostsTableSeeder::class);
//        $this->call(TagsTableSeeder::class);
//        $this->call(TagPostTableSeeder::class);
//        $this->call(TagUserTableSeeder::class);

    }

    public function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
