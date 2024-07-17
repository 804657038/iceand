<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/6/28
 * Time: 17:11
 */

namespace iceand\field;

/**
 * 引用区块
 * Class Quote
 * @package iceand\field
 */
class Quote
{
    public function main($item){
        $html = <<<EOT
<blockquote class="layui-elem-quote">{$item['value']}</blockquote>
EOT;
        return $html;
    }
}