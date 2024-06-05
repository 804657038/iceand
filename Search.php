<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2023/11/18
 * Time: 9:40
 */

namespace iceand;

/**
 * 初始化搜索组件
 * Class Search
 * @package iceand
 * 静态调用助手
 * @method static Search select(string $name,string $title)  下拉搜索
 * @method static Search input(string $name,string $title)  输入搜索
 * @method static Search dateRang(string $name,string $title)  时间范围搜素
 * @method static Search linkage3(string $name,string $title)  时间范围搜素
 * @method static Search condition(string $name,string $title)  条件搜素
 */
class Search
{
    public $ajaxurl;
    public $param;
    private $_dynamicProperty = array();
    public function __get($name) {
        //判断是否存在该属性对应键名
        if (array_key_exists($name, $this->_dynamicProperty)) {
            return $this->_dynamicProperty[$name];
        }
        return NULL;
    }

    //写入数组，属性名即为数组键名
    public function __set($name, $value) {
        //将原本的属性名写入数组键名，调用的时候利用__get()方法直接去数组里获取
        $this->_dynamicProperty[$name] = $value;
    }

    //属性都存储在_dynamicProperty中，那么各应用模块中如果要用到isset时就需要调用本魔术方法
    //否则类似isset($obj->num)的操作去判断属性是否存在将会失败
    public function __isset($name) {
        return isset($this->_dynamicProperty[$name]);
    }
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
        $self->name = $args[0];
        $self->title = $args[1];
        return $self;
    }
    public function option($option){
        $this->option = $option;
        return $this;
    }
    public function ajaxUrl($url){
        $this->ajaxurl = $url;
        return $this;
    }
    public function param($val){$this->param = $val;return $this;}


}