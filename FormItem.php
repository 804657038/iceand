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
 * @method static FormItem input(string $field, string $label) 单行输入
 * @method static FormItem number(string $field, string $label) 数字输入
 * @method static FormItem radio(string $field, string $label) 单选
 * @method static FormItem select(string $field, string $label) 下拉选择
 * @method static FormItem textarea(string $field, string $label) 多行输入
 * @method static FormItem img(string $field, string $label) 单图上传
 * @method static FormItem linkage2(string $field, string $label) 二级联动select
 * @method static FormItem editor(string $field, string $label) 富文本编辑器
 * @method static FormItem date(string $field, string $label) 日期选择
 */
class FormItem
{
    public $type;
    public $label;
    public $field;
    public $value;
    public $required;
    public $help;
    public $option;
    public $maxlenth;
    public $param;
    public $ajaxurl;
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

    public function value($v){$this->value = $v;return $this;}
    public function required(){$this->required = true;return $this;}
    public function option(array $data = []){$this->option = $data;return $this;}
    public function help($help){$this->help = $help;return $this;}
    public function maxlenth($maxlenth){$this->maxlenth = $maxlenth;return $this;}
    public function ajaxUrl($url){$this->ajaxurl = $url;return $this;}

    public function param($val){$this->param = $val;return $this;}
}