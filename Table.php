<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2023/11/16
 * Time: 14:03
 */
namespace iceand;

use think\facade\View;

/**
 * Class Table
 * 动态助手调用
 * @method Table width(int $val) 设置宽度
 * @method Table isedit(bool $val) 设置是否允许修改字段
 * @method Table templet(string $name,string $templetType='') 设置是否允许修改字段
 * @method Table isimg(string $name) 设置图片预览
 * @method Table isswitch(string $name) 设置开关
 * @package iceand
 */
class Table
{

    /**
     * @title 魔术方法
     * @param $name
     * @param $arguments
     * @return $this
     */
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        if($name == 'templet'){
            $this->templet = $arguments[0];
            if(isset($arguments[1]))$this->templetType = $arguments[1];

        }elseif($name == "isimg"){


            $this->templet = "'#{$arguments[0]}'";
            $this->templetType = "img";
        }elseif($name == "isswitch"){
            $this->templet = "'#{$arguments[0]}'";
            $this->templetType = "StatusSwitchTpl";
        }else{
            $this->$name = count($arguments) == 1?$arguments[0]:$arguments;
        }

        return $this;
    }

    /**
     * @title 设置字段
     * @param string $field
     * @param string $title
     * @return Table
     */
    public static function field(string $field,string $title){
        $self = new self();
        $self->field = $field;
        $self->title = $title;
        return $self;
    }

    /**
     * @title 设置是否隐藏添加按钮
     * @return $this
     */
    public function hideButtonAdd(){
        View::assign('hideButtonAdd',true);
        return $this;
    }

    /**
     * @title 设置是否隐藏删除按钮
     * @return $this
     */
    public function hideButtonDel(){
        View::assign('hideButtonDel',true);
        return $this;
    }

    /**
     * @title 自定义行按钮
     */
    public function buttonList($data=[]){
        $html = '';
        foreach ($data as $val){
            if(isset($val['html'])){
                $html .= $val['html'];

            }else{
                if(isset($val['open'])){
                    $html .= '<a class="layui-btn layui-btn-primary layui-border-green layui-btn-sm" data-event-dbclick data-title="'.$val['title'].'" data-open="'.$val['url'].'?id={{d.id}}">'.$val['title'].'</a>';
                }else{
                    $html .= '<a class="layui-btn layui-btn-primary layui-border-green layui-btn-sm" data-event-dbclick data-title="'.$val['title'].'" data-modal="'.$val['url'].'?id={{d.id}}">'.$val['title'].'</a>';
                }

            }
        }
        View::assign('button_list',$html);

        return $this;
    }

    /**
     * @title 自定义总按钮,变量是HTML代码
     */
    public function allBtn($tempte){

        View::assign('allBtn',$tempte);
        return $this;

    }
    public function template($formType=""){
        if($formType){
            View::assign('formType',$formType);
        }
        return dirname(__FILE__).'/view/table.html';
    }
    public function search(array $data):Table{
        $arr = [];
        $resData = [];
        foreach ($data as $val){
            $vars = get_object_vars($val);
            $item = [];
            foreach ($vars as $k=>$v){
                if($v) $item[$k]=$v;
            }
            $resData[]=$item;
        }
        View::assign("search",$resData);
        return $this;
    }

    /**
     * @param $data
     * @return Table
     */
    public static function header($data):Table{
        $resData= [];
        foreach ($data as $val){
            $vars = get_object_vars($val);
            $item = [];
            foreach ($vars as $k=>$v){
                $item[$k]=$v;
            }
            $resData[]=$item;
        }
        View::assign('tableHeader',$resData);
        return (new self);
    }
}