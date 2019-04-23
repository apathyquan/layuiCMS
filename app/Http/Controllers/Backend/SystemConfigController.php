<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Config;
use Exception;

class SystemConfigController extends BackendBaseController
{
    protected $responseMessage = '操作成功';
    public function __construct(Config $config)
    {
        $this->prefix = 'system';
        $this->model = $config;
        $this->authStr = '系统设置';
    }
    /**
     * @description:获取分组 
     * @param {type} 
     * @return: 
     */
    public function configMenu()
    {
        $key = 'CONFIG_GROUP';
        $is_fixed = 0;
        $tmpData = $this->model->where(compact('key', 'is_fixed'))->first();
        $data = [];
        if ($tmpData) {
            $data = $this->parseValue($tmpData->value);
        }
        return $this->response('获取成功', $this->statusCode, $data);
    }
    /**
     * @description:获取分组数据 
     * @param {type} 
     * @return: 
     */
    public function groupData()
    {
        $config_group = request('gid');
        $is_fixed = 0;
        $data = $this->model->where(compact('config_group', 'is_fixed'))->get();
        // dd($data);
        $data->map(function ($item) {
            if ($item->options) {
                $item->options = $this->parseValue($item->options);
            }
            if ($item->config_type == 'radio') {
                $item->value = (int)$item->value;
            }
            switch ($item->config_type) {
                case 'radio':
                    $item->value = (int)$item->value;
                    break;
                case 'gallery':
                    if ($item->value) {
                        $item->value = unserialize($item->value);
                    } else {
                        $item->value = [];
                    }
                    break;
                case 'checkbox':
                    if ($item->value) {
                        $item->value = unserialize($item->value);
                    } else {
                        $item->value = [];
                    }
                    break;
            }
        });
        return $this->response('获取成功', $this->statusCode, $data);
    }
    /**
     * @description: 保存编辑 
     * @param {type} 
     * @return: 
     */
    public function edit()
    {
        try {
            if (!auth('backend')->user()->can($this->authStr . '修改')) {
                throw new Exception('权限不足，请联系超级管理员');
            }
            $permission = auth('backend')->user()->can('系统锁定设置修改');
            $params = request('data');
            foreach ($params as $val) {
                $id = $val['id'];
                $value = $val['value'];
                // $remark = $val['remark'];
                if ($val['is_fixed'] == 1 && !$permission) {
                    throw new Exception('权限不足，请联系超级管理员');
                }
                if (is_array($value)) {
                    $value = serialize($value);
                }
                $this->model->where('id', $id)->update(compact('value'));
            }
        } catch (Exception $e) {
            $this->statusCode = $this->errorCode;
            $this->responseMessage = $e->getMessage();
        }
        return $this->response($this->responseMessage, $this->statusCode);
    }

    /**
     * 上传 图片
     * @return [type] [description]
     */
    public function uploadImg()
    {
        $data = request()->all();
        $str = '';
        foreach ($data as $k => $v) {
            $str = $k;
        }
        $data = $this->upload($str, 'config/images');
        return $data;
    }

}
