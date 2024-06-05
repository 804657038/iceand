<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/3/6
 * Time: 16:18
 */

namespace iceand\field;


class File
{
    /**
     * @title 文件上传
     * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填']
     * @return string
     */
    public function main($item){
        $html = <<<EOT
        <input type="text" name="{$item['field']}" value="{$item['value']}">
<a data-file data-{$item['field']} data-type="{$item['mine']}" data-field="{$item['field']}">上传文件</a>
<script>

    /*！文件上传过程及事件处理 */
        $('[data-{$item['field']}]').on('upload.choose', function (files) {
            // 文件选择后的事件
        }).on('upload.hash', function (event, file) {
            // file 当前文件对象
        }).on('upload.progress', function (event, obj) {
            // obj.file 当前文件对象
            // obj.event 文件上传进度事件
            // obj.number 当前上传进度值
        }).on('upload.done', function (event, obj) {
            // obj.file 当前完成的文件对象，每个文件上传成功将会调用
            // obj.data 当前文件上传后服务端返回的内容，部分云上传不会返回数据
        }).on('upload.complete', function (event) {
            // 全部文件上传成功
          
        });
</script>
EOT;

        return $html;
    }
}