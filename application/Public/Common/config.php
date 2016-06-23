<?php
// +----------------------------------------------------------------------
// | 框架核心配置文件
// +----------------------------------------------------------------------
// | Copyright (c) www.php63.cc All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 普罗米修斯 <996674366@qq.com>
// +----------------------------------------------------------------------

return array(
    'WEB_DOMAIN'          => 'http://' . $_SERVER['HTTP_HOST'],         // 默认路径
    'DEFAULT_MODUlE'      => 'Home',                                    // 默认模块
    'DEFAULT_CONTROLLER'  => 'index',                                   // 默认控制器
    'DEFAULT_ARTICLE'     => 'index',                                   // 默认方法
    'DB_TYPE'             => 'pdo',                                     // 数据库类型
    'DB_HOST'             => 'localhost',                                        // 服务器地址
    'DB_NAME'             => 'mvc',                                        // 数据库名
    'DB_USER'             => 'root',                                        // 用户名
    'DB_PWD'              => 'qwertyuiop',                                        // 密码
    'DB_PREFIX'           => 'a_',                                        // 数据库表前缀

);