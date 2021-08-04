<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRoleMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_role_menu')->delete();
        
        \DB::table('admin_role_menu')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'menu_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}