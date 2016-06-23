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
    'DB_HOST'             => '',                                        // 服务器地址
    'DB_NAME'             => '',                                        // 数据库名
    'DB_USER'             => '',                                        // 用户名
    'DB_PWD'              => '',                                        // 密码
    'DB_PORT'             => '',                                        // 端口
    'DB_PREFIX'           => '',                                        // 数据库表前缀
    'BUILD_DIR_SECURE'    => 'true',                                    //是否开启安全文件,每个目录下面创建一个html
    'DIR_SECURE_FILENAME' => 'index.html',                              //安全文件名称,默认index.html
    'DIR_SECURE_CONTENT'  => ' ',
    'DB_CHARSET'          => 'utf8',

);