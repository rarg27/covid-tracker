<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@email.com',
                'password' => '$2y$10$cVZMudsno5QT0DcCVy9dP.ZuLcpt0ndcy2VYj0p4eLfc8lMqMoqAS',
                'remember_token' => NULL,
                'created_at' => '2020-12-24 07:02:09',
                'updated_at' => '2020-12-24 07:02:09',
            ),
        ));
        
        
    }
}