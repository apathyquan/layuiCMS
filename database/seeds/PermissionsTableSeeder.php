<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '全部',
                'parent_id' => 0,
                'href' => '/',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => NULL,
                'updated_at' => '2019-04-09 12:26:46',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '系统管理',
                'parent_id' => 1,
                'href' => '/',
                'icon' => 'layui-icon-auz',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:08:03',
                'updated_at' => '2018-11-26 06:08:03',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '管理员列表',
                'parent_id' => 2,
                'href' => 'admin',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:08:27',
                'updated_at' => '2018-11-26 06:08:27',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '管理员新增',
                'parent_id' => 3,
                'href' => 'admin/add',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:08:50',
                'updated_at' => '2018-11-26 06:08:50',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '管理员编辑',
                'parent_id' => 3,
                'href' => 'admin/edit',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:09:12',
                'updated_at' => '2018-11-26 06:09:12',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '管理员删除',
                'parent_id' => 3,
                'href' => 'admin/delete',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:09:30',
                'updated_at' => '2018-11-26 06:09:30',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => '角色列表',
                'parent_id' => 2,
                'href' => 'role',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:09:49',
                'updated_at' => '2018-11-26 06:09:49',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => '角色新增',
                'parent_id' => 7,
                'href' => 'role/add',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:10:10',
                'updated_at' => '2019-04-15 14:18:42',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => '角色编辑',
                'parent_id' => 7,
                'href' => 'role/edit',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:10:29',
                'updated_at' => '2018-11-26 06:10:29',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => '角色删除',
                'parent_id' => 7,
                'href' => 'role/delete',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:10:45',
                'updated_at' => '2018-11-26 06:10:45',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => '权限列表',
                'parent_id' => 2,
                'href' => 'permission',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:11:12',
                'updated_at' => '2018-11-26 06:11:12',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => '权限新增',
                'parent_id' => 11,
                'href' => 'permission/add',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:11:40',
                'updated_at' => '2018-11-26 06:11:40',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => '权限编辑',
                'parent_id' => 11,
                'href' => 'permission/edit',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:12:02',
                'updated_at' => '2018-11-26 06:12:02',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => '权限删除',
                'parent_id' => 11,
                'href' => 'permission/delete',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:12:26',
                'updated_at' => '2018-11-26 06:12:26',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => '文章管理',
                'parent_id' => 1,
                'href' => '/',
                'icon' => 'layui-icon-read',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:15:13',
                'updated_at' => '2018-11-26 06:40:12',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => '文章列表',
                'parent_id' => 15,
                'href' => 'article',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:16:04',
                'updated_at' => '2018-11-26 06:16:04',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => '文章新增',
                'parent_id' => 16,
                'href' => 'article/add',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:16:32',
                'updated_at' => '2018-11-26 06:16:32',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => '文章编辑',
                'parent_id' => 16,
                'href' => 'article/edit',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:17:31',
                'updated_at' => '2018-11-26 06:17:31',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => '文章删除',
                'parent_id' => 16,
                'href' => 'article/delete',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:17:56',
                'updated_at' => '2018-11-26 06:17:56',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => '分类列表',
                'parent_id' => 15,
                'href' => 'article/category',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:20:37',
                'updated_at' => '2018-12-11 02:44:43',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => '分类新增',
                'parent_id' => 20,
                'href' => 'article/category/add',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:28:57',
                'updated_at' => '2018-12-11 02:43:45',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => '分类编辑',
                'parent_id' => 20,
                'href' => 'article/category/edit',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:29:21',
                'updated_at' => '2018-12-11 02:43:50',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => '分类删除',
                'parent_id' => 20,
                'href' => 'article/category/delete',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:29:37',
                'updated_at' => '2018-12-11 02:44:00',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => '角色授权',
                'parent_id' => 7,
                'href' => 'role/impower',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:32:13',
                'updated_at' => '2018-11-26 06:32:13',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => '管理员角色选择',
                'parent_id' => 3,
                'href' => 'admin/impower',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-11-26 06:33:17',
                'updated_at' => '2018-11-26 06:43:04',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => '广告管理',
                'parent_id' => 1,
                'href' => '/',
                'icon' => 'layui-icon-carousel',
                'guard_name' => 'backend',
                'created_at' => '2018-12-10 06:38:22',
                'updated_at' => '2018-12-10 06:38:22',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => '广告位列表',
                'parent_id' => 26,
                'href' => 'ad/position',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-12-10 06:43:20',
                'updated_at' => '2019-03-24 02:11:11',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => '广告列表',
                'parent_id' => 26,
                'href' => 'ad',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-12-10 06:44:54',
                'updated_at' => '2018-12-10 06:44:54',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => '广告位新增',
                'parent_id' => 27,
                'href' => 'ad/position/add',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-12-10 06:53:49',
                'updated_at' => '2018-12-10 06:53:49',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => '广告位编辑',
                'parent_id' => 27,
                'href' => 'ad/position/edit',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-12-10 06:54:22',
                'updated_at' => '2018-12-10 06:54:22',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => '广告位删除',
                'parent_id' => 27,
                'href' => 'ad/position/delete',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2018-12-10 06:55:00',
                'updated_at' => '2018-12-10 06:55:00',
            ),
            31 => 
            array (
                'id' => 36,
                'name' => '广告新增',
                'parent_id' => 28,
                'href' => 'ad/add',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-03-23 09:20:51',
                'updated_at' => '2019-03-23 09:20:51',
            ),
            32 => 
            array (
                'id' => 37,
                'name' => '广告编辑',
                'parent_id' => 28,
                'href' => 'ad/edit',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-03-23 09:21:06',
                'updated_at' => '2019-03-23 09:21:06',
            ),
            33 => 
            array (
                'id' => 38,
                'name' => '广告删除',
                'parent_id' => 28,
                'href' => 'ad/delete',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-03-23 09:21:29',
                'updated_at' => '2019-03-23 09:21:29',
            ),
            34 => 
            array (
                'id' => 39,
                'name' => '系统设置',
                'parent_id' => 2,
                'href' => 'system',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-03-27 14:05:41',
                'updated_at' => '2019-03-27 14:27:22',
            ),
            35 => 
            array (
                'id' => 40,
                'name' => '系统设置修改',
                'parent_id' => 39,
                'href' => 'system/edit',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-03-27 14:33:43',
                'updated_at' => '2019-03-27 14:33:43',
            ),
            36 => 
            array (
                'id' => 41,
                'name' => '查看管理员列表',
                'parent_id' => 3,
                'href' => '',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-04-15 15:31:21',
                'updated_at' => '2019-04-16 04:53:35',
            ),
            37 => 
            array (
                'id' => 42,
                'name' => '查看角色列表',
                'parent_id' => 7,
                'href' => '',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-04-16 04:53:47',
                'updated_at' => '2019-04-16 04:55:29',
            ),
            38 => 
            array (
                'id' => 43,
                'name' => '查看权限列表',
                'parent_id' => 11,
                'href' => '',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-04-16 04:54:39',
                'updated_at' => '2019-04-16 04:55:06',
            ),
            39 => 
            array (
                'id' => 44,
                'name' => '查看系统设置',
                'parent_id' => 39,
                'href' => '',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-04-16 04:55:22',
                'updated_at' => '2019-04-16 04:55:22',
            ),
            40 => 
            array (
                'id' => 45,
                'name' => '查看文章列表',
                'parent_id' => 16,
                'href' => '',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-04-16 04:55:50',
                'updated_at' => '2019-04-16 04:55:50',
            ),
            41 => 
            array (
                'id' => 46,
                'name' => '查看文章分类列表',
                'parent_id' => 20,
                'href' => '',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-04-16 04:56:13',
                'updated_at' => '2019-04-16 04:56:13',
            ),
            42 => 
            array (
                'id' => 47,
                'name' => '查看广告位列表',
                'parent_id' => 27,
                'href' => '',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-04-16 04:56:40',
                'updated_at' => '2019-04-16 04:56:54',
            ),
            43 => 
            array (
                'id' => 48,
                'name' => '查看广告列表',
                'parent_id' => 28,
                'href' => '',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-04-16 04:59:46',
                'updated_at' => '2019-04-16 04:59:46',
            ),
            44 => 
            array (
                'id' => 50,
                'name' => '管理员修改密码',
                'parent_id' => 3,
                'href' => 'admin/pwd',
                'icon' => '',
                'guard_name' => 'backend',
                'created_at' => '2019-04-16 15:20:13',
                'updated_at' => '2019-04-16 15:20:13',
            ),
        ));
        
        
    }
}