<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2023/11/17
 * Time: 22:05
 */

namespace iceand;

/**
 * Class FormItem
 * @package iceand
 * * 静态助手调用
 * @method static FormItem hidden(string $field, string $label) 隐藏输入
 * @method static FormItem input(string $field, string $label) 单行输入
 * @method static FormItem password(string $field, string $label) 密码输入
 * @method static FormItem number(string $field, string $label) 数字输入
 * @method static FormItem float(string $field, string $label) 浮点数输入
 * @method static FormItem radio(string $field, string $label) 单选
 * @method static FormItem checkbox(string $field, string $label) 多选
 * @method static FormItem select(string $field, string $label) 下拉选择
 * @method static FormItem textarea(string $field, string $label) 多行输入
 * @method static FormItem img(string $field, string $label) 单图上传
 * @method static FormItem images(string $field, string $label) 多图上传
 * @method static FormItem linkage2(string $field, string $label) 二级联动select
 * @method static FormItem linkage3(string $field, string $label) 三级联动select
 * @method static FormItem editor(string $field, string $label) 富文本编辑器
 * @method static FormItem date(string $field, string $label) 日期选择
 * @method static FormItem datetime(string $field, string $label) 日期时间选择
 * @method static FormItem dateRange(string $field, string $label) 日期范围选择
 * @method static FormItem legend(string $field, string $label) 字块集
 * @method static FormItem Text(string $field, string $label) 显示内容而已
 * @method static FormItem inlineInput(string $field, string $label) 一行多个输入框
 * @method static FormItem txmap(string $field, string $label) 腾讯地图
 * @method static FormItem jsoneditor(string $field, string $label) JSON编辑器
 * @method static FormItem multiline(string $field, string $label) 多行文本输入
 * @method static FormItem auth(string $field, string $label) 门店权限设置
 * @method static FormItem quote(string $field, string $label) 提示字段
 * @method static FormItem file(string $field, string $label) 文件上传
 * @method static FormItem video(string $field, string $label) 视频上传
 * @method static FormItem diy(string $field, string $label) DIY内容
 *
 */
class FormItem
{
    public $name;
    public $title;
    public $type;
    public $label;
    public $field;
    public $value;
    public $required;
    public $help;
    public $option;
    public $maxlenth;
    public $minlenth;
    public $param;
    public $ajaxurl;
    public $legend;
    public $disabled;
    public $class_name="";
    public $hide = false;
    public $script;
    public $multiline;  //多行文本设置
    public $mine = "";

    /**
     * 静态魔术方法
     * @param string $method 方法名称
     * @param array $args 调用参数
     * @return FormItem
     */
    public static function __callStatic($method, $args)
    {
        $self = new FormItem();
        $self->type = $method;
        $self->field = $args[0];
        $self->label = $args[1];

        return $self;
    }

    public function value($v){
        $this->value = $v;return $this;
    }
    public function required(){$this->required = true;return $this;}
    public function option(array $data = []){$this->option = $data;return $this;}
    public function help($help){$this->help = $help;return $this;}
    public function maxlenth($maxlenth){$this->maxlenth = $maxlenth;return $this;}
    public function minlenth($minlenth){$this->minlenth = $minlenth;return $this;}
    public function ajaxUrl($url){$this->ajaxurl = $url;return $this;}
    public function param($val){$this->param = $val;return $this;}
    public function disabled(bool $val){$this->disabled = $val;return $this;}
    public function className(string $val){$this->class_name = $val;return $this;}
    public function hide(bool $val){$this->hide = $val;return $this;}
    public function multilines(array $val){$this->multiline = $val;return $this;}
    public function mine($mine){$this->mine = $mine;return $this;}
    public function script($script){
        $this->script = $script;return $this;
    }
    public function showhide(array $val,$common=''){
        $tyle_field = "";
        switch ($this->type){
            case "radio":
                $tyle_field = "radio({$this->field})";
                break;
            case "select":
                $tyle_field = "select({$this->field})";
                break;
            case "checkbox":
                $tyle_field = "checkbox({$this->field})";
                break;
        }
        $json = json_encode($val,256);
        if($this->type == "radio"){
            $html = <<<EOT
<script>
var json = JSON.parse('{$json}')
form.on('select(filter)', function(data){
  console.log(data.elem); //得到select原始DOM对象
  console.log(data.value); //得到被选中的值
  console.log(data.othis); //得到美化后的DOM对象
});
$('.{$this->field}').on('change',function(){
    var val = $('[name="{$this->field}"]:checked').val()
    console.log("cal",val)
    $('.{$common}').hide()
     var clsn =  json[val]
     if(clsn){
             $('.'+clsn).show()

     }     

})

</script>
EOT;

        }else if($this->type == "select"){
            $html = <<<EOT
<script>
    var json = JSON.parse('{$json}')
    layui.form.on('select({$this->field})', function (obj) {
         console.log("cal",obj.value)
        $('.{$common}').hide()
         var clsn =  json[obj.value]  
         if(clsn){
                
            $('.'+clsn).show()
         }
       
        
    
    });


</script>
EOT;
        }


        $this->script = $html;return $this;
    }

    public function searchHtml(){
        $name = $this->type;
        $name = ucwords($name);

        $className =  "\\iceand\\search\\$name";
        $class = new $className();
        $vars = get_object_vars($this);
        return call_user_func([&$class,"main"],$vars);
    }
}