<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DriversTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('drivers')->delete();
        
        \DB::table('drivers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'terminal_id' => 1,
                'name' => 'Joselito Dela Cruz',
                'created_at' => '2020-12-24 07:03:22',
                'updated_at' => '2020-12-24 07:03:22',
            ),
        ));
        
        
    }
}