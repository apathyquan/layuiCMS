<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('configs')->delete();
        
        \DB::table('configs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'CONFIG_TYPE',
                'label' => '配置类型',
                'options' => NULL,
                'value' => 'number:数字
input:文本
textarea:文本域
array:数组
enum:枚举
image:图片
gallery:相冊
checkbox:多选框
imageAndText:图片+文字',
                'remark' => '',
                'config_group' => 0,
                'config_type' => 'textarea',
                'status' => 1,
                'sort' => 0,
                'is_fixed' => 1,
                'created_at' => '2019-03-07 14:18:14',
                'updated_at' => '2019-03-07 14:18:14',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'CONFIG_GROUP',
                'label' => '配置分组',
                'options' => NULL,
                'value' => '1:系统
2:网站名称',
                'remark' => '请按格式填写: a:名称1,b:名称2',
                'config_group' => 1,
                'config_type' => 'textarea',
                'status' => 1,
                'sort' => 0,
                'is_fixed' => 0,
                'created_at' => '2019-03-07 14:18:14',
                'updated_at' => '2019-04-09 02:09:28',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'WEB_TITLE',
                'label' => '网站名称',
                'options' => NULL,
                'value' => 'ZQCMS',
                'remark' => '',
                'config_group' => 2,
                'config_type' => 'input',
                'status' => 1,
                'sort' => 0,
                'is_fixed' => 0,
                'created_at' => '2019-04-09 14:07:25',
                'updated_at' => '2019-04-10 02:08:17',
            ),
        ));
        
        
    }
}