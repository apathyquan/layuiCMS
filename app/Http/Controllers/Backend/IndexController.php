<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\{User,Config, UserLoginRecord};
class IndexController extends BackendBaseController
{

    public function index()
    {
        $webTitle=$this->webTitle;
         return view('index/index',compact('webTitle'));
    }
    public function home(){
        $data =auth('backend')->user()->roles->pluck('name')->toArray();
        $loginInfo=UserLoginRecord::where('user_id', auth('backend')->id())->orderBy('created_at','desc')->first();
        $loginInfo->address= $loginInfo->country . $loginInfo->province . $loginInfo->city;
        $data= implode(',', $data);
    	return view('index/home',compact('data', 'loginInfo'));
    }

}
