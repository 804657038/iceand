<?php

namespace iceand\field;
use think\facade\View;

/**
 * 树形搜索
 */
class Tree
{
    public function main($val){

        $currentFilePath = dirname(__FILE__).'/../view/treeinput.html';

        $val['name'] = $val['field'];
        $val['title'] = $val['label'];
        $html = View::fetch($currentFilePath,[
            'item'=>$val,
        ]);
        return $html;
    }
}