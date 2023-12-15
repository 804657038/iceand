<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2023/11/16
 * Time: 16:41
 */

namespace iceand;


use think\facade\View;

class Form
{


    /**
     * @title 单选
     * @param ['type'=>'radio','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填','option'=>[['value'=>'选项值','label'=>'选项名称']]]
     * @param $item
     * @return string
     */
    public function radio($item){
        $html ='';
        foreach ($item['option'] as $val){
            $html .='<label class="think-checkbox">';
            if($item['value'] == $val['value']){
                $html .='<input type="radio" checked name="'.$item['field'].'" value="'.$val['value'].'" lay-ignore lay-filter="'.$item['field'].'">'.$val['label'];
            }else{
                $html .='<input type="radio" name="'.$item['field'].'" value="'.$val['value'].'" lay-ignore lay-filter="'.$item['field'].'">'.$val['label'];
            }
            $html .='</label>';

        }
        return $html;

    }
    /**
     * @title  下拉选项
     * @param ['type'=>'select','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填','option'=>[['value'=>'选项值','label'=>'选项名称']]]
     * @param $item
     * @return string
     */
    public function select($item){
        $required = "";
        if(isset($item['required'])){
            $required = "required";
        }
        $disabled = "";
        if(isset($item['disabled']) && $item['disabled'] === true){
            $disabled = "disabled";
        }
        $html ='<select name="'.$item['field'].'" '.$disabled.' lay-filter="'.$item['field'].'" '.$required.'>';
        foreach ($item['option'] as $val){
            if($item['value'] == $val['value']){
                $html .='<option value="'.$val['value'].'" selected>'.$val['label'].'</option>';
            }else{
                $html .='<option value="'.$val['value'].'">'.$val['label'].'</option>';
            }
        }
        $html .='</select>';
        return $html;
    }
    /**
     * @title 单行文本输入
     * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填','maxlenth'=>'字段长度']
     * @param $item
     * @return string
     */
    public function input($item){
        $maxlenth = "";
        if(isset($item['maxlenth']) && abs($item['maxlenth'])>0){
            $maxlenth = 'maxlength="'.$maxlenth.'"';
        }
        $required = "";
        if(isset($item['required'])){
            $required = "required";
        }
        $disabled = "";
        if(isset($item['disabled']) && $item['disabled'] === true){
            $disabled = "disabled";
        }
        $html ='<input type="input" '.$maxlenth.' name="'.$item['field'].'"  '.$disabled.' value="'.$item['value'].'" placeholder="请输入..." class="layui-input" '.$required.'>';

        return $html;
    }
    public function hidden($item){
$html = <<<EOT
<input type="hidden" name="{$item['field']}"  value="{$item['value']}" placeholder="请输入..." class="layui-input" >
<script type="text/javascript">
$('.{$item['field']}').hide()
</script>
EOT;



        return $html;
    }
    /**
     * @title 整数
     * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填','maxlenth'=>'字段长度']
     * @param $item
     * @return string
     */
    public function number($item){
        $maxlenth ="";
        if(isset($item['maxlenth']) && abs($item['maxlenth'])>0){
            $maxlenth = "maxlength='{$item['maxlenth']}'";
        }

        $required = "";
        if(isset($item['required'])){
            $required = "required";
        }
        $disabled = "";
        if(isset($item['disabled']) && $item['disabled'] === true){
            $disabled = "disabled";
        }

        $html = '<input oninput="value=value.replace(/[^\d]/g,\'\')" type="number" '.$maxlenth.' '.$disabled.' '.$required.' name="'.$item['field'].'"  value="'.$item['value'].'" placeholder="请输入..." class="layui-input">';
        return $html;

    }
    /**
     * @title 浮点数
     * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填','maxlenth'=>'字段长度']
     * @param $item
     * @return string
     */
    public function float($item){
        $maxlenth ="";
        if(isset($item['maxlenth']) && abs($item['maxlenth'])>0){
            $maxlenth = "maxlength='{$item['maxlenth']}'";
        }

        $required = "";
        if(isset($item['required'])){
            $required = "required";
        }
        $disabled = "";
        if(isset($item['disabled']) && $item['disabled'] === true){
            $disabled = "disabled";
        }

        $html = '<input oninput="value=value.replace(/[^-?([1-9]\d*\.\d*|0\.\d*[1-9]\d*|0?\.0+|0)]/g,\'\')" type="number" '.$maxlenth.' '.$disabled.' '.$required.' name="'.$item['field'].'"  value="'.$item['value'].'" placeholder="请输入..." class="layui-input">';
        return $html;

    }
    /**
     * @title 多行文本输入
     * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填']
     * @param $item
     * @return string
     */
    public function textarea($item){
        $maxlenth = "";
        if(isset($item['maxlenth']) && abs($item['maxlenth'])>0){
            $maxlenth = "maxlength='{$item['maxlenth']}'";
        }
        $required = "";
        if(isset($item['required'])){
            $required = "required";
        }
        $disabled = "";
        if(isset($item['disabled']) && $item['disabled'] === true){
            $disabled = "disabled";
        }
        $html ='<textarea '.$maxlenth.' name="'.$item['field'].'" '.$required.' '.$disabled.' class="layui-textarea" placeholder="请输入数据内容">'.$item['value'].'</textarea>';
        return $html;
    }
    /**
     * @title 多行文本输入
     * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填']
     * @param $item
     * @return string
     */
    public function editor($item){
        $value = $item['value']?htmlspecialchars_decode($item['value']):'';
$html = <<<EOT
<textarea data-editor name="{$item['field']}" class="layui-textarea" placeholder="请输入数据内容">{$value}</textarea>

EOT;


        return $html;
    }
    /**
     * @title 单图片上传
     * @param ['type'=>'','label'=>'字段名称','field'=>'字段','value'=>'值','required'=>'是否必填']
     * @return string
     */
    public function img($item){
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

    /**
     * @title 日期选择插件
     * @param $item
     */
    public function date($item){
$html = <<<EOT
<input data-date-input name="{$item['field']}" value="{$item['value']}" placeholder="请选择时间" class="layui-input">
EOT;
        return $html;

    }

    /**
     * @title 日期时间选择插件
     * @param $item
     * @return string
     */
    public function datetime($item){
        $html = <<<EOT
<input data-date-input="datetime" name="{$item['field']}" value="{$item['value']}" placeholder="请选择时间" class="layui-input">
EOT;
        return $html;
    }
    /**
     * @title 时间范围旋转
     * @param $item
     * @return string
     */
    public function dateRange($item){
        $html = <<<EOT
<input data-date-range name="{$item['field']}" value="{$item['value']}" placeholder="请选择时间" class="layui-input">
EOT;
        return $html;
    }
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
    public function linkage2($item){
        $html = '<div class="layui-input-inline">';

        $html .='<select name="'.$item['param'][0]['field'].'" lay-filter="'.$item['param'][0]['field'].'">';
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
        $html .='<select name="'.$item['param'][1]['field'].'" lay-filter="'.$item['param'][1]['field'].'">';
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
    /**
     * @title 三级联动搜索
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
    public function linkage3($item){
        $html = '<div class="layui-input-inline">';

        $html .='<select name="'.$item['param'][0]['field'].'" lay-filter="'.$item['param'][0]['field'].'">';
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
        $html .='<select name="'.$item['param'][1]['field'].'" lay-filter="'.$item['param'][1]['field'].'">';
        $html .='<option value="">请选择</option>';
        $html .='</select>';

        $html .='</div>';

        $html .= '<div class="layui-input-inline">';
        $html .='<select name="'.$item['param'][2]['field'].'" lay-filter="'.$item['param'][2]['field'].'">';
        $html .='<option value="">请选择</option>';
        $html .='</select>';

        $html .='</div>';

        $html .= <<<EOT
<script>
        function ajaxlist{$item['field']}(pid,parent) {
            
             $.form.load('{$item['ajaxurl']}', {pid:pid}, "get", function(ret) {
               var field1 = '{$item['param'][1]['value']}'
               var field2 = '{$item['param'][2]['value']}'
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
                          $('[name="{$item['param'][1]['field']}"]').html(h)
                          if(field_value){
                               ajaxlist{$item['field']}(field_value,2)
                          }  
                     }else{
                         $('[name="{$item['param'][2]['field']}"]').html(h)
                     }
                     layui.form.render('select');
                     return false
             }, null, null, 'false');
        }
        $(function() {
           // 数据状态切换操作
            layui.form.on('select({$item['param'][0]['field']})', function (obj) {
   
                ajaxlist{$item['field']}(obj.value,1)
            
            });
            layui.form.on('select({$item['param'][1]['field']})', function (obj) {
   
                ajaxlist{$item['field']}(obj.value,2)
            
            });
            if($('[name="{$item['param'][0]['field']}"]').val()){
                ajaxlist{$item['field']}($('[name="{$item['param'][0]['field']}"]').val(),1)
            }
            
        })
        
</script>         
EOT;
        return $html;
    }

    /**
     * @title 行input输入
     * @param $item
     * @return string
     */
    public function inlineInput($item){
        $html = '';
        $disabled = "";
        if(isset($item['disabled']) && $item['disabled'] === true){
            $disabled = "disabled";
        }
        $required = "";
        if(isset($item['required'])){
            $required = "required";
        }
        foreach ($item['option'] as $val){
            $html .='<div class="layui-input-inline">';
            $html .=$val['title'];
            $script = "";
            if(isset($val['script'])){
                $script = 'oninput="'.$val['script'].'"';
            }

            $type = 'type="text"';
            if(isset($val['type'])){
                $type = 'type="number"';
            }
            $maxlenth ="";
            if(isset($val['maxlenth']) && abs($val['maxlenth'])>0){
                $maxlenth = "maxlength='{$val['maxlenth']}'";
            }
            $placeholder = "请输入...";
            if(isset($val['placeholder'])){
                $placeholder = $val['placeholder'];
            }
            $html .= '<input '.$script.' '.$type.' '.$maxlenth.' '.$disabled.' '.$required.' name="'.$val['field'].'"  value="'.$val['value'].'" placeholder="'.$placeholder.'" class="layui-input">';
            $html .='</div>';
        }
        return $html;
    }
    public static function template($field = [],$formType=""){

        foreach ($field as &$val){
            if(method_exists((new self),$val['type'])){
                $method = $val['type'];

                $val['view'] = (new self())->$method($val);
            }else{
                $val['view'] = "";
            }

        }
        unset($val);
        if($formType){
            View::assign('formType',$formType);
        }
        View::assign('field',$field);
        return dirname(__FILE__).'/view/form.html';
    }

    /**
     * @title 初始化表单
     * @param $data
     * @return array
     */
    public static function initForm($data,$value=[]):array {
        $resData = [];
        $notSite = ['type','label','field','value','required','class_name'];

        foreach ($data as $val){
            $vars = get_object_vars($val);
            $item = [];
            foreach ($vars as $k=>$v){
                if(in_array($k,$notSite)){
                    $item[$k]=$v;
                }else{
                    if($v) $item[$k]=$v;

                }
            }
            if(!$item['value']){
                if(isset($value[$item['field']])){
                    $item['value'] = $value[$item['field']];
                }
            }
            $resData[]=$item;
        }
        return $resData;
    }


}