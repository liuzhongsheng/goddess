<?php
    $str = $_GET['str'];
    $arr = array(
        'statusCode' => 200,
        'message' => '操作成功',
        'tid' => 36
    );

    die(json_encode($arr));