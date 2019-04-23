<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded=[];
    //文章分类
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
