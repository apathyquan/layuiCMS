<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\{Role, RoleHasPermission,Permission};
use Illuminate\Http\Request;
use App\Http\Controllers\backend\BackendBaseController;
use Validator;
use Exception;

class RoleController extends BackendBaseController
{

    public function __construct(Role $role)
    {
        $this->prefix = 'role';
        $this->model = $role;
        $this->authStr='角色';
    }
    /**
     * 生成列表搜索条件和数据
     */
    protected function filterStore($sql)
    {

        $name = request('name');
        $map = [];
        if (!empty($name)) {
            $map[] = ['name', 'like', '%' . $name . '%'];
        }

        return ['sql' => $sql, 'map' => $map];
    }
    /**
     * 验证模块
     */
    public function validatorBlock()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required||string',
        ]);
        return $validator;
    }
    /**
     * 生成新增编辑参数
     */
    protected function createParams()
    {
        $params = request(['name']);
        return $params;
    }
    /**
     * 授权
     */
    public function impowerStore($id)
    {
       
        try {
            $user = auth('backend')->user();
            if (!$user->can($this->authStr . '授权') && env('PERMISSION_SWITCH')) {
                throw new Exception('权限不足，请联系超级管理员');
            }
            $arr = request('data');
            // dd($arr);
            $this->model->find($id)->syncPermissions($arr);
        } catch (Exception $e) {
            $this->statusCode = $this->errorCode;
            $this->responseMessage = $e->getMessage();
        }
        return $this->response($this->responseMessage, $this->statusCode);
    }
    /**
     * 获取授权列表
     */
    public function impowerData($id,$data=[])
    {
        try {
            $data = Permission::get();
            $RoleHasPermission=RoleHasPermission::where('role_id',$id)->pluck('permission_id');
            $dataParentId=$data->pluck('parent_id')->toArray();
            $treeData=[];
            $RoleHasPermission->map(function($item) use($dataParentId,&$treeData){
                 if(!in_array($item,$dataParentId)){
                    array_push($treeData,$item);
                 }
            });
            // dd( $RoleHasPermission,$data);
            $data->map(function ($item) use( $treeData) {
                // $item->label = $item->name;
                // $item->isLeaf = false;
                $item->checked=in_array($item->id, $treeData);
            });

            $data = $this->treeData($data->toArray());
        } catch (Exception $e) {
            $this->responseMessage = $e->getMessage();
            $this->statusCode = $this->errorCode;
        }
        return $this->response($this->responseMessage, $this->statusCode, $data);
    }

}
