<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/8/6
 * Time: 7:52
 */

namespace iceand\search;


class Condition
{
    public function main($val){
        $body = "";
        $body .='<div class="layui-input-inline" style="width: 50px;border-right: 1px solid #eee;"><select name="'.$val['name'].'[condition]" id="" lay-search="">';
        $body .='<option value="=">=</option>';
        $body .='<option value=">">></option>';
        $body .='<option value=">=">>=</option>';
        $body .='<option value="<"><</option>';
        $body .='<option value="<="><=</option>';
        $body .='</select></div>';

        $body .='<div class="layui-input-inline" style="width: 100px;">';
        $body .='<input name="'.$val['name'].'[value]" value="" placeholder="" class="layui-input">';
        $body .='</div>';

        $html = <<<EOT
 <div class="layui-input-inline" style="width: 160px;">
{$body}
</div>
EOT;
        return $html;
    }
}