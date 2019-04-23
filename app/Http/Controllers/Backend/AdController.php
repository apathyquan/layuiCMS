<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ad;
use Validator;

class AdController extends BackendBaseController
{
    public function __construct(Ad $Ad)
    {
        $this->prefix = 'ad';
        $this->model = $Ad;
        $this->authStr = '广告';
    }
    /**
     * 生成列表搜索条件和数据
     */
    protected function filterStore($sql)
    {
        $title = request('title');
        $sql=$sql->with( 'adPosition:id,name');
        $map = [];
        if (!empty($title)) {
            $map[] = ['title', 'like', '%' . $title . '%'];
        }
        return ['sql' => $sql, 'map' => $map];
    }
    /**
     * 生成新增编辑参数
     */
    protected function createParams()
    {
        $params = request([ 'title', 'ad_position_id', 'img_path', 'status', 'text_link']);
        return $params;
    }
    /**
     * 验证模块
     */
    protected function validatorBlock($type = false)
    {
        $rule = [
            'title' => 'required|string',
            'ad_position_id' => 'required',
            'img_path' => 'required',
            'status' => 'required',
        ];
        $validator = Validator::make(request()->all(), $rule);
        return $validator;
    }
}
