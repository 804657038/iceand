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
 */
class Search
{
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
}