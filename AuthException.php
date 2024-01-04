<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2022/12/11
 * Time: 21:36
 */

namespace iceand;

use think\exception\HttpResponseException;

class AuthException extends HttpResponseException
{
    public function __construct($message, $code = 0)
    {

        parent::__construct(json()->data([
            "code"=>$code,
            "info"=>$message,
            "data"=>[],
            "url"=>""
        ]));

    }
}