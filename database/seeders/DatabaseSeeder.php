<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('departments')->insert([
            ['department_code' => 'dp1', 'name' => 'Develop department'],
            ['department_code' => 'db2', 'name' => 'Sale department'],
            ['department_code' => 'db3', 'name' => 'Training department'],
            ['department_code' => 'db4', 'name' => 'Marketing department'],
            ['department_code' => 'db5', 'name' => 'Human resouces department'],
        ]);
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'department_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
                'department_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
        ]);
        DB::table('permissions')->insert([
            ['name' => 'view_content'],
            ['name' => 'create_content'],
            ['name' => 'update_content'],
            ['name' => 'delete_content'],
            ['name' => 'force_delete_content'],
            
            ['name' => 'view_user'],
            ['name' => 'create_user'],
            ['name' => 'update_user'],
            ['name' => 'delete_user'],
            ['name' => 'change_role'],

            ['name' => 'view_department'],
            ['name' => 'create_department'],
            ['name' => 'update_department'],
            ['name' => 'delete_department'],
        ]);
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'user'],
            ['name' => 'manager'],
            ['name' => 'editor'],
        ]);
        
        DB::table('role_user')->insert([
            ['role_id' => 1, 'user_id' => 1],
            ['role_id' => 2, 'user_id' => 2],
        ]);
        DB::table('permission_role')->insert([
            ['permission_id' => 1, 'role_id' => 1],
            ['permission_id' => 2, 'role_id' => 1],
            ['permission_id' => 3, 'role_id' => 1],
            ['permission_id' => 4, 'role_id' => 1],
            ['permission_id' => 5, 'role_id' => 1],
            ['permission_id' => 6, 'role_id' => 1],
            ['permission_id' => 7, 'role_id' => 1],
            ['permission_id' => 8, 'role_id' => 1],
            ['permission_id' => 9, 'role_id' => 1],
            ['permission_id' => 10, 'role_id' => 1],
            ['permission_id' => 11, 'role_id' => 1],
            ['permission_id' => 12, 'role_id' => 1],
            ['permission_id' => 13, 'role_id' => 1],
            ['permission_id' => 14, 'role_id' => 1],
            ['permission_id' => 1, 'role_id' => 2],
        ]);

        DB::table('content_types')->insert(
            [
                ["name" => "image","created_at" => now(),"updated_at" => now()],
                ["name" => "music","created_at" => now(),"updated_at" => now()],
                ["name" => "video","created_at" => now(),"updated_at" => now()],
            ]
           
        );

        DB::table('contents')->insert([
            "title" => "Dev",
            "content" => null,
            "note" => null,
            "user_id" => 1,
            "department_id" => 1,
            "content_type_id" => 1,
            "deleted_at" => null,
            "created_at" => now(),
            "updated_at" => now()
        ]);
    }
}
