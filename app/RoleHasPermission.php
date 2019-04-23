<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    public function permission(){
        return $this->belongsTo(Permission::class);
    }
}
