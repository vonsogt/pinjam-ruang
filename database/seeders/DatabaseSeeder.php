<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoomTypesTableSeeder::class);
        $this->call(AdminUsersTableSeeder::class);
        $this->call(AdminRolesTableSeeder::class);
        $this->call(AdminMenuTableSeeder::class);
        $this->call(AdminPermissionsTableSeeder::class);
        $this->call(AdminRoleUsersTableSeeder::class);
        $this->call(AdminRolePermissionsTableSeeder::class);
        $this->call(AdminRoleMenuTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
    }
}
