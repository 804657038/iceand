<?php

namespace iceand;
use think\admin\extend\JwtExtend;
use think\facade\Cache;
use think\facade\Cookie;

class Sms
{
    static public $checkkey = "sms_checkkey";
    static public $check_timeout_key = "_time_out";
    static public $jwtkey = "admin_sms_jwt_checkkey";

    /**
     * 发送验证码
     * @param $phone
     * @param $code
     * @param $suffix
     * @return string
     */
    static public function send($phone, $code,$suffix = ""){
        if(!$phone) throw new \iceand\AuthException("请先设置手机号码");
        $ip = request()->ip();
        $cachekey = self::$check_timeout_key.$ip;


        $has = Cache::has($cachekey);

        if($has) throw new \iceand\AuthException("请不要频繁点击");
        $data = [
            'phone' => $phone,
            'code' => $code,
            'time' => time(),
        ];
        $token = JwtExtend::token([
            'iss'=>'baixiajixu_sms',
            'iat'=>time(),
            'exp'=>time() + 300,
            'nbf'=>time(),
            'aud'=>request()->domain(),
            'sub'=>self::$checkkey,
            'jti'=>json_encode($data)
        ],self::$jwtkey);
        Cache::set($cachekey, 1,60);
        Cookie::set(self::$checkkey, $token,300);
        return $token;
    }

    /**
     * 验证验证码
     * @param $code
     * @param $phone
     * @return void
     * @throws \think\admin\Exception
     */
    static public function checkvode($code,$phone,string $isapi="")
    {
        if($isapi){
            $cookie = $isapi;
        }else{
            $cookie = Cookie::get(self::$checkkey);
            if(!$cookie) throw new \iceand\AuthException("短信验证码错误");
        }

        $jwtData = JwtExtend::verify($cookie,self::$jwtkey);

        $jti = json_decode($jwtData['jti'],true);
        if($jti['phone']!=$phone) throw new \iceand\AuthException("短信验证码错误");
        if($jti['code']!=$code) throw new \iceand\AuthException("短信验证码错误");
        if(!$isapi){
            Cookie::delete(self::$checkkey);
        }
    }
}