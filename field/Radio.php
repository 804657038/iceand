<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 19:52
 */

namespace iceand\field;

/**
 * @title 单选
 * @param ['type'=>'radio','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填','option'=>[['value'=>'选项值','label'=>'选项名称']]]
 * @param $item
 * @return string
 */
class Radio
{

    public function main($item){
        $html ='';
        foreach ($item['option'] as $val){
            $html .='<label class="think-checkbox">';
            if($item['value'] == $val['value']){
                $html .='<input type="radio" checked name="'.$item['field'].'" value="'.$val['value'].'" lay-ignore lay-filter="'.$item['field'].'">'.$val['label'];
            }else{
                $html .='<input type="radio" name="'.$item['field'].'" value="'.$val['value'].'" lay-ignore lay-filter="'.$item['field'].'">'.$val['label'];
            }
            $html .='</label>';

        }
        return $html;
    }
}