<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded=[];
    //广告位置
    public function adPosition(){
        return $this->belongsTo(AdPosition::class);
    }
}
