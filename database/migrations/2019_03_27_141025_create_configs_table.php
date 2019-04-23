<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->default('')->comment('数据标识');
            $table->string('label')->default('')->comment('数据标题');
            $table->text('options')->nullable()->comment('选项');
            $table->text('value')->nullable()->comment('值');
            $table->string('remark')->default('')->comment('备注');
            $table->integer('config_group')->default(0)->comment('配置分租');
            $table->string('config_type',50)-> default('')->comment('数据类型');
            $table->tinyInteger('status')->default(1)->comment('状态，1：启用、0：禁用');
            $table->integer('sort')->default(0)->comment('排序');
            $table->tinyInteger('is_fixed')->default(0)->comment('是否锁定');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
