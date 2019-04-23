<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App \{
    User, UserHasRole, Role,Permission
};
use Exception;
use response;
use Validator;

class AdminController extends BackendBaseController
{


    public function __construct(User $User)
    {
        $this->model = $User;
        $this->prefix = 'admin';
        $this->authStr = '管理员';
    }

    /**
     * 生成列表搜索条件和数据
     */
    protected function filterStore($sql)
    {

        $name = request('name');
        $mobile = request('mobile');
        $map = [];
        $map[] = ['type', 1];
        if (!empty($name)) {
            $map[] = ['name', 'like', '%' . $name . '%'];
        }
        if (!empty($mobile)) {
            $map[] = ['mobile', 'like', '%' . $mobile . '%'];
        }
        return ['sql' => $sql, 'map' => $map];
    }
    /**
     * 生成新增编辑参数
     */
    protected function createParams($type = '')
    {
        switch ($type) {
            case 'add':
                $password = bcrypt(request('password'));
                $type = 1;
                $params = array_merge(compact('password', 'type'), request(['mobile', 'name', 'status', 'icon']));
                break;
            case 'edit':
                $params = request(['mobile', 'name', 'status', 'icon']);
                break;
            case 'editpwd':
                $password = bcrypt(request('password'));
                $params = compact('password');
                break;
            default:
                $params = request(['mobile', 'name', 'status', 'icon']);
                break;
        }
        return $params;
    }
    /**
     * 验证模块
     */
    protected function validatorBlock($type = '')
    {
        $rule = [];
        switch ($type) {
            case 'add':
                $rule = [
                    'name' => 'required||string',
                    'mobile' => 'required|max:11|unique:users,mobile',
                    'password' => 'required|min:6|max:32|confirmed',
                ];
                break;
            case 'editpwd':
                $rule = [
                    'password' => 'required|min:6|max:32|confirmed',
                ];
                break;
            default:
                $rule = [
                    'name' => 'required|string',
                    'mobile' => 'required|max:11',
                ];
                break;
        }

        $validator = Validator::make(request()->all(), $rule);

        return $validator;
    }
    /**
     * 获取已有角色列表
     */
    public function getRole($id)
    {
        try {
            $data = UserHasRole::where('user_id', $id)->pluck('role_id')->toArray();

        } catch (Exception $e) {
            $this->responseMessage = $e->getMessage();
            $this->statusCode = $this->errorCode;
        }
        return $this->response($this->responseMessage, $this->statusCode, $data);
    }
    /**
     * 角色选择
     */
    public function impowerStore($id)
    {
        try {
            $user = auth('backend')->user();
            if (!$user->can($this->authStr . '角色选择') && env('PERMISSION_SWITCH')) {
                throw new Exception('权限不足，请联系超级管理员');
            }
            $arr = request('arr');
            if (count($arr) == 0) {
                throw new Exception('请选勾选角色后再提交');
            }
            $tmpArr = [];
            foreach ($arr as $val) {
                $tmpArr[] = ['role_id' => $val, 'user_id' => $id, 'model_type' => 1];
            }
            UserHasRole::where('user_id', $id)->delete();
            UserHasRole::insert($tmpArr);
            $this->responseMessage = '授权成功';
        } catch (Exception $e) {
            $this->responseMessage = $e->getMessage();
            $this->statusCode = $this->errorCode;
        }
        return $this->response($this->responseMessage, $this->statusCode);
    }
    /**
     * 获取角色列表
     */
    public function impowerData($data = [])
    {
        try {
            $data = Role::get();
        } catch (Exception $e) {
            $this->responseMessage = $e->getMessage();
            $this->statusCode = $this->errorCode;
        }
        return $this->response($this->responseMessage, $this->statusCode, $data);
    }
    /**
     * 用户有权的操作
     */
    public function menu()
    {
        $permission = auth('backend')->user()->getAllPermissions();
        $tmpData = $this->treeData($permission->toArray(), 'child');
        if (isset($tmpData[0]['child'])) {
            $data = $tmpData[0]['child'];
        } else {
            $data = [];
        }

        return $this->response($this->responseMessage, $this->statusCode, $data);
    }
}
