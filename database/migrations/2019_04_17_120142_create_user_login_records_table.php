<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLoginRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_login_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->comment('用户id');
            $table->string('country', '100')->nullable()->comment('国家');
            $table->string('province', '100')->nullable()->comment('省份');
            $table->string('city', '100')->nullable()->comment('城市');
            $table->string('area', '100')->nullable()->comment('地区');
            $table->string('ip', '100')->nullable()->comment('登录ip');
            $table->tinyInteger('type')->nullable()->comment('登录方式，1：手机号登录，2：微信登录，3：QQ登录');
            $table->string('remark')->nullable()->comment('备注');
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
        Schema::dropIfExists('user_login_records');
    }
}
