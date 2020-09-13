<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Dcat;
use DB;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        Dcat\Admin\Models\Menu::truncate();
        Dcat\Admin\Models\Menu::insert(
            [
                [
                    "id" => 1,
                    "parent_id" => 0,
                    "order" => 1,
                    "title" => "Index",
                    "icon" => "feather icon-bar-chart-2",
                    "uri" => "/",
                    "created_at" => "2020-09-13 16:52:37",
                    "updated_at" => NULL
                ],
                [
                    "id" => 2,
                    "parent_id" => 0,
                    "order" => 2,
                    "title" => "Admin",
                    "icon" => "feather icon-settings",
                    "uri" => "",
                    "created_at" => "2020-09-13 16:52:37",
                    "updated_at" => NULL
                ],
                [
                    "id" => 3,
                    "parent_id" => 2,
                    "order" => 3,
                    "title" => "Users",
                    "icon" => "",
                    "uri" => "auth/users",
                    "created_at" => "2020-09-13 16:52:37",
                    "updated_at" => NULL
                ],
                [
                    "id" => 6,
                    "parent_id" => 2,
                    "order" => 6,
                    "title" => "Menu",
                    "icon" => "",
                    "uri" => "auth/menu",
                    "created_at" => "2020-09-13 16:52:37",
                    "updated_at" => NULL
                ],
                [
                    "id" => 7,
                    "parent_id" => 2,
                    "order" => 7,
                    "title" => "Operation log",
                    "icon" => "",
                    "uri" => "auth/logs",
                    "created_at" => "2020-09-13 16:52:37",
                    "updated_at" => NULL
                ],
                [
                    "id" => 8,
                    "parent_id" => 0,
                    "order" => 8,
                    "title" => "学校管理",
                    "icon" => NULL,
                    "uri" => "/school",
                    "created_at" => "2020-09-13 17:02:49",
                    "updated_at" => "2020-09-13 17:02:49"
                ],
                [
                    "id" => 9,
                    "parent_id" => 0,
                    "order" => 9,
                    "title" => "宿舍管理",
                    "icon" => NULL,
                    "uri" => "/dorm",
                    "created_at" => "2020-09-13 17:03:15",
                    "updated_at" => "2020-09-13 17:03:15"
                ],
                [
                    "id" => 10,
                    "parent_id" => 0,
                    "order" => 10,
                    "title" => "学生管理",
                    "icon" => NULL,
                    "uri" => "/student",
                    "created_at" => "2020-09-13 17:03:37",
                    "updated_at" => "2020-09-13 17:03:37"
                ],
                [
                    "id" => 11,
                    "parent_id" => 0,
                    "order" => 11,
                    "title" => "班次管理",
                    "icon" => NULL,
                    "uri" => "/shift",
                    "created_at" => "2020-09-13 17:03:55",
                    "updated_at" => "2020-09-13 17:03:55"
                ]
            ]
        );

        Dcat\Admin\Models\Permission::truncate();
        Dcat\Admin\Models\Permission::insert(
            [
                [
                    "id" => 1,
                    "name" => "Auth management",
                    "slug" => "auth-management",
                    "http_method" => "",
                    "http_path" => "",
                    "order" => 1,
                    "parent_id" => 0,
                    "created_at" => "2020-09-13 16:52:37",
                    "updated_at" => NULL
                ],
                [
                    "id" => 2,
                    "name" => "Users",
                    "slug" => "users",
                    "http_method" => "",
                    "http_path" => "/auth/users*",
                    "order" => 2,
                    "parent_id" => 1,
                    "created_at" => "2020-09-13 16:52:37",
                    "updated_at" => NULL
                ],
                [
                    "id" => 3,
                    "name" => "Roles",
                    "slug" => "roles",
                    "http_method" => "",
                    "http_path" => "/auth/roles*",
                    "order" => 3,
                    "parent_id" => 1,
                    "created_at" => "2020-09-13 16:52:37",
                    "updated_at" => NULL
                ],
                [
                    "id" => 4,
                    "name" => "Permissions",
                    "slug" => "permissions",
                    "http_method" => "",
                    "http_path" => "/auth/permissions*",
                    "order" => 4,
                    "parent_id" => 1,
                    "created_at" => "2020-09-13 16:52:37",
                    "updated_at" => NULL
                ],
                [
                    "id" => 5,
                    "name" => "Menu",
                    "slug" => "menu",
                    "http_method" => "",
                    "http_path" => "/auth/menu*",
                    "order" => 5,
                    "parent_id" => 1,
                    "created_at" => "2020-09-13 16:52:37",
                    "updated_at" => NULL
                ],
                [
                    "id" => 6,
                    "name" => "Operation log",
                    "slug" => "operation-log",
                    "http_method" => "",
                    "http_path" => "/auth/logs*",
                    "order" => 6,
                    "parent_id" => 1,
                    "created_at" => "2020-09-13 16:52:37",
                    "updated_at" => NULL
                ]
            ]
        );

        Dcat\Admin\Models\Role::truncate();
        Dcat\Admin\Models\Role::insert(
            [
                [
                    "id" => 1,
                    "name" => "Administrator",
                    "slug" => "administrator",
                    "created_at" => "2020-09-13 16:52:37",
                    "updated_at" => "2020-09-13 16:52:37"
                ]
            ]
        );

        // pivot tables
        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [

            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [

            ]
        );

        // finish
    }
}
