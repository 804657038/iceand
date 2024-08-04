<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/8/4
 * Time: 11:52
 */

namespace iceand\search;


class Group
{
    public function main($val){
        $body = "";
        foreach ($val['option'] as $v){
            if($v['type'] == "select"){
                $body .='<div class="layui-input-inline" style="width: 80px;border-right: 1px solid #eee;"><select name="'.$v['name'].'" id="" lay-search="">';
                foreach ($v['option'] as $c){
                    $body .='<option value="'.$c['value'].'">'.$c['label'].'</option>';
                }

                $body .='</select></div>';
            }else{
                $body .='<div class="layui-input-inline" style="width: 150px;">';
                $body .='<input name="'.$v['name'].'" value="" placeholder="" class="layui-input">';
                $body .='</div>';
            }

        }

        $html = <<<EOT
 <div class="layui-input-inline" style="width: 231px;">
{$body}
</div>
EOT;
        return $html;
    }
}