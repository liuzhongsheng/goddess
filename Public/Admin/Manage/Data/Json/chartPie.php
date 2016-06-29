<?php

$arr['statusCode'] = 200;
$arr['message'] = '操作成功';
$arr['chart'] = array(
    'type' => 'pie',
    'width' => 960,
    'height' => 400,
    'options3d' => array(
        'enabled' => true,
        'alpha' => 50
    )
);
$arr['title'] = array(
    'text' => '关注人数饼状图（ajax请求）'
);
$arr['colors'] = array(
    '#5877ec', '#4d8fd9', '#8d4bd0', '#c63e81', '#f00'
);
$arr['plotOptions'] = array(
    'pie' => array(
        'innerSize' => 100,
        'depth' => 40
    )
);
$arr['series'] = array(
    array(
        'name' => '访问数统计',
        'data' => array(
            array(
                'name' => '2012年访问数',
                'y' => 13.2
            ),
            array(
                'name' => '2013年访问数',
                'y' => 32.8
            ),
            array(
                'name' => '2014年访问数',
                'y' => 26.5
            ),
            array(
                'name' => '2015年访问数',
                'y' => 16.7
            ),
            array(
                'name' => '2016年访问数',
                'y' => 10.8
            )
        )
    )
);

die(json_encode($arr));