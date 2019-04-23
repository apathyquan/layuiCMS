<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;

class ArticleCategoryController extends BackendBaseController
{
    public function __construct(Category $category)
    {
        $this->prefix = 'articleCategory';
        $this->authStr = '分类';
        $this->model = $category;
    }

    /**
     * 图片上传
     */
    public function uploadImg()
    {
        return $this->upload('icon');
    }
    /**
     *生成列表搜索条件和数据
     */
    protected function filterStore($sql,$map=[]) 
    {   
      $sql=$sql->where('type',1);
      return compact('sql','map');
    }
    /**
     * 生成新增编辑参数
     */
    protected function createParams()
    {
        $params = request(['category_name', 'parent_id', 'type', 'icon','extend']);
        return $params;
    }
    /**
     * 验证模块
     */
    protected function validatorBlock($type = false)
    {
        $rule = [
            'category_name' => 'required|string',
        ];
        $validator = Validator::make(request()->all(), $rule);
        return $validator;
    }
}
