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


    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        if($name=="float"){
            $name = "floating";
        }
        $name = ucwords($name);

        $className =  "\\iceand\\field\\$name";
        $class = new $className();
        return call_user_func([&$class,"main"],$arguments[0]);
    }
    public function addBtnTitle($name){
    }
    public static function template($field = [],$formType="",$value=[]){
        if(!is_array($field[0])){
            $field = self::initForm($field,$value);
        }
        foreach ($field as &$val){
            $method = $val['type'];

            $val['view'] = (new self())->$method($val);

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