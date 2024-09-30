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
 * @deprecated 使用示例
 *
 */
//$tablelist = '';

//FormItem::multiline('viewing','观看逻辑')->multilines([
//    [
//        'field'=>'platform',
//        'title'=>'平台',
//        'type'=>'select',
//        'option'=>$platformlist_option
//    ],[
//        'field'=>'num',
//        'title'=>'观看数量',
//        'type'=>'number',
//    ]
//])->value($tablelist)
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
        $tablelist = '';

        if($item['value']){
            if(is_array($item['value'])){
                foreach ($item['value'] as $key=>$val){
                    $tablelist .='<tr>';
                    foreach ($item['multiline'] as $v){
                        if($v['type'] == "select"){
                            $tablelist .="<td><select name='{$item['field']}[{$key}][{$v['field']}]'>";
                            foreach ($v['option'] as $s){
                                if($val[$v['field']] && $s['value'] == $val[$v['field']]){
                                    $tablelist .="<option selected value='{$s['value']}'>{$s['label']}</option>";

                                }else{
                                    $tablelist .="<option value='{$s['value']}'>{$s['label']}</option>";

                                }
                            }

                            $tablelist .="</select></td>";
                        }else{
                            $tablelist .="<td><input type='{$v['type']}' name='{$item['field']}[{$key}][{$v['field']}]' value='{$val[$v['field']]}' class='layui-input'></td>";
                        }
                    }

                    $tablelist .='<td> <a href="javascript:;" style="color:red;" onclick="$(this).parent().parent().remove()">删除</a> </td>';
                    $tablelist .='</tr>';
                }
            }else{
                $tablelist = $item['value'];

            }

        }

        if(!isset($item['disabled'])){
            $btn = <<<EOT
<button type="button" class="layui-btn layui-btn-sm {$item['field']}_btn" data-title="添加">添加</button>
EOT;
;
        }else{
            $btn = '';
        }

        $json = json_encode($item['multiline'],256);
$html = <<<EOT
{$btn}
<table class="layui-table {$item['field']}_table">
<thead>{$tablehead}</thead>
<tbody>{$tablelist}</tbody>
</table>
<script>
   var {$item['field']}json = JSON.parse('{$json}')
   var btn_class = '{$item['field']}_btn';

   var table_class = '{$item['field']}_table'
   $('.{$item['field']}_btn').on('click',function() {
  
     var {$item['field']}html = `<tr>`

     var {$item['field']}index = $('.{$item['field']}_table tbody').find('tr').length
     
     {$item['field']}json.forEach((item)=>{
         var formItem = ''
         if(item.type == 'select'){
             formItem +="<select name='{$item['field']}["+{$item['field']}index+"]["+item.field+"]'>"
             item.option.forEach((val)=>{
                 formItem +='<option value="'+val.value+'">'+val.label+'</option>'
             })
             formItem +="</select>"
         }else{
            formItem = "<input type='"+item.type+"' name='{$item['field']}["+{$item['field']}index+"]["+item.field+"]' class='layui-input'>" 
         }
         if(item.type == 'hidden'){
             formItem +=''
         }
         {$item['field']}html +='<td>'+formItem+'</td>'
         
     })
     {$item['field']}html +='<td> <a href="javascript:;" style="color:red;" onclick="$(this).parent().parent().remove()">删除</a> </td>'
     
     {$item['field']}html +=`</tr>`
     $('.{$item['field']}_table tbody').append({$item['field']}html)
     layui.form.render('select');
     
   })
    
</script>
EOT;
    return $html;
    }
}