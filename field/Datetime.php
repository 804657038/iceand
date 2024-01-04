<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:20
 */

namespace iceand\field;


class Datetime
{
    /**
     * @title 日期时间选择插件
     * @param $item
     * @return string
     */
    public function main($item){
        $html = <<<EOT
<input data-date-input="datetime" name="{$item['field']}" value="{$item['value']}" placeholder="请选择时间" class="layui-input">
EOT;
        return $html;
    }
}