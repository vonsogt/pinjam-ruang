<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $admin_menu = array(
            0 =>
            array(
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Dasbor',
                'icon' => 'fa-dashboard',
                'uri' => '/',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array(
                'id' => 2,
                'parent_id' => 0,
                'order' => 5,
                'title' => 'Admin',
                'icon' => 'fa-tasks',
                'uri' => '',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-08-04 22:22:42',
            ),
            2 =>
            array(
                'id' => 3,
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Users',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-08-04 22:22:42',
            ),
            3 =>
            array(
                'id' => 4,
                'parent_id' => 2,
                'order' => 7,
                'title' => 'Roles',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-08-04 22:22:42',
            ),
            4 =>
            array(
                'id' => 5,
                'parent_id' => 2,
                'order' => 8,
                'title' => 'Permission',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-08-04 22:22:42',
            ),
            5 =>
            array(
                'id' => 6,
                'parent_id' => 2,
                'order' => 9,
                'title' => 'Menu',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-08-04 22:22:42',
            ),
            6 =>
            array(
                'id' => 7,
                'parent_id' => 2,
                'order' => 10,
                'title' => 'Operation log',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-08-04 22:22:42',
            ),
            7 =>
            array(
                'id' => 8,
                'parent_id' => 0,
                'order' => 11,
                'title' => 'Helpers',
                'icon' => 'fa-gears',
                'uri' => '',
                'permission' => NULL,
                'created_at' => '2021-08-04 22:20:58',
                'updated_at' => '2021-08-04 22:22:42',
            ),
            8 =>
            array(
                'id' => 9,
                'parent_id' => 8,
                'order' => 12,
                'title' => 'Scaffold',
                'icon' => 'fa-keyboard-o',
                'uri' => 'helpers/scaffold',
                'permission' => NULL,
                'created_at' => '2021-08-04 22:20:58',
                'updated_at' => '2021-08-04 22:22:42',
            ),
            9 =>
            array(
                'id' => 10,
                'parent_id' => 8,
                'order' => 13,
                'title' => 'Database terminal',
                'icon' => 'fa-database',
                'uri' => 'helpers/terminal/database',
                'permission' => NULL,
                'created_at' => '2021-08-04 22:20:58',
                'updated_at' => '2021-08-04 22:22:42',
            ),
            10 =>
            array(
                'id' => 11,
                'parent_id' => 8,
                'order' => 14,
                'title' => 'Laravel artisan',
                'icon' => 'fa-terminal',
                'uri' => 'helpers/terminal/artisan',
                'permission' => NULL,
                'created_at' => '2021-08-04 22:20:58',
                'updated_at' => '2021-08-04 22:22:42',
            ),
            11 =>
            array(
                'id' => 12,
                'parent_id' => 8,
                'order' => 15,
                'title' => 'Routes',
                'icon' => 'fa-list-alt',
                'uri' => 'helpers/routes',
                'permission' => NULL,
                'created_at' => '2021-08-04 22:20:58',
                'updated_at' => '2021-08-04 22:22:42',
            ),
            12 =>
            array(
                'id' => 13,
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Tipe Ruangan',
                'icon' => 'fa-cubes',
                'uri' => 'room-types',
                'permission' => NULL,
                'created_at' => '2021-08-04 22:21:35',
                'updated_at' => '2021-08-04 22:22:42',
            ),
            13 =>
            array(
                'id' => 14,
                'parent_id' => 0,
                'order' => 3,
                'title' => 'Ruangan',
                'icon' => 'fa-trello',
                'uri' => 'rooms',
                'permission' => NULL,
                'created_at' => '2021-08-04 22:22:06',
                'updated_at' => '2021-08-04 22:22:42',
            ),
            14 =>
            array(
                'id' => 15,
                'parent_id' => 0,
                'order' => 4,
                'title' => 'Pinjam Ruang',
                'icon' => 'fa-calendar',
                'uri' => 'borrow-rooms',
                'permission' => NULL,
                'created_at' => '2021-08-04 22:22:30',
                'updated_at' => '2021-08-04 22:22:42',
            ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('admin_menu')->first()))
            \DB::table('admin_menu')->insert($admin_menu);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
