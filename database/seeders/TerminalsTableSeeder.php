<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TerminalsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('terminals')->delete();
        
        \DB::table('terminals')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Terminal 1',
                'location' => '2295 Lapu-Lapu Street, Baclaran',
                'created_at' => '2020-12-24 07:02:57',
                'updated_at' => '2020-12-24 07:02:57',
            ),
        ));
        
        
    }
}