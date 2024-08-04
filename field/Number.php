<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:16
 */

namespace iceand\field;


class Number
{
    /**
     * @title 整数
     * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填','maxlenth'=>'字段长度']
     * @param $item
     * @return string
     */
    public function main($item){
        $maxlenth ="";
        if(isset($item['maxlenth']) && abs($item['maxlenth'])>0){
            $maxlenth = "maxlength='{$item['maxlenth']}'";
        }
        if(isset($item['minlenth']) && abs($item['minlenth'])>0){
            $maxlenth = "minlenth='{$item['minlenth']}'";
        }
        $required = "";
        if(isset($item['required'])){
            $required = "required";
        }
        $disabled = "";
        if(isset($item['disabled']) && $item['disabled'] === true){
            $disabled = "disabled";
        }
        //value=value.replace(/[^\d]/g,'')
        $html = '<input type="number" '.$maxlenth.' '.$disabled.' '.$required.' name="'.$item['field'].'"  value="'.$item['value'].'" placeholder="请输入..." class="layui-input">';


        return $html;

    }
}