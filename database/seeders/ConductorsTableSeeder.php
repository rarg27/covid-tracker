<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConductorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conductors')->delete();
        
        \DB::table('conductors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'terminal_id' => 1,
                'name' => 'Juan Dela Cruz',
                'username' => 'juan',
                'password' => '$2y$10$cVZMudsno5QT0DcCVy9dP.ZuLcpt0ndcy2VYj0p4eLfc8lMqMoqAS',
                'created_at' => '2020-12-24 07:03:22',
                'updated_at' => '2020-12-24 07:03:22',
            ),
        ));
        
        
    }
}