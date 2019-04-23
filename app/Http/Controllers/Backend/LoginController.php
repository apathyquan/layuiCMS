<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Validator;
use App\{User, UserLoginRecord};
class LoginController extends BackendBaseController
{
    protected $responseMessage = '登录成功';
    //
    public function index()
    {
        $webTitle=$this->webTitle;
        return view('login/index',compact('webTitle'));
    }
    //登录逻辑
    public function login()
    {
        try {
            $validator = Validator::make(request()->all(), [
                'mobile'   => 'max:11||required',
                'password' => 'required||max:32',
            ]);
            
            $params = request(['mobile', 'password']);
            $params['status']=1;
            if ($data=auth('backend')->attempt($params)) {
                $userRecord = UserLoginRecord::getIpAddress();
                if ($userRecord) {
                    $userRecord['user_id'] = auth('backend')->id();
                    $userRecord['type'] = 2;
                    UserLoginRecord::create($userRecord);
                }
                return $this->response($this->responseMessage, $this->statusCode);
            }else{
               throw new Exception("请检查帐号或密码输入错误,或者账号已被禁用");    
            }

        } catch (Exception $e) {
            $errorMessage     = $e->getMessage();
            $this->response   = is_null(json_decode($errorMessage)) ? $e->getMessage() : json_decode($errorMessage);
            $this->statusCode = $this->errorCode;
            return $this->response($errorMessage, $this->statusCode);
        }
    }
    //退出登录
    public function logout()
    { 
        auth('backend')->logout();
         return redirect(route('login'));
       
    }
}
