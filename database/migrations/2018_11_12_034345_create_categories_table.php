<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name',100)->default('')->comment('分类名');
            $table->integer('parent_id')->default(0)->comment('父级id');
            $table->tinyInteger('type')->default(0)->comment('数据类型：0:默认值无归属,1：文章分类');
            $table->string('icon')->default('')->comment('分类icon');
            $table->text('extend')->nullable()->comment('扩展属性');
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
        Schema::dropIfExists('categories');
    }
}
