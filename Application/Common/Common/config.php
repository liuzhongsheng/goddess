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
    'DB_HOST'             => '182.92.3.236',                                        // 服务器地址
    'DB_NAME'             => 'mvc',                                        // 数据库名
    'DB_USER'             => 'seal_scms_user',                                        // 用户名
    'DB_PWD'              => '@sealyyg2011#.',                                        // 密码
    'DB_PREFIX'           => 'm_',                                        // 数据库表前缀
    'DEFAULT_PUBLIC'      => array(
        'ADMIN' => __ROOT__ . '/Public/Admin/',
        'HOME'  => __ROOT__ . '/Public/Home/'
    ),
    'PAGENUM'             => 10
);