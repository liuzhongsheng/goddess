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
            <?php include PUBLIC_HTML.'Public/main_head.php';?>
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