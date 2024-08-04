<?php
namespace iceand\search;
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/7/21
 * Time: 4:28
 */

class DateRang
{
    public function main($val){
        $input  = input($val['name']);
        $html = <<<EOT
        <div class="layui-input-inline">
        <input data-date-range name="{$val['name']}" value="{$input}" placeholder="请选择时间" class="layui-input">

</div>
EOT;
    return $html;
    }
}