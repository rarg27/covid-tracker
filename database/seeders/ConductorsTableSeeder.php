<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
                'name' => 'Conductor',
                'username' => 'conductor',
                'password' => Hash::make('brgybagbag'),
                'created_at' => '2020-12-24 07:03:22',
                'updated_at' => '2020-12-24 07:03:22',
            ),
        ));
        
        
    }
}