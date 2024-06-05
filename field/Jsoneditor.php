<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/5/30
 * Time: 19:33
 */

namespace iceand\field;

/**
 * JSON编辑器
 * Class Jsoneditor
 * @package iceand\field
 */
class Jsoneditor
{
    public function main($item){
        $sdisabled = (isset($item['disabled']) && $item['disabled'])?"true":"false";

        $html = <<<EOT
        <input type="hidden" name="{$item['field']}" value="{$item['value']}">
    <div class="{$item['field']}" id="{$item['field']}"></div>
<script >
var element = document.getElementById('{$item['field']}');
var disableds = '{$sdisabled}'
var disabled
if(disableds == "true"){
    disabled = true
}else{
    disabled = false
}


var {$item['field']} = new JSONEditor(element,{
      theme: 'foundation3',
      schema: {
          type: "object",
          properties: {
            
          },
          format: "grid"
      },
       template: 'hogan',
       disable_collapse:true,
       disable_edit_json:true,
       disable_properties:disabled
});
var jsonold = '{$item['value']}';
if(jsonold){
    {$item['field']}.setValue(jsonold?JSON.parse(jsonold):null);

}
{$item['field']}.on('change', function() {
  // 做些什么
  var value = {$item['field']}.getValue();
  console.log(value)
  $('[name="{$item['field']}"]').val(JSON.stringify(value))
 
});
</script>
EOT;

        return $html;
    }
}