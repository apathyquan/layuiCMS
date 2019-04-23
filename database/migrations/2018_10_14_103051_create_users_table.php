<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->default('');
            $table->string('icon')->default('')->comment('头像');
            $table->string('mobile',11)->default('');
            $table->string('email',100)->default('');
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('type')->default(2)->comment('账号类型：1：后台：2：前端用户');
            $table->timestamps();
            $table->string('last_login_ip')->default('');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('last_login_time')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
