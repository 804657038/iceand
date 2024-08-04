<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/7/21
 * Time: 5:32
 */

namespace iceand\field;


class Diy
{
    public function main($item){
        $html = <<<EOT
{$item['value']}
EOT;
    return $html;
    }
}