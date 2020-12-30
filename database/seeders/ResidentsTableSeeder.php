<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ResidentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('residents')->delete();
        
        \DB::table('residents')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Pedro Dela Cruz',
                'address' => '2296 Lapu-Lapu Street, Baclaran',
                'birth_date' => '2002-12-24',
                'contact_number' => '09123456789',
                'created_at' => '2020-12-24 07:05:15',
                'updated_at' => '2020-12-24 07:05:15',
            ),
        ));
        
        
    }
}