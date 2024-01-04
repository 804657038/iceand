<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:19
 */

namespace iceand\field;


class Editor
{

    /**
     * @title 多行文本输入
     * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填']
     * @param $item
     * @return string
     */
    public function main($item){
        $value = $item['value']?htmlspecialchars_decode($item['value']):'';
        $html = <<<EOT
<textarea data-editor name="{$item['field']}" class="layui-textarea" placeholder="请输入数据内容">{$value}</textarea>

EOT;


        return $html;
    }
}