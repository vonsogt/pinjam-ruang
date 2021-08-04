<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_roles')->delete();
        
        \DB::table('admin_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Administrator',
                'slug' => 'administrator',
                'created_at' => '2021-08-04 22:19:17',
                'updated_at' => '2021-08-04 22:19:17',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Tata Usaha',
                'slug' => 'tata-usaha',
                'created_at' => '2021-08-04 22:39:30',
                'updated_at' => '2021-08-04 22:39:30',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Dosen',
                'slug' => 'dosen',
                'created_at' => '2021-08-04 22:39:37',
                'updated_at' => '2021-08-04 22:39:37',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Mahasiswa',
                'slug' => 'mahasiswa',
                'created_at' => '2021-08-04 22:42:04',
                'updated_at' => '2021-08-04 22:42:04',
            ),
        ));
        
        
    }
}