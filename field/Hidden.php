<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:07
 */

namespace iceand\field;


class Hidden
{
    public function main($item){
        $html = <<<EOT
<input type="hidden" name="{$item['field']}"  value="{$item['value']}" placeholder="请输入..." class="layui-input" >
<script type="text/javascript">
$('.{$item['field']}').hide()
</script>
EOT;



        return $html;
    }
}