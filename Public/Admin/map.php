<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php include './Public/top.php'; ?>
    <title>地图管理</title>

    <!-- 地图api -->
    <script src="http://api.map.baidu.com/api?v=2.0&ak=9aedeed92ae13d1cddf4b6ee9265a536"></script>
    <script src="./Js/Plugin/gps.js"></script>
    <script src="./Js/Plugin/jquery.map.js"></script>
</head>
<body>
    <!-- 头部 -->
    <?php include './Public/header.php' ?>

    <div class="body">
        <div class="inner clearfix">
            <div class="col_side">
                <?php
                    define("SELECT_MENU", "map");
                ?>
                <!-- 左侧菜单栏 -->
                <?php include './Public/leftMenu.php' ?>
            </div>
            <div class="col_main">
                <div class="main_hd">
                    <h2>地图管理</h2>
                    <div class="title_tab">
                        <ul class="tab_ul dib-wrap">
                            <li class="dib selected"><a href="map.php">百度地图</a></li>
                        </ul>
                        <div class="tab_navs">
                            <div class="search_box">
                                <form action="" method="post">
                                    <input type="text" name="searchText" />
                                    <button type="submit" class="btn_search_submit"></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main_bd">
                    <div class="main_bd_inner clearfix">
                        <div class="ui_col_24">
                            <label class="ui_label">百度地图获取经纬度</label>
                            <div class="js_map_warp" data-opt='{
                                type: "",
                                lng: "116.403891",
                                lat: "39.915129",
                                width: "800",
                                height: "400",
                                lookupGroup: "mapInput"
                            }'></div>
                        </div>
                        <div class="ui_col_24">
                            <label class="ui_label">弹出框获取百度地图经纬度</label>
                            <div class="js_map_warp" data-opt='{
                                type: "dialog",
                                lng: "116.403891",
                                lat: "39.915129",
                                width: "600",
                                height: "300",
                                lookupGroup: "mapDialogInput"
                            }'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>