<?php
// +----------------------------------------------------------------------
// | 文件说明:
// +----------------------------------------------------------------------
// | Copyright (c) www.php63.cc All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 普罗米修斯 <996674366@qq.com>
// +----------------------------------------------------------------------
namespace Common\Controller;
use Frame\Controller;
class public_controller extends Controller{
    public function index(){
        phpinfo();
    }
}