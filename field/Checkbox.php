<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:05
 */

namespace iceand\field;

/**
 * @title 多选
 * @param ['type'=>'radio','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填','option'=>[['value'=>'选项值','label'=>'选项名称']]]
 * @param $item
 * @return string
 */
class Checkbox
{
    public function main($item){
        $html ='';
        $required = "";
        if(isset($item['required'])){
            $required = "required";
        }
        $disabled = "";
        if(isset($item['disabled']) && $item['disabled'] === true){
            $disabled = "disabled";
        }
        if(!isset($item['option'])){
            $item['option'] = [];
        }
        foreach ($item['option'] as $ke=>$val){
            $html .='<label class="think-checkbox">';
            if($item['value'] && in_array($val['value'],$item['value'])){
                $html .='<input '.$required.' '.$disabled.' type="checkbox" checked name="'.$item['field'].'['.$ke.']" value="'.$val['value'].'" lay-ignore lay-filter="'.$item['field'].'">'.$val['label'];
            }else{
                $html .='<input '.$required.' '.$disabled.' type="checkbox" name="'.$item['field'].'['.$ke.']" value="'.$val['value'].'" lay-ignore lay-filter="'.$item['field'].'">'.$val['label'];
            }
            $html .='</label>';

        }
        return $html;
    }
}