<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:18
 */

namespace iceand\field;


class Textarea
{

    /**
     * @title 多行文本输入
     * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填']
     * @param $item
     * @return string
     */
    public function amin($item){
        $maxlenth = "";
        if(isset($item['maxlenth']) && abs($item['maxlenth'])>0){
            $maxlenth = "maxlength='{$item['maxlenth']}'";
        }
        $required = "";
        if(isset($item['required'])){
            $required = "required";
        }
        $disabled = "";
        if(isset($item['disabled']) && $item['disabled'] === true){
            $disabled = "disabled";
        }
        $html ='<textarea '.$maxlenth.' name="'.$item['field'].'" '.$required.' '.$disabled.' class="layui-textarea" placeholder="请输入数据内容">'.$item['value'].'</textarea>';
        return $html;
    }
}