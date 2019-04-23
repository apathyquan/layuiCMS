<?php

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
                'name' => 'quan',
                'icon' => '/uploads/20190320//aH3pxoZJXBARIKs5kFM8.jpg',
                'mobile' => '15600000000',
                'email' => '',
                'password' => '$2y$10$nMKPBVw5OpXnQgx1zplW9.sVpJ1MCetaPZb.iKx1UYMu42yyDvEnm',
                'remember_token' => 'MgAl4iaRCSZz5MoSAlvbBCWX53gZ63v2MXCvFhgAYyipm81vLzQNuVwPTQMo',
                'status' => 1,
                'type' => 1,
                'created_at' => '2018-10-26 23:05:10',
                'updated_at' => '2019-04-10 02:29:27',
                'last_login_ip' => '',
                'deleted_at' => NULL,
                'last_login_time' => NULL,
            ),
        ));
        
        
    }
}