<?php

namespace iceand\field;

//自定义表单字段
use think\facade\View;

class Fields
{
    protected function fields()
    {
        return [
            'input'=>'单行文本',
            'number'=>'数字',
            'float'=>'浮点数',
            'radio'=>'单选',
            'checkbox'=>'多选',
            'select'=>'下拉选择',
            'textarea'=>'多行输入',
            'img'=>'单图上传',
            'date'=>'日期',
            'dateRange'=>'日期范围',
            'datetime'=>'时间',

        ];
    }

    /**
     * value格式 type:类型，key:字段key,title:字段名称,option：选项，required：是否必填
     * @param $item
     * @return void
     */
    public function main($item){
        $value = $item['value']?json_decode($item['value'],true):[];
        $currentFilePath = dirname(__FILE__).'/../view/fields.html';
        $fields = $this->fields();
        $retfileds = [];
        foreach ($fields as $key=>$field){
            $retfileds[]=['key'=>$key,'val'=>$field];
        }
        $html = View::fetch($currentFilePath,[
            "field_name"=>$item['field'],
            "values"=>count($value)>=1?json_encode($value,JSON_UNESCAPED_UNICODE):"",
            "fields"=>json_encode($retfileds,JSON_UNESCAPED_UNICODE),
        ]);
        return $html;
    }
}