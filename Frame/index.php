<?php
// +----------------------------------------------------------------------
// | 框架核心入口文件
// +----------------------------------------------------------------------
// | Copyright (c) www.php63.cc All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 普罗米修斯 <996674366@qq.com>
// +----------------------------------------------------------------------
//开启缓存
session_start();

//定义类文件后缀
const  CLASS_SUFFIX = '.class.php';
//检测是否http协议类型
if ($_SERVER['HTTPS'] != 'on') {
    $http_type = 'http';
}else{
    $http_type = 'https';
}
//定义框架目录
defined('SYSTEM_PATH')      or       define('SYSTEM_PATH', __DIR__ . '/');
//定义应用目录
defined('APP_PATH')         or       define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']) . '/');
//定义类库目录
defined('LIB_PATH') or define('LIB_PATH', realpath(SYSTEM_PATH . 'Library') . '/');      //类库目录
//定义系统函数文件
defined('SYSTEM_FUNC') or define('SYSTEM_FUNC', SYSTEM_PATH.'Common/');
//应用公用文件
defined('PUBLIC_FUNC') or define('PUBLIC_FUNC', APP_PATH.'Common/Common/');
//公用模板
defined('PUBLIC_HTML') or define('PUBLIC_HTML', APP_PATH.'Common/View/');

defined('HTTP_TYPE')        or       define('HTTP_TYPE', $http_type);

defined('__ROOT__') or define('__ROOT__', $http_type . '://' . $_SERVER['HTTP_HOST']); // 公共目录


require LIB_PATH . 'Start' . CLASS_SUFFIX;
$obj = new Frame\Start();
$obj -> start();