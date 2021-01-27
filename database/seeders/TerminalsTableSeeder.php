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
                'name' => 'KGSP TODA',
                'location' => 'Kingspoint Subdivision, King Alexander Street, Barangay Bagbag, Quezon City',
                'created_at' => '2020-12-24 07:02:57',
                'updated_at' => '2020-12-24 07:02:57',
            ),
        ));
        
        
    }
}