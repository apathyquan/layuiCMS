<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '超级管理员',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:33:50',
                'updated_at' => '2018-11-26 06:33:50',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '运维管理员',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:34:00',
                'updated_at' => '2019-04-15 14:17:20',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '访客',
                'guard_name' => 'backend',
                'created_at' => '2019-04-15 14:23:44',
                'updated_at' => '2019-04-15 14:23:44',
            ),
        ));
        
        
    }
}