<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/6/2
 * Time: 17:23
 */

namespace iceand;


class Tab
{
    /**
     * 创建tab
     * @param string $field
     * @param string $title
     * @param array $data
     */
    static public function create(string $field,string $title,array $data = []){
        return [
            'field'=>$field,
            'title'=>$title,
            'lists'=>$data
        ];
    }
}