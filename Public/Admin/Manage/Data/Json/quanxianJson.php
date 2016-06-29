<?php

$arr['res'] = array(
    array('id' => 0, 'pid' => null, 'name' => '权限管理', 'isParent' => true),
    array('id' => 1, 'pid' => 0, 'name' => '案例'),
    array('id' => 11, 'pid' => 1, 'name' => '精选案例'),
    array('id' => 12, 'pid' => 1, 'name' => '移动应用'),
    array('id' => 13, 'pid' => 1, 'name' => '网站界面'),
    array('id' => 14, 'pid' => 1, 'name' => '标志图标'),

    array('id' => 2, 'pid' => 0, 'name' => '文章'),
    array('id' => 21, 'pid' => 2, 'name' => '荣誉奖项'),
    array('id' => 22, 'pid' => 2, 'name' => '最新动态'),
    array('id' => 23, 'pid' => 2, 'name' => '加入我们'),

    array('id' => 3, 'pid' => 0, 'name' => '文章'),
    array('id' => 31, 'pid' => 3, 'name' => '荣誉奖项'),
    array('id' => 32, 'pid' => 3, 'name' => '最新动态'),
    array('id' => 33, 'pid' => 3, 'name' => '加入我们'),

    array('id' => 4, 'pid' => 0, 'name' => '案例'),
    array('id' => 41, 'pid' => 4, 'name' => '精选案例'),
    array('id' => 42, 'pid' => 4, 'name' => '移动应用'),
    array('id' => 43, 'pid' => 4, 'name' => '网站界面'),
    array('id' => 44, 'pid' => 4, 'name' => '标志图标')
);
$arr['statusCode'] = 200;

echo json_encode($arr);