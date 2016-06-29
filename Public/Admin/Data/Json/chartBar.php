<?php

$arr['statusCode'] = 200;
$arr['message'] = '操作成功';
$arr['chart'] = array(
    'type' => 'column',
    'width' => 960,
    'height' => 400,
    'options3d' => array(
        'enabled' => true,
        'alpha' => 0,
        'beta' => 0,
        'depth' => 50,
        'viewDistance' => 25
    )
);
$arr['title'] = array(
    'text' => '关注人数柱形图（ajax请求）'
);
$arr['colors'] = array(
    "#88be33"
);
$arr['xAxis'] = array(
    'title' => array(
        'text' => '时间（月份）'
    ),
    'categories' => array(
        '一月份', '二月份', '三月份', '四月份', '五月份','六月份',
        '七月份', '八月份', '九月份', '十月份', '十一月份', '十二月份'
    ),
    'crosshair' => false
);
$arr['yAxis'] = array(
    'title' => array(
        'text' => '访问数（人）'
    )
);
$arr['series'] = array(
    array(
        'name' => '2015年',
        'data' => array(
            49, 71, 106, 129, 144, 176, 135, 148, 216, 194, 95, 54
        )
    )
);

die(json_encode($arr));