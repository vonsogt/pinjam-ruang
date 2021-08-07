<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRolePermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $admin_role_permissions = array(
            0 =>
            array(
                'role_id' => 1,
                'permission_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('admin_role_permissions')->first()))
            \DB::table('admin_role_permissions')->insert($admin_role_permissions);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
