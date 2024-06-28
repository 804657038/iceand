<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/6/27
 * Time: 16:57
 */

namespace iceand\field;

/**
 * @title 密码输入
 * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填','maxlenth'=>'字段长度']
 * @param $item
 * @return string
 */
class Password
{
    public function main($item){
        $maxlenth = "";
        if(isset($item['maxlenth']) && abs($item['maxlenth'])>0){
            $maxlenth = 'maxlength="'.$maxlenth.'"';
        }
        $required = "";
        if(isset($item['required'])){
            $required = "required";
        }
        $disabled = "";
        if(isset($item['disabled']) && $item['disabled'] === true){
            $disabled = "disabled";
        }
        $html ='<input type="password" '.$maxlenth.' name="'.$item['field'].'"  '.$disabled.' value="'.$item['value'].'" placeholder="请输入..." class="layui-input" '.$required.'>';

        return $html;
    }
}