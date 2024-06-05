<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/6/3
 * Time: 17:04
 */

namespace iceand\field;

/**
 * 自定义多行文本输入
 * Class Multiline
 * @package iceand\field
 */
class Multiline
{
    public function main($item){
        $tablehead = "<tr>";
        if(isset($item['multiline'])){
            foreach ($item['multiline'] as $val){
                $tablehead .='<td>'.$val['title'].'</td>';
            }
        }
        $tablehead .= "<td>操作</td></tr>";
        $tablelist = $item['value'];



        $json = json_encode($item['multiline'],256);
$html = <<<EOT
<button type="button" class="layui-btn layui-btn-sm {$item['field']}_btn" data-title="添加">添加</button>
<table class="layui-table {$item['field']}_table">
<thead>{$tablehead}</thead>
<tbody>{$tablelist}</tbody>
</table>
<script>
   var json = JSON.parse('{$json}')
   console.log(json)
   var btn_class = '{$item['field']}_btn';
   var table_class = '{$item['field']}_table'
   $('.'+btn_class).on('click',function() {
     var html = `<tr>`

     var index = $('.'+table_class+' tbody').find('tr').length
     
     json.forEach((item)=>{
         var formItem = ''
         if(item.type == 'select'){
             formItem +="<select name='{$item['field']}["+index+"]["+item.field+"]'>"
             item.option.forEach((val)=>{
                 formItem +='<option value="'+val.value+'">'+val.label+'</option>'
             })
             formItem +="</select>"
         }else{
            formItem = "<input type='"+item.type+"' name='{$item['field']}["+index+"]["+item.field+"]' class='layui-input'>" 
         }
         html +='<td>'+formItem+'</td>'
         
     })
     html +='<td> <a href="javascript:;" style="color:red;" onclick="$(this).parent().parent().remove()">删除</a> </td>'
     
     html +=`</tr>`
     $('.'+table_class+' tbody').append(html)
     layui.form.render('select');
     
   })
    
</script>
EOT;
    return $html;
    }
}