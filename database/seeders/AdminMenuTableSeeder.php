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
                'order' => 10,
                'title' => 'Admin',
                'icon' => 'fa-tasks',
                'uri' => '',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-08-12 01:34:07',
            ),
            2 =>
            array(
                'id' => 3,
                'parent_id' => 2,
                'order' => 11,
                'title' => 'Users',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-08-12 01:34:07',
            ),
            3 =>
            array(
                'id' => 4,
                'parent_id' => 2,
                'order' => 12,
                'title' => 'Roles',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-08-12 01:34:07',
            ),
            4 =>
            array(
                'id' => 5,
                'parent_id' => 2,
                'order' => 13,
                'title' => 'Permission',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-08-12 01:34:07',
            ),
            5 =>
            array(
                'id' => 6,
                'parent_id' => 2,
                'order' => 14,
                'title' => 'Menu',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-08-12 01:34:07',
            ),
            6 =>
            array(
                'id' => 7,
                'parent_id' => 2,
                'order' => 15,
                'title' => 'Operation log',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-08-12 01:34:07',
            ),
            7 =>
            array(
                'id' => 8,
                'parent_id' => 0,
                'order' => 5,
                'title' => 'Helpers',
                'icon' => 'fa-gears',
                'uri' => '',
                'permission' => NULL,
                'created_at' => '2021-08-04 22:20:58',
                'updated_at' => '2021-08-12 01:34:07',
            ),
            8 =>
            array(
                'id' => 9,
                'parent_id' => 8,
                'order' => 6,
                'title' => 'Scaffold',
                'icon' => 'fa-keyboard-o',
                'uri' => 'helpers/scaffold',
                'permission' => NULL,
                'created_at' => '2021-08-04 22:20:58',
                'updated_at' => '2021-08-12 01:34:07',
            ),
            9 =>
            array(
                'id' => 10,
                'parent_id' => 8,
                'order' => 7,
                'title' => 'Database terminal',
                'icon' => 'fa-database',
                'uri' => 'helpers/terminal/database',
                'permission' => NULL,
                'created_at' => '2021-08-04 22:20:58',
                'updated_at' => '2021-08-12 01:34:07',
            ),
            10 =>
            array(
                'id' => 11,
                'parent_id' => 8,
                'order' => 8,
                'title' => 'Laravel artisan',
                'icon' => 'fa-terminal',
                'uri' => 'helpers/terminal/artisan',
                'permission' => NULL,
                'created_at' => '2021-08-04 22:20:58',
                'updated_at' => '2021-08-12 01:34:07',
            ),
            11 =>
            array(
                'id' => 12,
                'parent_id' => 8,
                'order' => 9,
                'title' => 'Routes',
                'icon' => 'fa-list-alt',
                'uri' => 'helpers/routes',
                'permission' => NULL,
                'created_at' => '2021-08-04 22:20:58',
                'updated_at' => '2021-08-12 01:34:07',
            ),
            12 =>
            array(
                'id' => 13,
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Tipe Ruangan',
                'icon' => 'fa-cubes',
                'uri' => 'room-types',
                'permission' => 'list.room_types',
                'created_at' => '2021-08-04 22:21:35',
                'updated_at' => '2021-08-12 02:18:40',
            ),
            13 =>
            array(
                'id' => 14,
                'parent_id' => 0,
                'order' => 3,
                'title' => 'Ruangan',
                'icon' => 'fa-trello',
                'uri' => 'rooms',
                'permission' => 'list.rooms',
                'created_at' => '2021-08-04 22:22:06',
                'updated_at' => '2021-08-12 02:18:21',
            ),
            14 =>
            array(
                'id' => 15,
                'parent_id' => 0,
                'order' => 4,
                'title' => 'Pinjam Ruang',
                'icon' => 'fa-calendar',
                'uri' => 'borrow-rooms',
                'permission' => 'list.borrow_rooms',
                'created_at' => '2021-08-04 22:22:30',
                'updated_at' => '2021-08-12 02:18:08',
            ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('admin_menu')->first()))
            \DB::table('admin_menu')->insert($admin_menu);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
