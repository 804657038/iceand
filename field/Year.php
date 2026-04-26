<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:20
 */

namespace iceand\field;


class Year
{

    /**
     * @title 日期选择插件
     * @param $item
     */
    public function main($item){
        $html = <<<EOT
<input data-date-input="year" name="{$item['field']}" value="{$item['value']}" placeholder="请选择年" class="layui-input">
EOT;
        return $html;

    }

}