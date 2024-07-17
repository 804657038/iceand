<?php
/**
 * Created by PhpStorm.
 * User: huawei
 * Date: 2024/6/24
 * Time: 12:02
 */

namespace iceand\field;


/**
 * 全选设置页面
 * Class Auth
 * @package iceand\field
 */
class Auth
{
    public function main($item){
        $html = <<<EOT
          <ul id="zTree" class="ztree notselect"></ul>
EOT;
        \think\facade\View::assign('is_ztree',1);
        return $html;

    }
}