<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/1/4
 * Time: 20:21
 */

namespace iceand\field;


class Linkage2
{
    /**
     * @title 二级联动搜索
     * @param [
     * 'type'=>'select',
     * 'label'=>'字段名称',
     * 'field'=>'字段',
     * 'value'=>'值',
     * 'required'=>'是否必填',
     * 'option|第一个选项'=>[['value'=>'选项值','label'=>'选项名称']],
     * 'param'=>[['field'=>'参数1字段','value'=>'参数1值'],['field'=>'参数2字段','value'=>'参数2值']]],
     * 'ajaxlist'=>'ajax请求list'
     * @param $item
     */
    public function main($item){
        $html = '<div class="layui-input-inline">';

        $html .='<select name="'.$item['param'][0]['field'].'" lay-filter="'.$item['param'][0]['field'].'" lay-search="">';
        $html .='<option value="">请选择</option>';
        foreach ($item['option'] as $val){
            if($item['param'][0]['value'] == $val['value']){
                $html .='<option value="'.$val['value'].'" selected>'.$val['label'].'</option>';
            }else{
                $html .='<option value="'.$val['value'].'">'.$val['label'].'</option>';
            }
        }
        $html .='</select>';

        $html .='</div>';
        $html .= '<div class="layui-input-inline">';
        $html .='<select name="'.$item['param'][1]['field'].'" lay-filter="'.$item['param'][1]['field'].'" lay-search="">';
        $html .='<option value="">请选择</option>';
        $html .='</select>';

        $html .='</div>';
        $html .= <<<EOT
<script>
        function ajaxlist{$item['field']}(pid) {
            
             $.form.load('{$item['ajaxurl']}', {pid:pid}, "get", function(ret) {
               var field1 = '{$item['param'][1]['value']}'
               
                     var h =''
                     ret.info.forEach(function(val){
                         if(field1 == val.value){
                             h +='<option value="'+val.value+'" selected>'+val.label+'</option>'
                         }else{
                             h +='<option value="'+val.value+'">'+val.label+'</option>'
                         }
                     })
                     $('[name="{$item['param'][1]['field']}"]').html(h)
                     layui.form.render('select');
                     return false
             }, null, null, 'false');
        }
        $(function() {
           // 数据状态切换操作
            layui.form.on('select({$item['param'][0]['field']})', function (obj) {
   
                ajaxlist{$item['field']}(obj.value)
            
            });
            if($('[name="{$item['param'][0]['field']}"]').val()){
                ajaxlist{$item['field']}($('[name="{$item['param'][0]['field']}"]').val())
            }
        })
        
</script>         
EOT;
        return $html;
    }
}