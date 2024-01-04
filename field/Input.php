<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:06
 */

namespace iceand\field;

/**
 * @title 单行文本输入
 * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填','maxlenth'=>'字段长度']
 * @param $item
 * @return string
 */
class Input
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
        $html ='<input type="input" '.$maxlenth.' name="'.$item['field'].'"  '.$disabled.' value="'.$item['value'].'" placeholder="请输入..." class="layui-input" '.$required.'>';

        return $html;
    }
}