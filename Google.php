<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/10/11
 * Time: 9:37
 */

namespace iceand;
use RobThree\Auth\TwoFactorAuth;
/**
 * 谷歌的类
 * Class Google
 * @package iceand
 */
class Google
{
    static private $secretKey = "JK6W2JGMPMN43J7D";

    /**
     * 二次验证
     * @param $code
     * @return bool
     */
    static public function TwoFactorAuth($code){
//        return true;

        $auth = new TwoFactorAuth("shouyijia", 6, 30);  // 创建一个 TwoFactorAuth 实例，设置应用名称、认证码长度以及每个认证码的有效时间
        if (!$auth->verifyCode(self::$secretKey, $code)) {  // 验证用户输入的验证码是否正确
            return false;
        }
        return true;
    }

    /**
     * 谷歌验证码图片链接
     */
    static public function googleQrcode(){
        $auth = new TwoFactorAuth("shouyijia", 6, 30);  // 创建一个 TwoFactorAuth 实例，设置应用名称、认证码长度以及每个认证码的有效时间
        $qrCodeUrl = $auth->getQRCodeImageAsDataUri("shouyijia", self::$secretKey);
        return $qrCodeUrl;
    }
}