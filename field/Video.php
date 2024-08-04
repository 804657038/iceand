<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/7/21
 * Time: 5:37
 */

namespace iceand\field;


class Video
{
    public function main($item){
        $html = <<<EOT
        <input data-file data-{$item['field']} data-type="mp4,mov" data-field="{$item['field']}" type="hidden" name="{$item['field']}" value="{$item['value']}">

<script >
$('[data-{$item['field']}]').uploadOneVideo();
</script>
EOT;
    return $html;
    }
}