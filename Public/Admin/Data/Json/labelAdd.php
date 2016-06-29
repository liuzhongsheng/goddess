<?php
    $str = $_GET['str'];
    $arr = array(
        'statusCode' => 200,
        'message' => '添加成功',
        'id' => 188
    );

    die(json_encode($arr));