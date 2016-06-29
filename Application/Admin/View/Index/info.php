<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php include PUBLIC_HTML.'Public/base.php'; ?>
    <title>平台介绍</title>
</head>
<body>
    <!-- 头部 -->
    <?php include PUBLIC_HTML.'Public/header.php'; ?>

    <div class="body">
        <div class="inner clearfix">
            <div class="col_side">
                <?php
                    define("SELECT_MENU", "main");
                ?>
                <!-- 左侧菜单栏 -->
                <?php include PUBLIC_HTML.'Public/leftMenu.php'; ?>
            </div>
            <div class="col_main">
                <div class="main_hd">
                    <h2>平台管理</h2>
                    <div class="title_tab">
                        <ul class="tab_ul dib-wrap">
                            <li class="dib selected"><a href="main.php">平台信息</a></li>
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
                    <div class="system_info">
                        <h2>内容管理</h2>
                        <div class="ui_col_24">
                            <a href="#">
                                <i class="icon_user"></i>
                                <span>用户信息</span>
                            </a>
                            <a href="#">
                                <i class="icon_slide_show"></i>
                                <span>首页幻灯片</span>
                            </a>
                            <a href="#">
                                <i class="icon_category"></i>
                                <span>分类管理</span>
                            </a>
                            <a href="#">
                                <i class="icon_case"></i>
                                <span>案例管理</span>
                            </a>
                            <a href="#">
                                <i class="icon_article"></i>
                                <span>文章管理</span>
                            </a>
                            <a href="#">
                                <i class="icon_youqing"></i>
                                <span>友情管理</span>
                            </a>
                            <a href="#">
                                <i class="icon_message"></i>
                                <span>留言管理</span>
                            </a>
                        </div>
                        <h2>站点管理</h2>
                        <div class="ui_col_24">
                            <a href="#">
                                <i class="icon_site"></i>
                                <span>站点配置</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>