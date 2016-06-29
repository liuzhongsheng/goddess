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
                            <li class="dib selected"><a href="imageUpload.php">图文上传</a></li>
                            <li class="dib"><a href="imageUploadSwf.php">SWF图片上传</a></li>
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
                        <div class="ui_col_8">
                            <div class="ui_upload_imgitem">
                                <ul>
                                    <li>
                                        <div class="img_wrap">
                                            <input type="hidden" class="js_hidden_file"
                                            name="img[]"
                                            value=""
                                            data-opt='{
                                                fileType: "img",
                                                width: "318",
                                                height: "200",
                                                btnHeight: "35",
                                                name: "图片上传",
                                                title: "缩略图",
                                                thumb: "" }'
                                            />
                                        </div>
                                        <p class="img_desc">
                                            <textarea name="desc[]" placeHolder="请输入图片描述"></textarea>
                                        </p>
                                        <div class="li_tools">
                                            <a href="javascript:void(0);" data-type="up" class="js_imgitem_sort">上移</a>
                                            <a href="javascript:void(0);" data-type="dowm" class="js_imgitem_sort">下移</a>
                                            <a href="javascript:void(0);" class="js_imgitem_del">删除</a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="imgitem_tools">
                                    <a href="javascript:void(0);" data-upload-w="318" data-upload-h="200" class="btn_add js_imgitem_add">添 加</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>