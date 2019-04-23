<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Common\ApiResponse;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;
use Validator;
use Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponse;
    /**
     * 生成树状数据
     */
    protected function treeData(array $items = [], $son = 'children', $pid = 'parent_id', $id = 'id')
    {
        $tree = [];
        $tmpData = []; //临时数据
        foreach ($items as $item) {
            $tmpData[$item[$id]] = $item;
        }
        foreach ($items as $item) {
            if (isset($tmpData[$item[$pid]])) {
                $tmpData[$item[$pid]][$son][] = &$tmpData[$item[$id]];
            } else {
                $tree[] = &$tmpData[$item[$id]];
            }
        }
        unset($tmpData);
        return $tree;
    }
    protected function upload($fileString, $appoint_path = '', $maxWidth = '')
    {
        try {
            $validated = Validator::make(request()->file(), [
                $fileString => 'required',
            ]);
            if ($validated->fails()) {
                throw new Exception($validated->errors()->first());
            }
            $file = request()->file($fileString);
            //判断文件是否上传成功
            if ($file->isValid()) {
                $base_path = 'uploads/' . date("Ymd", time()) . '/';
                $final_path = $base_path . $appoint_path;
                $ext = $file->getClientOriginalExtension();  // 扩展名
                // 源文件最终文件名
                $file_name = $this->getFileName($ext);
                $file->move($final_path, $file_name);
                $thumb_url = '';
                // 进行压缩
                if (!empty($maxWidth)) {
                    // 压缩文件最终文件名
                    $thumb_name = $this->getFileName($ext, '_thumb' . $maxWidth);
                    // 进行图片压缩
                    $this->reduceSize($final_path . '/' . $file_name, $final_path . '/' . $thumb_name, $maxWidth);
                    $thumb_url = '/' . $final_path . '/' . $thumb_name; // 压缩图片路径
                }
                $final_path=rtrim($final_path,'/');
                $url = '/' . $final_path .'/' . $file_name; // 源图片路径
            }
            return [
                'bool' => true,
                'url' => $url,
                'thumb_url' => $thumb_url,
                'message' => '上传成功',
            ];
        } catch (Exception $e) {
            return [
                'bool' => false,
                'url' => '',
                'message' => is_null(json_decode($e->getMessage())) ? $e->getMessage() : json_decode($e->getMessage()),
            ];
        }
    }
    /**
     * 获取文件名
     * @author Guangyun Song 2018-05-25
     * @param  string $ext  [description]
     * @param  string $diff [description]
     * @return [type]       [description]
     */
    public function getFileName($ext = 'png', $diff = '')
    {
        return $this->randName(20) . $diff . '.' . $ext;
    }

    private static function randName($len = 30)
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234565789'), 0, $len);
    }

    /**
     * 压缩图片
     * @author Guangyun Song 2018-05-25
     * @param  [type] $original   [description]
     * @param  [type] $thumb_path [description]
     * @param  [type] $maxWidth   [description]
     * @return [type]             [description]
     */
    public function reduceSize($original, $thumb_path, $maxWidth)
    {
        $image = Image::make($original); // 获取原图路径
        // 进行大小调整的操作
        $image->resize($maxWidth, null, function ($constraint) {
            // 设定宽度是 $maxWidth，高度等比例双方缩放
            $constraint->aspectRatio();
            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });
        // 对图片修改后保存
        $image->save($thumb_path); //缩略图保存路径
    }

    /**
     * @description: 分析枚举类型配置值 格式 a:名称1,b:名称2
     * @param {str：string} 
     * @return: 
     */
    protected function parseValue(string $str): array
    {
        $str = trim($str);
        $tmp = preg_split('/[,;\r\n]+/', $str);

        $value = [];
        if (strpos($str, ':')) {
            foreach ($tmp as $val) {
                list($k, $v) = explode(':', $val);
                // dump($k,$v);
                $value[$k] = $v;
            }
        } else {
            $value = $tmp;
        }
        // dd($value);
        return $value;
    }
    /**
     * @description:根据数据 
     * @param {dataArr:需要分组的数据；keyStr:分组依据} 
     * @author Quan
     * @return: 
     */
    protected function dataGroup(array $dataArr, string  $keyStr): array
    {
        $newArr = [];
        foreach ($dataArr as $k => $val) {    //数据根据日期分组
            $newArr[$val[$keyStr]][] = $val;
        }
        return $newArr;
    }
}
