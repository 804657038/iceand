<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:19
 */

namespace iceand\field;


class Images
{

    /**
     * @title 多图片上传
     * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填']
     * @return string
     */
    public function main($item){

        $html = <<<EOT
<input type="hidden" data-quality="0.5" name="{$item['field']}" value="{$item['value']}">
<script>$('[name={$item['field']}]').uploadMultipleImage();</script>
EOT;
        return $html;
    }
}