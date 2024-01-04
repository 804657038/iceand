<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:22
 */

namespace iceand\field;


class InlineInput
{
    /**
     * @title 行input输入
     * @param $item
     * @return string
     */
    public function main($item){
        $html = '';
        $disabled = "";
        if(isset($item['disabled']) && $item['disabled'] === true){
            $disabled = "disabled";
        }
        $required = "";
        if(isset($item['required'])){
            $required = "required";
        }
        foreach ($item['option'] as $val){
            $html .='<div class="layui-input-inline">';
            $html .=$val['title'];
            $script = "";
            if(isset($val['script'])){
                $script = 'oninput="'.$val['script'].'"';
            }

            $type = 'type="text"';
            if(isset($val['type'])){
                $type = 'type="number"';
            }
            $maxlenth ="";
            if(isset($val['maxlenth']) && abs($val['maxlenth'])>0){
                $maxlenth = "maxlength='{$val['maxlenth']}'";
            }
            $placeholder = "请输入...";
            if(isset($val['placeholder'])){
                $placeholder = $val['placeholder'];
            }
            $html .= '<input '.$script.' '.$type.' '.$maxlenth.' '.$disabled.' '.$required.' name="'.$val['field'].'"  value="'.$val['value'].'" placeholder="'.$placeholder.'" class="layui-input">';
            $html .='</div>';
        }
        return $html;
    }
}