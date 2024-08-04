<?php
namespace iceand\search;
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/7/21
 * Time: 4:30
 */

class Input
{
    public function main($val){
        $input = input($val['name']);
        $html = <<<EOT
<div class="layui-input-inline">
    <input type="text" name="{$val['name']}" value="{$input}" class="layui-input">

</div>

EOT;
    return $html;
    }
}