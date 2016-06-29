<?php
// +----------------------------------------------------------------------
// | 基于缺少对象开发的一款MVC系统
// +----------------------------------------------------------------------
// | Copyright (c) www.php63.cc All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 普罗米修斯 <996674366@qq.com>
// +----------------------------------------------------------------------
header("Content-type:text/html;charset=utf-8");
// ini_set("display_errors", "On");
// error_reporting(E_ALL | E_STRICT);
// ob_start();
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('php版本必须大于5.3.0 !');
//定义应用目录
defined('APP_PATH') OR define('APP_PATH','./Application/');
//框架入口文件
require_once './Frame/index.php';