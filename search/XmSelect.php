<?php

namespace iceand\search;
use think\facade\View;

/**
 * 下拉多选
 */
class XmSelect
{
    public function main($val){

        $currentFilePath = dirname(__FILE__).'/../view/xmSelect.html';

        $html = View::fetch($currentFilePath,[
            'item'=>$val
        ]);
        return $html;
    }
}