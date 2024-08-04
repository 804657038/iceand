<?php
namespace iceand\search;
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/7/21
 * Time: 4:31
 */

class Linkage3
{
    public function main($val){
        $option = "";
        foreach ($val['option'] as $v){
            $option .="<option value='{$v['value']}'>{$v['label']}</option>";
        }
        $html = <<<EOT
<div class="layui-input-inline">
                    <select name="{$val['param'][0]['field']}" lay-filter="{$val['param'][0]['field']}" lay-search="">
                        <option value="">请选择</option>
                        {$option}
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="{$val['param'][1]['field']}" lay-filter="{$val['param'][1]['field']}" lay-search="">
                        <option value="">请选择</option>
                    </select>
                </div>

                <div class="layui-input-inline">
                    <select name="{$val['param'][2]['field']}" lay-filter="{$val['param'][2]['field']}" lay-search="">
                        <option value="">请选择</option>
                    </select>
                </div>

                <script>
                    function ajaxlist{$val['name']}(pid,parent) {

                        $.form.load('{$val['ajaxurl']}', {pid:pid}, "get", function(ret) {
                            var field1 = '{$val['param'][1]['value']}'
                            var field2 = '{$val['param'][2]['value']}'
                            var field_value = 0;
                            if(parent == 1){
                                field_value = field1
                            }else{
                                field_value = field2
                            }
                            var h ='<option value="">请选择</option>'
                            ret.info.forEach(function(val){
                                if(field_value == val.value){
                                    h +='<option value="'+val.value+'" selected>'+val.label+'</option>'
                                }else{
                                    h +='<option value="'+val.value+'">'+val.label+'</option>'
                                }
                            })
                            if(parent == 1){
                                $('[name="{$val['param'][1]['field']}"]').html(h)
                                if(field_value){
                                    ajaxlist{$val['name']}(field_value,2)
                                }
                            }else{
                                $('[name="{$val['param'][2]['field']}"]').html(h)
                            }
                            layui.form.render('select');
                            return false
                        }, null, null, 'false');
                    }
                    $(function() {
                        // 数据状态切换操作
                        layui.form.on('select({$val['param'][0]['field']})', function (obj) {

                            ajaxlist{$val['name']}(obj.value,1)

                        });
                        layui.form.on('select({$val['param'][1]['field']})', function (obj) {

                            ajaxlist{$val['name']}(obj.value,2)

                        });
                        if($('[name="{$val['param'][0]['field']}"]').val()){
                            ajaxlist{$val['name']}($('[name="{$val['param'][0]['field']}"]').val(),1)
                        }

                    })

                </script>
EOT;
    return $html;
    }
}