<?php

namespace App\Common;

use Response;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

/**
 * @author zengzq <[908011399@qq.com]>
 */
trait ApiResponse
{
    protected $statusCode = FoundationResponse::HTTP_OK;
    protected $errorCode = FoundationResponse::HTTP_UNPROCESSABLE_ENTITY;
    protected $responseMessage = '操作成功';
    // public function __construct(FoundationResponse $FoundationResponse){
    //     $this->statusCode = $FoundationResponse::HTTP_OK;
    //     $this->errorCode = $FoundationResponse::HTTP_UNPROCESSABLE_ENTITY;
    // }

    /**
     * [setStatusCode description]
     * @param [type] $code [description]
     */
    protected function setStatusCode($code)
    {
        $this->statusCode = $code;
        return $this;
    }
    protected function getStatusCode()
    {
        return $this->statusCode;
    }
    /**
     * 响应的格式
     * @param  [type] $message [description]
     * @param  string $status  [description]
     * @return [type]          [description]
     */
    protected function message($message, $data, $count)
    {
        $status = $this->statusCode == 200 ? 'success' : 'failed';

        if (is_array($data)) {

            if ($count === 0 || $count > 0) {
                $result = [
                    'code'    => $this->statusCode,
                    'status'  => $status,
                    'message' => $message,
                    'data' => $data,
                    'count' => $count
                ];
            } else {
                $result = [
                    'code'    => $this->statusCode,
                    'status'  => $status,
                    'message' => $message,
                    'data' => $data
                ];
            }
        } else {
            $result = [
                'code'    => $this->statusCode,
                'status'  => $status,
                'message' => $message,
            ];
        }

        return $this->responseRun($result);
    }
    /**
     * 响应操作
     * @param  [type] $result [description]
     * @param  [type] $type   [description]
     * @return [type]         [description]
     */
    protected function responseRun($result)
    {

        return  response($result, $result['code']);
    }

    /**
     * 响应方法
     * @param  [type] $message [description]
     * @param  [type] $code    [description]
     * @param  string $status  [description]
     * @param  array  $data    [description]
     * @return [type]          [description]
     */
    public function response($message, $code = FoundationResponse::HTTP_OK, $data=false, ...$responseParams)
    {
        if (!is_array($data) && is_object($data)) {
            $data=$data->toArray();
        }
        $count = false;
        if ($responseParams && array_key_exists('count', ...$responseParams)) {
            $count = $responseParams[0]['count'];
        }
        return $this->setStatusCode($code)->message($message, $data, $count);
    }
}
