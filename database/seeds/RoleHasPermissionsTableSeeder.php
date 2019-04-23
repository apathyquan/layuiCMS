<?php

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'permission_id' => 1,
                'role_id' => 2,
            ),
            2 => 
            array (
                'permission_id' => 1,
                'role_id' => 3,
            ),
            3 => 
            array (
                'permission_id' => 2,
                'role_id' => 1,
            ),
            4 => 
            array (
                'permission_id' => 2,
                'role_id' => 2,
            ),
            5 => 
            array (
                'permission_id' => 2,
                'role_id' => 3,
            ),
            6 => 
            array (
                'permission_id' => 3,
                'role_id' => 1,
            ),
            7 => 
            array (
                'permission_id' => 3,
                'role_id' => 2,
            ),
            8 => 
            array (
                'permission_id' => 3,
                'role_id' => 3,
            ),
            9 => 
            array (
                'permission_id' => 4,
                'role_id' => 1,
            ),
            10 => 
            array (
                'permission_id' => 4,
                'role_id' => 2,
            ),
            11 => 
            array (
                'permission_id' => 5,
                'role_id' => 1,
            ),
            12 => 
            array (
                'permission_id' => 5,
                'role_id' => 2,
            ),
            13 => 
            array (
                'permission_id' => 6,
                'role_id' => 1,
            ),
            14 => 
            array (
                'permission_id' => 6,
                'role_id' => 2,
            ),
            15 => 
            array (
                'permission_id' => 7,
                'role_id' => 1,
            ),
            16 => 
            array (
                'permission_id' => 7,
                'role_id' => 2,
            ),
            17 => 
            array (
                'permission_id' => 7,
                'role_id' => 3,
            ),
            18 => 
            array (
                'permission_id' => 8,
                'role_id' => 1,
            ),
            19 => 
            array (
                'permission_id' => 8,
                'role_id' => 2,
            ),
            20 => 
            array (
                'permission_id' => 9,
                'role_id' => 1,
            ),
            21 => 
            array (
                'permission_id' => 9,
                'role_id' => 2,
            ),
            22 => 
            array (
                'permission_id' => 10,
                'role_id' => 1,
            ),
            23 => 
            array (
                'permission_id' => 10,
                'role_id' => 2,
            ),
            24 => 
            array (
                'permission_id' => 11,
                'role_id' => 1,
            ),
            25 => 
            array (
                'permission_id' => 11,
                'role_id' => 2,
            ),
            26 => 
            array (
                'permission_id' => 11,
                'role_id' => 3,
            ),
            27 => 
            array (
                'permission_id' => 12,
                'role_id' => 1,
            ),
            28 => 
            array (
                'permission_id' => 12,
                'role_id' => 2,
            ),
            29 => 
            array (
                'permission_id' => 13,
                'role_id' => 1,
            ),
            30 => 
            array (
                'permission_id' => 13,
                'role_id' => 2,
            ),
            31 => 
            array (
                'permission_id' => 14,
                'role_id' => 1,
            ),
            32 => 
            array (
                'permission_id' => 14,
                'role_id' => 2,
            ),
            33 => 
            array (
                'permission_id' => 15,
                'role_id' => 1,
            ),
            34 => 
            array (
                'permission_id' => 15,
                'role_id' => 2,
            ),
            35 => 
            array (
                'permission_id' => 15,
                'role_id' => 3,
            ),
            36 => 
            array (
                'permission_id' => 16,
                'role_id' => 1,
            ),
            37 => 
            array (
                'permission_id' => 16,
                'role_id' => 2,
            ),
            38 => 
            array (
                'permission_id' => 16,
                'role_id' => 3,
            ),
            39 => 
            array (
                'permission_id' => 17,
                'role_id' => 1,
            ),
            40 => 
            array (
                'permission_id' => 17,
                'role_id' => 2,
            ),
            41 => 
            array (
                'permission_id' => 18,
                'role_id' => 1,
            ),
            42 => 
            array (
                'permission_id' => 18,
                'role_id' => 2,
            ),
            43 => 
            array (
                'permission_id' => 19,
                'role_id' => 1,
            ),
            44 => 
            array (
                'permission_id' => 19,
                'role_id' => 2,
            ),
            45 => 
            array (
                'permission_id' => 20,
                'role_id' => 1,
            ),
            46 => 
            array (
                'permission_id' => 20,
                'role_id' => 2,
            ),
            47 => 
            array (
                'permission_id' => 20,
                'role_id' => 3,
            ),
            48 => 
            array (
                'permission_id' => 21,
                'role_id' => 1,
            ),
            49 => 
            array (
                'permission_id' => 21,
                'role_id' => 2,
            ),
            50 => 
            array (
                'permission_id' => 22,
                'role_id' => 1,
            ),
            51 => 
            array (
                'permission_id' => 22,
                'role_id' => 2,
            ),
            52 => 
            array (
                'permission_id' => 23,
                'role_id' => 1,
            ),
            53 => 
            array (
                'permission_id' => 23,
                'role_id' => 2,
            ),
            54 => 
            array (
                'permission_id' => 24,
                'role_id' => 1,
            ),
            55 => 
            array (
                'permission_id' => 24,
                'role_id' => 2,
            ),
            56 => 
            array (
                'permission_id' => 25,
                'role_id' => 1,
            ),
            57 => 
            array (
                'permission_id' => 25,
                'role_id' => 2,
            ),
            58 => 
            array (
                'permission_id' => 26,
                'role_id' => 1,
            ),
            59 => 
            array (
                'permission_id' => 26,
                'role_id' => 2,
            ),
            60 => 
            array (
                'permission_id' => 26,
                'role_id' => 3,
            ),
            61 => 
            array (
                'permission_id' => 27,
                'role_id' => 1,
            ),
            62 => 
            array (
                'permission_id' => 27,
                'role_id' => 2,
            ),
            63 => 
            array (
                'permission_id' => 27,
                'role_id' => 3,
            ),
            64 => 
            array (
                'permission_id' => 28,
                'role_id' => 1,
            ),
            65 => 
            array (
                'permission_id' => 28,
                'role_id' => 2,
            ),
            66 => 
            array (
                'permission_id' => 28,
                'role_id' => 3,
            ),
            67 => 
            array (
                'permission_id' => 29,
                'role_id' => 1,
            ),
            68 => 
            array (
                'permission_id' => 29,
                'role_id' => 2,
            ),
            69 => 
            array (
                'permission_id' => 30,
                'role_id' => 1,
            ),
            70 => 
            array (
                'permission_id' => 30,
                'role_id' => 2,
            ),
            71 => 
            array (
                'permission_id' => 31,
                'role_id' => 1,
            ),
            72 => 
            array (
                'permission_id' => 31,
                'role_id' => 2,
            ),
            73 => 
            array (
                'permission_id' => 36,
                'role_id' => 1,
            ),
            74 => 
            array (
                'permission_id' => 36,
                'role_id' => 2,
            ),
            75 => 
            array (
                'permission_id' => 37,
                'role_id' => 1,
            ),
            76 => 
            array (
                'permission_id' => 37,
                'role_id' => 2,
            ),
            77 => 
            array (
                'permission_id' => 38,
                'role_id' => 1,
            ),
            78 => 
            array (
                'permission_id' => 38,
                'role_id' => 2,
            ),
            79 => 
            array (
                'permission_id' => 39,
                'role_id' => 1,
            ),
            80 => 
            array (
                'permission_id' => 39,
                'role_id' => 2,
            ),
            81 => 
            array (
                'permission_id' => 39,
                'role_id' => 3,
            ),
            82 => 
            array (
                'permission_id' => 40,
                'role_id' => 1,
            ),
            83 => 
            array (
                'permission_id' => 40,
                'role_id' => 2,
            ),
            84 => 
            array (
                'permission_id' => 41,
                'role_id' => 1,
            ),
            85 => 
            array (
                'permission_id' => 41,
                'role_id' => 2,
            ),
            86 => 
            array (
                'permission_id' => 41,
                'role_id' => 3,
            ),
            87 => 
            array (
                'permission_id' => 42,
                'role_id' => 1,
            ),
            88 => 
            array (
                'permission_id' => 42,
                'role_id' => 2,
            ),
            89 => 
            array (
                'permission_id' => 42,
                'role_id' => 3,
            ),
            90 => 
            array (
                'permission_id' => 43,
                'role_id' => 1,
            ),
            91 => 
            array (
                'permission_id' => 43,
                'role_id' => 2,
            ),
            92 => 
            array (
                'permission_id' => 43,
                'role_id' => 3,
            ),
            93 => 
            array (
                'permission_id' => 44,
                'role_id' => 1,
            ),
            94 => 
            array (
                'permission_id' => 44,
                'role_id' => 2,
            ),
            95 => 
            array (
                'permission_id' => 44,
                'role_id' => 3,
            ),
            96 => 
            array (
                'permission_id' => 45,
                'role_id' => 1,
            ),
            97 => 
            array (
                'permission_id' => 45,
                'role_id' => 2,
            ),
            98 => 
            array (
                'permission_id' => 45,
                'role_id' => 3,
            ),
            99 => 
            array (
                'permission_id' => 46,
                'role_id' => 1,
            ),
            100 => 
            array (
                'permission_id' => 46,
                'role_id' => 2,
            ),
            101 => 
            array (
                'permission_id' => 46,
                'role_id' => 3,
            ),
            102 => 
            array (
                'permission_id' => 47,
                'role_id' => 1,
            ),
            103 => 
            array (
                'permission_id' => 47,
                'role_id' => 2,
            ),
            104 => 
            array (
                'permission_id' => 47,
                'role_id' => 3,
            ),
            105 => 
            array (
                'permission_id' => 48,
                'role_id' => 1,
            ),
            106 => 
            array (
                'permission_id' => 48,
                'role_id' => 2,
            ),
            107 => 
            array (
                'permission_id' => 48,
                'role_id' => 3,
            ),
            108 => 
            array (
                'permission_id' => 50,
                'role_id' => 1,
            ),
        ));
        
        
    }
}