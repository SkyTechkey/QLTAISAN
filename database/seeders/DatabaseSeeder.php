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
        DB::table('contents')->insert([
            "title" => "Quan",
            "content" => null,
            "note" => null,
            "user_id" => 1,
            "department_id" => 1,
            "deleted_at" => null,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        DB::table('content_details')->insert([
            [
                "name" => "download (1).jfif",
                "link" => "http://localhost:8000\\files\\1627852918-download-1.jfif",
                "type" => "jfif",
                "size" => "13.72 KB",
                "note" => null,
                "content_id" => 1,
                "department_code" => "13.72 KB",
                "deleted_at" => null,
                "created_at" => now(),
                "updated_at" => now()
              ],
              [
                "name" => "download (2).jfif",
                "link" => "http://localhost:8000\\files\\1627852918-download-2.jfif",
                "type" => "jfif",
                "size" => "5.22 KB",
                "note" => null,
                "content_id" => 1,
                "department_code" => "5.22 KB",
                "deleted_at" => null,
                "created_at" => now(),
                "updated_at" => now()
              ],
              [
                "name" => "download.jfif",
                "link" => "http://localhost:8000\\files\\1627852918-download.jfif",
                "type" => "jfif",
                "size" => "4.27 KB",
                "note" => null,
                "content_id" => 1,
                "department_code" => "4.27 KB",
                "deleted_at" => null,
                "created_at" => now(),
                "updated_at" => now()
              ],
              [
                "name" => "images.jfif",
                "link" => "http://localhost:8000\\files\\1627852918-images.jfif",
                "type" => "jfif",
                "size" => "6.60 KB",
                "note" => null,
                "content_id" => 1,
                "department_code" => "6.60 KB",
                "deleted_at" => null,
                "created_at" => now(),
                "updated_at" => now()
              ],
              [
                "name" => "Internship weekly report_NguyenHongQuan22B.xlsx",
                "link" => "http://localhost:8000\\files\\1627853020-internship-weekly-report-nguyenhongquan22b.xlsx",
                "type" => "xlsx",
                "size" => "55.46 KB",
                "note" => null,
                "content_id" => 1,
                "department_code" => "55.46 KB",
                "deleted_at" => null,
                "created_at" => now(),
                "updated_at" => now()
              ],
              [
                "name" => "NguyenDinhKha - QuanLyVatTu.pptx",
                "link" => "http://localhost:8000\\files\\1627853020-nguyendinhkha-quanlyvattu.pptx",
                "type" => "pptx",
                "size" => "3.16 MB",
                "note" => null,
                "content_id" => 1,
                "department_code" => "3.16 MB",
                "deleted_at" => null,
                "created_at" => now(),
                "updated_at" => now()
              ],
              [
                "name" => "CoverLetter_NguyenDinhKha.docx",
                "link" => "http://localhost:8000\\files\\1627853055-coverletter-nguyendinhkha.docx",
                "type" => "docx",
                "size" => "15.32 KB",
                "note" => null,
                "content_id" => 1,
                "department_code" => "15.32 KB",
                "deleted_at" => null,
                "created_at" => now(),
                "updated_at" => now()
              ],
              [
                "name" => "New Text Document.txt",
                "link" => "http://localhost:8000\\files\\1627853072-new-text-document.txt",
                "type" => "txt",
                "size" => "7 bytes",
                "note" => null,
                "content_id" => 1,
                "department_code" => "7 bytes",
                "deleted_at" => null,
                "created_at" => now(),
                "updated_at" => now()
              ],
              [
                "name" => "CV_NguyenDinhKha.pdf",
                "link" => "http://localhost:8000\\files\\1627853095-cv-nguyendinhkha.pdf",
                "type" => "pdf",
                "size" => "221.38 KB",
                "note" => null,
                "content_id" => 1,
                "department_code" => "221.38 KB",
                "deleted_at" => null,
                "created_at" => now(),
                "updated_at" => now()
              ]
        ]);
    }
}
