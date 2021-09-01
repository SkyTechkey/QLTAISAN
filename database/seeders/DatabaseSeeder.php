<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {


        DB::table('units')->insert([
            [
                'name' => 'Sky',
                'email'=> 'Sky@technology.org',
                'address'=> 'Đà Nẵng',
                'phone' => '0341125674',
                'representative' => 'Mr.Jonh',
                'position' => 'director',
                'image'=>"/files/unit_avt/unit_avt.jpg"
            ],
        ]);
        DB::table('branches')->insert([
            ['name' => 'Chi nhánh 1',
             'unit_id' => 1,
             'email' => 'chinhanh1@gmail.com',
             'phone' => '0321456789',
             'address'=>'Đà Nẵng'
            ],
            ['name' => 'Chi nhánh 2',
            'unit_id' => 1,
            'email' => 'chinhanh2@gmail.com',
            'phone' => '03298765421',
            'address'=>'Huế'
           ],
           ['name' => 'Chi nhánh 3',
           'unit_id' => 1,
           'email' => 'chinhanh3@gmail.com',
           'phone' => '03298761111',
           'address'=>'Sài Gòn'
          ],
        ]);
        DB::table('departments')->insert([
            ['department_code' => 'pb1', 'name' => 'Develop department', 'branch_id' => 1],
            ['department_code' => 'pb2', 'name' => 'Sale department', 'branch_id' => 1],
            ['department_code' => 'pb3', 'name' => 'Training department', 'branch_id' => 2],
            ['department_code' => 'pb4', 'name' => 'Marketing department', 'branch_id' => 2],
            ['department_code' => 'pb5', 'name' => 'Human resouces department', 'branch_id' => 3],
        ]);
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'department_id' => null,
                'status'=>true,
                'address'=>'Đà Nẵng',
                'phone' => '095113114',
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'user',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123456'),
                'department_id' => 1,
                'status'=>true,
                'address'=>'Đà Nẵng',
                'phone' => '095113115',
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'user1',
                'username' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('123456'),
                'department_id' => 2,
                'status'=>true,
                'address'=>'Đà Nẵng',
                'phone' => '095113114',
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'user2',
                'username' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('123456'),
                'department_id' => 3,
                'status'=>false,
                'address'=>'Đà Nẵng',
                'phone' => '095113114',
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
        ]);
        DB::table('permissions')->insert([
            ['name' => 'view_user'],
            ['name' => 'create_user'],
            ['name' => 'update_user'],
            ['name' => 'delete_user'],

            ['name' => 'view_unit'],
            ['name' => 'update_unit'],

            ['name' => 'view_all_branch'],
            ['name' => 'view_branch'],
            ['name' => 'create_branch'],
            ['name' => 'update_branch'],
            ['name' => 'delete_branch'],

            ['name' => 'view_department'],
            ['name' => 'create_department'],
            ['name' => 'update_department'],
            ['name' => 'delete_department'],

            ['name' => 'view_assets'],
            ['name' => 'create_assets'],
            ['name' => 'update_assets'],
            ['name' => 'delete_assets'],

            ['name' => 'view_role'],
            ['name' => 'create_role'],
            ['name' => 'update_role'],
            ['name' => 'delete_role'],

            ['name' => 'view_permission'],
            ['name' => 'create_permission'],
            ['name' => 'update_permission'],
            ['name' => 'delete_permission'],

            ['name' => 'view_provide'],
            ['name' => 'create_provide'],
            ['name' => 'update_provide'],
            ['name' => 'delete_provide'],

            ['name' => 'view_property_type'],
            ['name' => 'create_property_type'],
            ['name' => 'update_property_type'],
            ['name' => 'delete_property_type'],

            
            ['name' => 'view_property_group'],
            ['name' => 'create_property_group'],
            ['name' => 'update_property_group'],
            ['name' => 'delete_property_group'],
        ]);
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'user'],
            ['name' => 'admin-branch'],
            ['name' => 'admin-department'],
            ['name' => 'manager-branch'],
            ['name' => 'manager-department'],
            
        ]);
        DB::table('role_user')->insert([
            ['role_id' => 1, 'user_id' => 1],
            ['role_id' => 2, 'user_id' => 2],
            ['role_id' => 2, 'user_id' => 3],
            ['role_id' => 2, 'user_id' => 4],
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
            ['permission_id' => 15, 'role_id' => 1],
            ['permission_id' => 16, 'role_id' => 1],
            ['permission_id' => 17, 'role_id' => 1],
            ['permission_id' => 18, 'role_id' => 1],
            ['permission_id' => 19, 'role_id' => 1],
            ['permission_id' => 20, 'role_id' => 1],
            ['permission_id' => 21, 'role_id' => 1],
            ['permission_id' => 22, 'role_id' => 1],
            ['permission_id' => 23, 'role_id' => 1],
            ['permission_id' => 24, 'role_id' => 1],
            ['permission_id' => 25, 'role_id' => 1],
            ['permission_id' => 26, 'role_id' => 1],
            ['permission_id' => 27, 'role_id' => 1],
            ['permission_id' => 28, 'role_id' => 1],
            ['permission_id' => 29, 'role_id' => 1],
            ['permission_id' => 30, 'role_id' => 1],
            ['permission_id' => 31, 'role_id' => 1],
            ['permission_id' => 32, 'role_id' => 1],
            ['permission_id' => 33, 'role_id' => 1],
            ['permission_id' => 34, 'role_id' => 1],
            ['permission_id' => 35, 'role_id' => 1],
            ['permission_id' => 36, 'role_id' => 1],
            ['permission_id' => 37, 'role_id' => 1],
            ['permission_id' => 38, 'role_id' => 1],
            ['permission_id' => 39, 'role_id' => 1],
            ['permission_id' => 7, 'role_id' => 2],
            ['permission_id' => 8, 'role_id' => 2],
        ]);
        DB::table('provide')->insert([
            ['code' => 'M127', 'name' => 'khong biet', 'phone' => '012345','address' => 'Da Nang'],
            ['code' => 'MOU49', 'name' => 'khong biet', 'phone' => '123456','address' => 'Da Nang'],
            ['code' => 'D238', 'name' => 'Khong biet', 'phone' => '234567','address' => 'Ha Noi'],
            ['code' => 'KBD57', 'name' => 'Khong biet', 'phone' => '345678','address' => 'Ha Noi'],
        ]);
        DB::table('property_type')->insert([
            ['name' => 'Tài sản cố định', 'note' => 'xai ok'],
            ['name' => 'Tài sản không cố định', 'note' => 'xai ok'],
        ]);
        DB::table('property_group')->insert([
            ['name' => 'máy tính','code'=>'MT', 'note' => 'xai ok'],
            ['name' => 'sinh hoạt','code'=>'SH', 'note' => 'xai ok'],
            ['name' => 'học tập','code'=>'HT', 'note' => 'xai ok'],
        ]);
       
        // for($i = 0; $i<1000;$i++){
        DB::table('assets')->insert([
                [
                    'code'=>'code1',
                    'name'=>'tài sản ',
                    'usage_status'=>'tốt',
                    'date_purchase'=>"2021-01-01",
                    'warranty_expires'=>"2021-01-01",
                    'date_liquidation'=>"2021-01-01",
                    'first_value'=>1000000000,
                    'residual_value'=>100000 ,
                    'depreciation_per_year'=>10,
                    'depreciation'=>10000,
                    'department_id'=>random_int(1,3),
                    'provide_id'=>random_int(1,3),
                    'property_type_id'=>random_int(1,2),
                    'property_group_id'=>random_int(1,3),
                ],
        ]);
    //   }
            DB::table('receipt_notes')->insert([
                [
                    'code'=>'note1',
                    'deliver'=>'Nguyễn Quân',
                    'position'=>'quản lý kho',
                    'location'=>'Đà nẵng',
                    'user_id' => 1,
                    'date'=> "2021-01-01",
                    'note' => 'đây là ghi chú'                        
                ],
            ]);
            DB::table('delivery_notes')->insert([
                [
                    'code'=>'note1',
                    'receiver'=>'Đình Kha',
                    'position'=>'quản lý kho',
                    'location'=>'Đà nẵng',
                    'user_id' => 2,
                    'date'=> "2021-01-01",
                    'note' => 'đây là ghi chú'                        
                ],
        ]);
        DB::table('assets_details')->insert([
            [
                'asset_id'=> 1,
                'accessory_name'=>'thành phần 1',
                'value'=>1000000,
                'tech_info'=>'kĩ thuật cao',                     
            ],
            [
                'asset_id'=> 1,
                'accessory_name'=>'thành phần 2',
                'value'=>2000000,
                'tech_info'=>'kĩ thuật cao',                     
            ],
            [
                'asset_id'=> 1,
                'accessory_name'=>'thành phần 3',
                'value'=>3000000,
                'tech_info'=>'kĩ thuật cao',                     
            ],
        ]);

        DB::table('repair_costs')->insert([
            [
                'asset_id'=> 1,
                'provide_id'=> 1,
                'cost'=>1000000,
                'date'=>"2021-01-01",
                'details'=>'sửa thành phần 2',                     
            ],
            [
                'asset_id'=> 1,
                'provide_id'=> 1,
                'cost'=>330000,
                'date'=>"2021-01-01",
                'details'=>'sửa thành phần 1',                     
            ],
            [
                'asset_id'=> 1,
                'provide_id'=> 1,
                'cost'=>200000,
                'date'=>"2021-01-01",
                'details'=>'sửa thành phần 3',                     
            ],
        ]);
        DB::table('detail_delivery_notes')->insert([
            [
                'asset_id'=> 1,
                'PX_id'=>1,
                'amount'=> 1,
                'unit_price'=>1000000,
                'total'=>1000000,                   
            ],
            [
                'asset_id'=> 1,
                'PX_id'=>1,
                'amount'=> 2,
                'unit_price'=>1000000,
                'total'=>2000000,                   
            ],
           
        ]);
        DB::table('detail_receipt_notes')->insert([
            [
                'asset_id'=> 1,
                'PN_id'=>1,
                'amount'=> 1,
                'unit_price'=>1000000,
                'total'=>1000000,                   
            ],
            [
                'asset_id'=> 1,
                'PN_id'=>1,
                'amount'=> 2,
                'unit_price'=>1000000,
                'total'=>2000000,                   
            ],
           
        ]);
    }
}