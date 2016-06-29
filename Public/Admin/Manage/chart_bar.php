<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php include './Public/top.php'; ?>
    <title>图表管理</title>
</head>
<body>
    <!-- 头部 -->
    <?php include './Public/header.php' ?>

    <div class="body">
        <div class="inner clearfix">
            <div class="col_side">
                <?php
                    define("SELECT_MENU", "chart_bar");
                ?>
                <!-- 左侧菜单栏 -->
                <?php include './Public/leftMenu.php' ?>
            </div>
            <div class="col_main">
                <div class="main_hd">
                    <h2>图表管理</h2>
                    <div class="title_tab">
                        <ul class="tab_ul dib-wrap">
                            <li class="dib selected"><a href="chart_bar.php">柱形图</a></li>
                            <li class="dib"><a href="chart_line.php">曲线图</a></li>
                            <li class="dib"><a href="chart_pie.php">饼状图</a></li>
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
                            <label class="ui_label">页面直接渲染</label>
                            <div id="chartBarView1"></div>
                            <script type="text/javascript">
                                var chartJson = {
                                    chart: {
                                        type: 'column',
                                        width: 960,
                                        height: 400
                                    },
                                    title: {
                                        text: '关注人数柱形图'
                                    },
                                    colors: [
                                        '#5877ec', '#4d8fd9', '#8d4bd0', '#c63e81'
                                    ],
                                    xAxis: {
                                        title: {
                                            text: '时间（月份）'
                                        },
                                        categories: [
                                            '一月份', '二月份', '三月份', '四月份', '五月份',
                                            '六月份', '七月份', '八月份', '九月份', '十月份',
                                            '十一月份', '十二月份'
                                        ],
                                        crosshair: true
                                    },
                                    yAxis: {
                                        title: {
                                            text: '访问数（人）'
                                        }
                                    },
                                    series: [{
                                        name: '2013年',
                                        data: [49, 71, 106, 129, 144, 176, 135, 148, 216, 194, 95, 54]
                                    }, {
                                        name: '2014年',
                                        data: [83, 78, 98, 93, 106, 84, 105, 104, 91, 83, 106, 92]
                                    }, {
                                        name: '2015年',
                                        data: [48, 38, 139, 241, 47, 148, 259, 59, 52, 165, 59, 51]
                                    }, {
                                        name: '2016年',
                                        data: [142, 133, 74, 109, 92, 75, 57, 60, 47, 139, 46, 151]
                                    }]
                                }

                                Manage.chartBar(chartJson, 'chartBarView1');
                            </script>
                        </div>
                        <div class="ui_col_24">
                            <label class="ui_label">ajax请求获取</label>
                            <a href="javascript:void(0);" class="ui_button r3" target="ajaxTodo" data-opt='{
                                url: "Data/Json/chartBar.php",
                                param: "",
                                callback: "chartBarSuccess"
                            }'>获取柱形图数据</a>
                            <div id="chartBarView2"></div>
                            <script type="text/javascript">
                                function chartBarSuccess(json){
                                    Manage.chartBar(json, 'chartBarView2');
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>