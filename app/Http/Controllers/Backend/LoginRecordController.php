<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserLoginRecord as Model;


class LoginRecordController extends BackendBaseController
{
    public function __construct(Model $model)
    {
        $this->prefix = 'loginRecord';
        $this->authStr = '登录记录';
        $this->model = $model;
    }

    /**
     * 生成列表搜索条件和数据
     */
    protected function filterStore($sql)
    {
        $name = request('name');
        $map = [];
        if (!empty($name)) {
            $sql = $sql->whereHas('user', function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        }
        $sql = $sql->with('user:id,name');
        return compact('sql', 'map');
    }
}
