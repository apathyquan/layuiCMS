<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class UserLoginRecord extends Model
{
    protected $guarded = [];
    
    public function user(){
        return  $this->belongsTo(User::class);
    }
    /**
     * @description: 利用淘宝的ip地址库获获取ip + 地址
     * @param {type} 
     * @return: 
     */
    protected function getIpAddress()
    {
        $opts = array(
            'http' => array(
                'method'  => "GET",
                'timeout' => 5
            ),
        );
        $context = stream_context_create($opts);
        $ip = request()->getClientIp();
        if (strpos($ip, "127.0.0.") === true) {
            return '';
        }
        $url_ip = 'http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip;

        $str = @file_get_contents($url_ip, false, $context);
        if (!$str) {
            return "";
        }
        $json = json_decode($str, true);
        $country = '';
        $province = '';
        $city = '';
        $area = '';
        if ($json['code'] == 0) {
            // $ipcity = $json['data']['region'] . $json['data']['city'];
            $country = $json['data']['country'];
            $province = $json['data']['region'];
            $city = $json['data']['city'];
            $area = $json['data']['area'];
        }
        $data = compact('country', 'province', 'city', 'area', 'ip');
        return $data;
    }
}
