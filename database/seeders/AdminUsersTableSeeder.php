<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $admin_users = array(
            0 =>
            array(
                'id' => 1,
                'username' => 'admin',
                'password' => '$2y$10$k2jNYZ66DQeRnDVVei4kOeceRvvvU70bJkZo4fHhTDFYivPCeLW52',
                'name' => 'Administrator',
                'avatar' => NULL,
                'remember_token' => 'bwMPZyAVO3dD4ttpf6NH6RtpZvt14qgokxHx1QaLVzsgShaiYxNmv4WTZmwt',
                'created_at' => '2021-08-04 22:19:17',
                'updated_at' => '2021-08-04 22:19:17',
            ),
        );

        // Checking if the table already have a query
        if (is_null(\DB::table('admin_users')->first()))
            \DB::table('admin_users')->insert($admin_users);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
