<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App \{
    Article, Category
};
use Exception;
use Validator;

class ArticleController extends BackendBaseController
{
    public function __construct(Article $article)
    {
        $this->prefix = 'article';
        $this->model = $article;
        $this->authStr = '文章';
    }
    /**
     * 编辑数据
     */
    public function editData($id)
    {
        $data = $this->model->find($id);
        $categoryData = Category::where('type', Category::ARTICLE_TYPE)->get();
        $this->selectDefault = '';
        $this->getParent($data->category_id, $categoryData);
        $data->category_id= $this->selectDefault;
        // dd($data);
        return $this->response($this->responseMessage, $this->statusCode, $data);
    }

    protected function getParent(int $child_id, $data, $tmpArr = [])
    {

        $tmpData = $data->find($child_id);
        $parent_id = $tmpData->parent_id;

        $tmpArr[]=$child_id;
        if ($parent_id != 0) {
            $this->getParent($parent_id, $data, $tmpArr);
        } else {
           
            $this->selectDefault = implode('/',array_reverse($tmpArr));
        }
    }
    /**
     * 生成列表搜索条件和数据
     */
    protected function filterStore($sql)
    {
        $title = request('title');
        $category_id=request('category_id');
        $status=request('status');
        $sql=$sql->with( 'category:id,category_name');
        $map = [];
        if (!empty($title)) {
            $map[] = ['title', 'like', '%' . $title . '%'];
        }
        if (!empty( $status)) {
            $map[] = [ 'status',  $status];
        }
        if(!empty( $category_id)){
            if(strpos($category_id,'/')){
                $arr = explode('/', $category_id);
                $map[]=['category_id',end($arr)];
            }
        }
        return ['sql' => $sql, 'map' => $map];
    }
    /**
     * 生成新增编辑参数
     */
    protected function createParams()
    {
        $params = request(['title', 'cover', 'content', 'status', 'category_id']);
        if (strpos($params['category_id'], '/')) {
            $arr = explode('/', $params['category_id']);
            $params['category_id'] = end($arr);
        }

        return $params;
    }
    /**
     * 验证模块
     */
    protected function validatorBlock($type = false)
    {
        $rule = [
            'title' => 'required|string',
        ];
        $validator = Validator::make(request()->all(), $rule);
        return $validator;
    }

}
