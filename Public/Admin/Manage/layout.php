<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php include './Public/top.php'; ?>
    <title>页面布局</title>
</head>
<body>
    <!-- 头部 -->
    <?php include './Public/header.php' ?>

    <div class="body">
        <div class="inner clearfix">
            <div class="col_side">
                <?php
                    define("SELECT_MENU", "layout");
                ?>
                <!-- 左侧菜单栏 -->
                <?php include './Public/leftMenu.php' ?>
            </div>
            <div class="col_main">
                <div class="main_hd">
                    <h2>页面布局</h2>
                    <div class="title_tab">
                        <ul class="tab_ul dib-wrap">
                            <li class="dib selected"><a href="layout.php">页面栅格布局</a></li>
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
                            <p style="height:100px;background:#f9c39f;text-align:center;">n=24</p>
                        </div>

                        <div class="ui_col_4">
                            <p style="height:100px;background:#9fd0f9;text-align:center;border-right:1px solid #fff;">n=4</p>
                        </div>
                        <div class="ui_col_11">
                            <p style="height:100px;background:#9fd0f9;text-align:center;border-right:1px solid #fff;">n=11</p>
                        </div>
                        <div class="ui_col_9">
                            <p style="height:100px;background:#9fd0f9;text-align:center;">n=9</p>
                        </div>

                        <div class="ui_col_5">
                            <p style="height:100px;background:#fbddfb;text-align:center;border-right:1px solid #fff;">n=5</p>
                        </div>
                        <div class="ui_col_19">
                            <p style="height:100px;background:#fbddfb;text-align:center;">n=19</p>
                        </div>

                        <div class="ui_col_5">
                            <p style="height:100px;background:#96ccf5;text-align:center;border-right:1px solid #fff;">n=5</p>
                        </div>
                        <div class="ui_col_12">
                            <p style="height:100px;background:#96ccf5;text-align:center;border-right:1px solid #fff;">n=12</p>
                        </div>
                        <div class="ui_col_7">
                            <p style="height:100px;background:#96ccf5;text-align:center;">n=7</p>
                        </div>

                        <div class="ui_col_8">
                            <p style="height:100px;background:#8fba88;text-align:center;border-right:1px solid #fff;">n=8</p>
                        </div>
                        <div class="ui_col_8">
                            <p style="height:100px;background:#8fba88;text-align:center;border-right:1px solid #fff;">n=8</p>
                        </div>
                        <div class="ui_col_8">
                            <p style="height:100px;background:#8fba88;text-align:center;">n=8</p>
                        </div>

                        <div class="ui_col_2">
                            <p style="height:100px;background:#dfd4a1;text-align:center;border-right:1px solid #fff;">n=2</p>
                        </div>
                        <div class="ui_col_5">
                            <p style="height:100px;background:#dfd4a1;text-align:center;border-right:1px solid #fff;">n=5</p>
                        </div>
                        <div class="ui_col_5">
                            <p style="height:100px;background:#dfd4a1;text-align:center;border-right:1px solid #fff;">n=5</p>
                        </div>
                        <div class="ui_col_12">
                            <p style="height:100px;background:#dfd4a1;text-align:center;">n=12</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>