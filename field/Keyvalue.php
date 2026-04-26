<?php

namespace iceand\field;

use think\facade\View;

/**
 * keyvalue字段
 */
class Keyvalue
{
    /**
     * value格式 type:类型，key:字段key,title:字段名称,option：选项，required：是否必填
     * @param $item
     * @return void
     */
    public function main($item){
        $value = $item['value']?json_decode($item['value'],true):[];
        $currentFilePath = dirname(__FILE__).'/../view/keyvalue.html';
        $fields = $this->fields();
        $retfileds = [];
        foreach ($fields as $key=>$field){
            $retfileds[]=['key'=>$key,'val'=>$field];
        }

        $html = View::fetch($currentFilePath,[
            "field_name"=>$item['field'],
            "values"=>!empty($value)?json_encode($value,JSON_UNESCAPED_UNICODE):"",
            "fields"=>json_encode($retfileds,JSON_UNESCAPED_UNICODE),
        ]);
        return $html;
    }
}