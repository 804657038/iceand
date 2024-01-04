<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:20
 */

namespace iceand\field;


class Date
{

    /**
     * @title 日期选择插件
     * @param $item
     */
    public function main($item){
        $html = <<<EOT
<input data-date-input name="{$item['field']}" value="{$item['value']}" placeholder="请选择时间" class="layui-input">
EOT;
        return $html;

    }

}