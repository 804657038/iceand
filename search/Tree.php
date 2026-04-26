<?php

namespace iceand\search;
use think\facade\View;

/**
 * 树形搜索
 */
class Tree
{
    public function main($val){

        $currentFilePath = dirname(__FILE__).'/../view/treeinput.html';

        $html = View::fetch($currentFilePath,[
            'item'=>$val
        ]);
        return $html;
    }
}