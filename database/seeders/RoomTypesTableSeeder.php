<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $room_types = [
            0 =>
            array(
                'id' => 1,
                'name' => 'Lab',
                'is_active' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Kelas',
                'is_active' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
        ];

        // Checking if the table already have a query
        if (is_null(DB::table('room_types')->first()))
            DB::table('room_types')->insert($room_types);
        else
            echo "\e[31mTable is not empty, therefore NOT ";
    }
}
