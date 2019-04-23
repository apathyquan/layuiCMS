<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ad_position_id')->default(0)->comment('广告位id');
            $table->string('title', 100)->default('')->comment('广告标题');
            $table->string('text_link', 200)->default('')->comment('文字链接');
            $table->string('img_path', 200)->default('')->comment('图片链接');
            $table->tinyInteger('status')->default(1)->comment('1：启用，0：禁用');
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
        Schema::dropIfExists('ads');
    }
}
