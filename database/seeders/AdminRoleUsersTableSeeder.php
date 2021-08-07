<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRoleUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $admin_role_users = array(
            0 =>
            array(
                'role_id' => 1,
                'user_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('admin_role_users')->first()))
            \DB::table('admin_role_users')->insert($admin_role_users);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
