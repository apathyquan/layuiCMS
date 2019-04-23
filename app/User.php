<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable 
{
    use  HasRoles;

    protected $guarded    = [];
    /**
     * 权限读取需要建立的关联
     */
    public function roles()
    {
        return $this->belongsToMany('Spatie\Permission\Models\Role', 'user_has_roles', 'user_id', 'role_id');
    }


}
