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
        $this->call(UserSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        
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
            "type_id" => 1,
            "deleted_at" => null,
            "created_at" => now(),
            "updated_at" => now()
        ]);
    }
}
