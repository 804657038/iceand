<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/5/12
 * Time: 11:41
 */

namespace iceand\field;


class Legend
{
    public function main($item){
        $html = <<<EOT
<fieldset class="layui-elem-field layui-field-title">
  <legend>{$item['label']}</legend>
  <div class="layui-field-box">

  </div>
</fieldset>
EOT;
    return $html;
    }
}