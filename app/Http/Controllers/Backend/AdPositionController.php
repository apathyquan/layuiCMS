<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\AdPosition;

class AdPositionController extends BackendBaseController
{
    public function __construct(AdPosition $AdPosition)
    {
        $this->prefix = 'adPosition';
        $this->model = $AdPosition;
        $this->authStr = '广告位';
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
     * 生成新增编辑参数
     */
    protected function createParams()
    {
        $params = request(['type', 'name', 'identity', 'status']);
        return $params;
    }
    /**
     * 验证模块
     */
    protected function validatorBlock($type = false)
    {
        $rule = [
            'name' => 'required|string',
            'identity' => 'required|string',
        ];
        $validator = Validator::make(request()->all(), $rule);
        return $validator;
    }
}
