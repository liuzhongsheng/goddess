<?php
    $arr = array(
        'statusCode' => 301,
        'message' => '请登录后再操作',
        'url' => 'http://www.baidu.com'
    );

    die(json_encode($arr));