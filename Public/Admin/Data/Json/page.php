<?php
    $arr = array(
        'statusCode' => 200,
        'message' => '操作成功',
        'currentPage' => 2,
        'totalPage' => 20,
        'showPageNum' => 10,
        'pageNum' => 10,
        'pageUrl' => 'Data/Json/page.php',
        'toolsOption' => array(
            array(
                'name' => '编辑',
                'opt' => array(
                    'url' => "http://www.baidu.com/id/##id##/sid/##sid##"
                )
            ),
            array(
                'name' => '审核',
                'target' => 'ajaxTodo',
                'opt' => array(
                    'title' => '审核文章',
                    'msg' => '确定要让##title##通过审核吗？',
                    'url' => 'Data/Json/Success.php/id/##id##'
                )
            ),
            array(
                'name' => '删除',
                'target' => 'ajaxDel',
                'opt' => array(
                    'title' => '删除文章',
                    'msg' => '确定要删除##title##吗？',
                    'url' => 'Data/Json/Success.php/id/##id##'
                )
            )
        ),
        'thead' => array(
            array(
                'name' => '缩略图',
                'width' => '100',
                'field' => 'img',
                'type' => 'IMG'
            ),
            array(
                'name' => '标题',
                'field' => 'title',
                'order' => 'desc'
            ),
            array(
                'name' => '所属分类',
                'width' => '120',
                'field' => 'catory',
                'order' => 'desc'
            ),
            array(
                'name' => '时间',
                'width' => '100',
                'field' => 'time',
                'order' => 'desc'
            ),
            array(
                'name' => '操作',
                'width' => '40',
                'field' => '__TOOLS',
                'type' => 'TOOLS'
            )
        ),
        'tbody' => array(
            array(
                'id' => '01',
                'sid' => '001',
                'img' => 'Data/Images/article_img_1.jpg',
                'title' => '荣获年度中国十佳网页(互动)设计师称号',
                'catory' => '最新动态',
                'time' => '2011-07-08'
            ),
            array(
                'id' => '02',
                'sid' => '002',
                'img' => 'Data/Images/article_img_2.jpg',
                'title' => '寰球汽车传媒集团官方移动应用Quick Car',
                'catory' => '最新动态',
                'time' => '2011-07-08'
            ),
            array(
                'id' => '03',
                'sid' => '003',
                'img' => 'Data/Images/article_img_3.jpg',
                'title' => '双晖传媒创意总监王子年接受UIRSS专访',
                'catory' => '加入我们',
                'time' => '2011-07-08'
            ),
            array(
                'id' => '04',
                'sid' => '004',
                'img' => 'Data/Images/article_img_4.jpg',
                'title' => '精品传媒集团《世界》杂志官方APP',
                'catory' => '加入我们',
                'time' => '2011-07-08'
            ),
            array(
                'id' => '05',
                'sid' => '005',
                'img' => 'Data/Images/article_img_5.jpg',
                'title' => '双晖传媒合作法国雷诺推出新纬度APP体验版',
                'catory' => '荣誉奖项',
                'time' => '2011-07-08'
            ),
            array(
                'id' => '06',
                'sid' => '006',
                'img' => 'Data/Images/article_img_6.jpg',
                'title' => 'China Daily News中国日报新闻APP',
                'catory' => '荣誉奖项',
                'time' => '2011-07-08'
            ),
            array(
                'id' => '07',
                'sid' => '007',
                'img' => 'Data/Images/article_img_7.jpg',
                'title' => '双晖传媒创意总监王子年接受UIRSS专访',
                'catory' => '最新动态',
                'time' => '2011-07-08'
            ),
            array(
                'id' => '08',
                'sid' => '008',
                'img' => 'Data/Images/article_img_8.jpg',
                'title' => '双晖传媒受邀国际权威在线创意杂志NWP专访',
                'catory' => '加入我们',
                'time' => '2011-07-08'
            )
        )
    );

    die(json_encode($arr));