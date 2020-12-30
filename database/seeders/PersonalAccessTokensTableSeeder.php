<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PersonalAccessTokensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('personal_access_tokens')->delete();
        
        \DB::table('personal_access_tokens')->insert(array (
            0 => 
            array (
                'id' => 1,
                'tokenable_type' => 'App\\Conductor',
                'tokenable_id' => 1,
                'name' => 'token',
                'token' => '823ec0c6883a58d919aa68020fb4b00da3ddf25580d77dc0829ea481853d1ef0',
                'abilities' => '["*"]',
                'last_used_at' => NULL,
                'created_at' => '2020-12-25 19:31:43',
                'updated_at' => '2020-12-25 19:31:43',
            ),
        ));
        
        
    }
}