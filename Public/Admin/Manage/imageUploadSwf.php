<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php include './Public/top.php'; ?>
    <title>图片上传管理</title>
</head>
<body>
    <!-- 头部 -->
    <?php include './Public/header.php' ?>

    <div class="body">
        <div class="inner clearfix">
            <div class="col_side">
                <?php
                    define("SELECT_MENU", "imageUpload");
                ?>
                <!-- 左侧菜单栏 -->
                <?php include './Public/leftMenu.php' ?>
            </div>
            <div class="col_main">
                <div class="main_hd">
                    <h2>图片上传管理</h2>
                    <div class="title_tab">
                        <ul class="tab_ul dib-wrap">
                            <li class="dib"><a href="imageUpload.php">图文上传</a></li>
                            <li class="dib selected"><a href="imageUploadSwf.php">SWF图片上传</a></li>
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
                            <label class="ui_label">图片上传</label>
                            <input data-opt='{
                            fileType: "img",
                            width: "200,500",
                            height: "140,400",
                            name: "封面图上传",
                            title: "缩略图",
                            thumb: ""}' type="hidden" class="js_hidden_file" name="fileName" value="" />
                        </div>
                        <div class="ui_col_24">
                            <label class="ui_label">文件上传</label>
                            <input data-opt='{
                            fileType: "file",
                            width: "500",
                            height: "30",
                            name: "文件上传",
                            thumb: ""}' type="hidden" class="js_hidden_file" name="fileName2" value="" />
                        </div>
                        <div class="ui_col_24">
                            <label class="ui_label">组图上传</label>
                            <div class="js_hidden_group" data-opt='{
                                width: "100,400",
                                height: "100,400",
                                name: "点击上传",
                                inputName: "img"
                            }'>
                                <input data-opt="{
                                    thumb:'../../plugin/swfupload/file/1429174691_7335.jpg',
                                    img:'../../plugin/swfupload/file/1429174691_7335.jpg'
                                }" type="hidden" value="" />
                                <input data-opt="{
                                    thumb:'../../plugin/swfupload/file/1429174691_6042.jpg',
                                    img:'../../plugin/swfupload/file/1429174691_6042.jpg'
                                }" type="hidden" value="" />
                                <input data-opt="{
                                    thumb:'../../plugin/swfupload/file/1429174691_6172.jpg',
                                    img:'../../plugin/swfupload/file/1429174691_6172.jpg'
                                }" type="hidden" value="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>