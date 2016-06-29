<?php

    $str = isset($_GET['str']) ? trim($_GET['str']) : '';
    for($i = 0; $i < 8; $i++){
        $res[] = array(
            'id' => $i+1,
            'name' => '名称'.($i+1),
            'desc' => $i.$str.'--可是，在通州建设北京市行政副中心，早已是外界传言多时，并由媒体正式确认的消息。11月23日的人民日报头版头条也已报道“通州土地拆迁、腾退完成，86个重大基础设施项目实现开工29个，按照计划预计2017年取得明显成效。”北京市属各单位对搬迁之事早已心中有数。',
            'headimg' => './Data/Images/user_headimg_'.($i%5+1).'.jpg'
        );
    }

    $arr = array(
        'statusCode' => 200,
        'message' => '操作成功',
        'res' => $res
    );

    die(json_encode($arr));