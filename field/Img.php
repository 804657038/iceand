<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:19
 */

namespace iceand\field;


class Img
{
    /**
     * @title 单图片上传
     * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填']
     * @return string
     */
    public function main($item){
        if(isset($item['disabled']) && $item['disabled'] === true){
            $html = <<<EOT
<img src="{$item['value']}" width="80">
EOT;
        }else{
            $html = <<<EOT
<input type="hidden" data-quality="0.5" name="{$item['field']}" value="{$item['value']}">
<script>$('[name={$item['field']}]').uploadOneImage();</script>
EOT;
        }

        return $html;
    }
}