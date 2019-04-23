<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use Exception;
use Validator;

class PermissionController extends BackendBaseController
{
    public function __construct(Permission $permission)
    {
        $this->prefix = 'permission';
        $this->model = $permission;
        $this->authStr = '权限';
    }

    /**
     * 生成新增编辑参数
     */
    protected function createParams()
    {
        $guard_name='backend';
        $params = array_merge(compact('guard_name'),request(['name','parent_id','href','icon']));
        return $params;
    }
    /**
     * 验证模块
     */
    protected function validatorBlock($type = false)
    {
        $rule = [];
        $rule = [
            'name' => 'required|string',
        ];
        $validator = Validator::make(request()->all(), $rule);
        return $validator;
    }
}
