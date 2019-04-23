<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Config;
use Exception;
use Validator;


class BackendBaseController extends Controller
{
    protected $authStr = '';
    public function __construct()
    {
        $this->webTitle=Config::where('key','WEB_TITLE')->value('value')??'ZQCMS'; //网站名称


    }
    //列表
    public function index()
    {
        return view($this->prefix .'/'. __FUNCTION__);
    }
    //添加
    public function add()
    {
        return view($this->prefix . '/' . __FUNCTION__);
    }
    //编辑
    public function edit()
    {
        return view($this->prefix . '/' . __FUNCTION__);
    }
    //修改密码
    public function editPWD()
    {
        return view($this->prefix . '/' . __FUNCTION__);
    }
    /**
     * 授权
     */
    public function impower()
    {
        return view($this->prefix . '/' . __FUNCTION__);
    }
    /**
     * 列表数据
     */
    public function listData()
    {
        try {
            $user = auth('backend')->user();
            if ( !$user->can($this->authStr . '列表') && !$user->can($this->authStr . '管理') && env('PERMISSION_SWITCH')) {
                throw new Exception('权限不足，请联系超级管理员');
            }
            $sql = $this->model;
            $filterData = $this->filterStore($sql);
            $sql = $filterData['sql'];
            $map = $filterData['map'];
            $sql = $sql->where($map);
            return $this->listResponse($sql);
        } catch (Exception $e) {
            $this->statusCode = $this->errorCode;
            return $this->response($e->getMessage(), $this->statusCode);
        }
    }
    /**
     * 响应数据生成
     */
    protected function listResponse($sql)
    {
        $pageNum = request('page', false);
        $limit = request('limit', false);
        $tree = request('tree', false);
        $count = $sql->count();
        if ($pageNum &&  $limit) {
            $page = $pageNum - 1;
            if ($page != 0) {
                $page = $limit * $page;
                $limit = $limit * $pageNum;
            }

            $sql = $sql->offset($page)->limit($limit);
        }

        // dd($count, $page, $limit);
        $data = $sql->get()->toArray();
        if ($tree) {
            $data = $this->treeData($data);
        }
        $this->data = $data;
        $this->count = $count;
        return $this->response('获取成功', $this->statusCode, $data, compact('count'));
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
        return compact('sql', 'map');
    }
    /**
     * 删除
     */
    public function delete()
    {
        try {
            if (!auth('backend')->user()->can($this->authStr . '删除') && env('PERMISSION_SWITCH')) {
                throw new Exception('权限不足，请联系超级管理员');
            }
            $id = explode(',', request('id'));
            $count = $this->model->destroy($id);
            if ($count > 0) {
                $this->responseMessage = '删除成功';
            } else {
                throw new Exception('删除失败');
            }
        } catch (Exception $e) {
            $this->statusCode = $this->errorCode;
            $this->responseMessage = $e->getMessage();
        }
        return $this->response($this->responseMessage, $this->statusCode);
    }
    /**
     * 新增逻辑
     */
    public function addStore()
    {
        try {
            if (!auth('backend')->user()->can($this->authStr . '新增') && env('PERMISSION_SWITCH')) {
                throw new Exception('权限不足，请联系超级管理员');
            }
            $paramType = 'add';
            $validator = $this->validatorBlock($paramType);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $params = $this->createParams($paramType);
            $this->model->create($params);
        } catch (Exception $e) {
            $this->responseMessage = $e->getMessage();
            $this->statusCode = $this->errorCode;
        }
        return $this->response($this->responseMessage, $this->statusCode);
    }
    /**
     * 编辑数据
     */
    public function editData($id)
    {
        $data = $this->model->find($id)->toArray();
        return $this->response($this->responseMessage, $this->statusCode, $data);
    }
    /**
     * 编辑逻辑
     */
    public function editStore($id)
    {
        try {
            $paramType = 'edit';
            if (!auth('backend')->user()->can($this->authStr . '编辑') && env('PERMISSION_SWITCH')) {
                throw new Exception('权限不足，请联系超级管理员');
            }
            $validator = $this->validatorBlock($paramType);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $params = $this->createParams($paramType);
            $this->model->where(compact('id'))->update($params);
        } catch (Exception $e) {
            $this->responseMessage = $e->getMessage();
            $this->statusCode = $this->errorCode;
        }
        return $this->response($this->responseMessage, $this->statusCode);
    }
    /**
     * 编辑密码逻辑 
     * */
    public function editPWDStore($id)
    {
        try {
            if (!auth('backend')->user()->can($this->authStr . '修改密码') && env('PERMISSION_SWITCH')) {
                throw new Exception('权限不足，请联系超级管理员');
            }
            $paramType = 'editpwd';
            $validator = $this->validatorBlock($paramType);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $params = $this->createParams($paramType);

            $this->model->where(compact('id'))->update($params);
        } catch (Exception $e) {
            $this->responseMessage = $e->getMessage();
            $this->statusCode = $this->errorCode;
        }
        return $this->response($this->responseMessage, $this->statusCode);
    }
    /**
     * @description: 图片上传
     * @param {type} 
     * @return: 
     */
    public function uploadImg()
    {
        $data = request()->all();
        $str='';
        foreach ($data as $k => $v) {
            $str = $k;
        }
        return $this->upload($str);;
    }
}
