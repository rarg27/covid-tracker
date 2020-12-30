<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransportationLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('transportation_logs')->delete();
        
        \DB::table('transportation_logs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'resident_id' => 1,
                'terminal_id' => 1,
                'conductor_id' => 1,
                'driver_id' => 1,
                'created_at' => '2020-12-24 07:05:41',
                'updated_at' => '2020-12-24 07:05:41',
            ),
        ));
        
        
    }
}