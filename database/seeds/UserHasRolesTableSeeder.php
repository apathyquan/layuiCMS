<?php

use Illuminate\Database\Seeder;

class UserHasRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_has_roles')->delete();
        
        \DB::table('user_has_roles')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'model_type' => '1',
                'user_id' => 1,
            ),
            1 => 
            array (
                'role_id' => 1,
                'model_type' => '1',
                'user_id' => 5,
            ),
            2 => 
            array (
                'role_id' => 1,
                'model_type' => '1',
                'user_id' => 8,
            ),
            3 => 
            array (
                'role_id' => 2,
                'model_type' => '1',
                'user_id' => 1,
            ),
            4 => 
            array (
                'role_id' => 2,
                'model_type' => '1',
                'user_id' => 5,
            ),
            5 => 
            array (
                'role_id' => 2,
                'model_type' => '1',
                'user_id' => 8,
            ),
            6 => 
            array (
                'role_id' => 3,
                'model_type' => '1',
                'user_id' => 12,
            ),
        ));
        
        
    }
}