<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:05
 */

namespace iceand\field;

/**
 * @title  下拉选项
 * @param ['type'=>'select','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填','option'=>[['value'=>'选项值','label'=>'选项名称']]]
 * @param $item
 * @return string
 */
class Select
{
    public function main($item){
        $required = "";
        if(isset($item['required'])){
            $required = "required";
        }
        $disabled = "";
        if(isset($item['disabled']) && $item['disabled'] === true){
            $disabled = "disabled";
        }

        $html ='<select name="'.$item['field'].'" '.$disabled.' lay-filter="'.$item['field'].'" '.$required.' lay-search="">';
        if(!isset($item['option'])){
            $item['option'] = [];
        }
        foreach ($item['option'] as $val){

            if($item['value'] == $val['value']){
                $html .='<option value="'.$val['value'].'" selected>'.$val['label'].'</option>';
            }else{
                $html .='<option value="'.$val['value'].'">'.$val['label'].'</option>';
            }
        }
        $html .='</select>';
        return $html;
    }
}