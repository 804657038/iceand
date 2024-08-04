<?php
namespace iceand\search;
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/7/21
 * Time: 4:17
 */

class Select
{
    public function main($val){
        $option = '';
        $input = input($val['name']);
        foreach ($val['option'] as $v){
            if($v['value'] == $input){
                $option .="<option value='{$val['value']}' selected>{$val['label']}</option>";

            }else{
                $option .="<option value='{$val['value']}'>{$val['label']}</option>";
            }
        }
        $html = <<<EOT
<div class="layui-input-inline">
   <select name="{$val['name']}" lay-search class="layui-select">
        <option value=''>-- {:lang('全部')} --</option>
        {$option}
   </select>

</div>
EOT;
    return $html;
    }
}