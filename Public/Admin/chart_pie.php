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
                            <li class="dib"><a href="chart_bar.php">柱形图</a></li>
                            <li class="dib"><a href="chart_line.php">曲线图</a></li>
                            <li class="dib selected"><a href="chart_pie.php">饼状图</a></li>
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
                        <div class="ui_col_12">
                            <label class="ui_label">页面直接渲染效果1</label>
                            <div id="chartPieView1"></div>
                            <script type="text/javascript">
                                var chartJson1 = {
                                    chart: {
                                        type: 'pie',
                                        width: 480,
                                        height: 400
                                    },
                                    title: {
                                        text: '关注人数饼状图效果一'
                                    },
                                    colors: [
                                        '#5877ec', '#4d8fd9', '#8d4bd0', '#c63e81', '#f00'
                                    ],
                                    series: [{
                                        name: '访问数统计',
                                        data: [{
                                            name: '2012年访问数',
                                            y: 13.2
                                        },{
                                            name: '2013年访问数',
                                            y: 32.8
                                        },{
                                            name: '2014年访问数',
                                            y: 26.5
                                        },{
                                            name: '2015年访问数',
                                            y: 16.7
                                        },{
                                            name: '2016年访问数',
                                            y: 10.8
                                        }]
                                    }]
                                }

                                Manage.chartPie(chartJson1, 'chartPieView1');
                            </script>
                        </div>
                        <div class="ui_col_12">
                            <label class="ui_label">页面直接渲染效果2</label>
                            <div id="chartPieView2"></div>
                            <script type="text/javascript">
                                var chartJson2 = {
                                    chart: {
                                        type: 'pie',
                                        width: 480,
                                        height: 400,
                                        options3d: {
                                            enabled: true,
                                            alpha: 50,
                                            beta: 0
                                        }
                                    },
                                    title: {
                                        text: '关注人数饼状图效果二'
                                    },
                                    colors: [
                                        '#5877ec', '#4d8fd9', '#8d4bd0', '#c63e81', '#f00'
                                    ],
                                    plotOptions: {
                                        pie: {
                                            showInLegend: true,
                                            depth: 35
                                        }
                                    },
                                    series: [{
                                        name: '访问数统计',
                                        data: [{
                                            name: '2012年访问数',
                                            y: 13.2
                                        },{
                                            name: '2013年访问数',
                                            y: 32.8
                                        },{
                                            name: '2014年访问数',
                                            y: 26.5
                                        },{
                                            name: '2015年访问数',
                                            y: 16.7
                                        },{
                                            name: '2016年访问数',
                                            y: 10.8
                                        }]
                                    }]
                                }

                                Manage.chartPie(chartJson2, 'chartPieView2');
                            </script>
                        </div>
                        <div class="ui_col_24">
                            <label class="ui_label">ajax请求获取</label>
                            <a href="javascript:void(0);" class="ui_button r3" target="ajaxTodo" data-opt='{
                                url: "Data/Json/chartPie.php",
                                param: "",
                                callback: "chartPieSuccess"
                            }'>获取曲线图数据</a>
                            <div id="chartLineView3"></div>
                            <script type="text/javascript">
                                function chartPieSuccess(json){
                                    Manage.chartPie(json, 'chartLineView3');
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