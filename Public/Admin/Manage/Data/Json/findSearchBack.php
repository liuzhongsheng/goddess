<?php

    $str = isset($_POST['searchStr']) ? trim($_POST['searchStr']) : '';
    for($i = 0; $i < 8; $i++){
        $res[] = array(
            'id' => $i+1,
            'name' => $str.($i+1)
        );
    }

    $arr = array(
        'statusCode' => 200,
        'message' => '操作成功',
        'res' => $res
    );

    die(json_encode($arr));