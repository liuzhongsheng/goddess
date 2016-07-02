<html lang="zh-cn">
<head>
    <?php include PUBLIC_HTML.'Public/base.php'; ?>
    <title>权限管理</title>
</head>
<body>
<!-- 头部 -->
<?php include PUBLIC_HTML.'Public/header.php'; ?>

<div class="body">
    <div class="inner clearfix">
        <div class="col_side">
            <?php
            define("SELECT_MENU", "category");
            ?>
            <!-- 左侧菜单栏 -->
            <?php include PUBLIC_HTML.'Public/leftMenu.php'; ?>
        </div>
        <div class="col_main">
            <div class="main_hd">
                <h2>文章管理</h2>
                <div class="title_tab">
                    <ul class="tab_ul dib-wrap">
                        <li class="dib"><a href="category.php">普通分类</a></li>
                        <li class="dib selected"><a href="category_quanxian.php">权限分类（ajax请求）</a></li>
                        <li class="dib"><a href="category_weixin.php">微信菜单</a></li>
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
                <div class="category_wrap clearfix">
                    <div class="category_left">
                        <h2 class="border_r">权限分类</h2>
                        <ul id="categoryTree" class="ztree"></ul>
                    </div>
                    <div class="category_right">
                        <h2>分组操作</h2>
                        <div id="categoryInfo" class="category_main">
                            <p class="category_tips">请选择左侧分类在进行相关操作</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var setting = {
        data: {
            simpleData: {
                enable: true,
                idKey : 'id',
                pIdKey : 'pid'
            },
            key:{
                name : 'title'
            }
        },
        callback:{
            onDblClick: ztreeOnDbClick,
            onClick: ztreeOnClick
        }
    };
    var zNodes =<?php echo $list;?>;

    var clickTime = null, currentCategory = null;
    function ztreeOnClick(event, treeId, treeNode){
        if (clickTime) {
            clearTimeout(clickTime);
            clickTime = null;
        } else {
            clickTime = setTimeout(function() {
                currentCategory = treeNode;
                var url = "<?php echo Url('rules_info');?>";
                var data = {
                    id: treeNode.id,
                    cid: treeNode.cid,
                    tid: treeNode.tid
                }

                Juuz.ajaxHtml(url, data, 'html', function(html){
                    $('#categoryInfo').html(html);
                    Manage.uiInit('#categoryInfo');
                }, Juuz.noop);

                clickTime = null;
            }, 250);
        }
    }

    function ztreeOnDbClick(event, treeId, treeNode){
        clickTime = null;
    }

    $(function(){
        $.fn.zTree.init($("#categoryTree"), setting, zNodes);
    })
</script>
</body>
</html>