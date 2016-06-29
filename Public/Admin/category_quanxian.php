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
                    define("SELECT_MENU", "category");
                ?>
                <!-- 左侧菜单栏 -->
                <?php include './Public/leftMenu.php' ?>
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
        var zNodes =[
            { id:0, pid:null, title:"思励格分类管理", isParent:true, open:true},

            { id:1, pid:0, title:"案例", open:true},
            { id:11, pid:1, title:"精选案例", type: "1", cid: "2", name: "anli", condition: ""},
            { id:12, pid:1, title:"移动应用", type: "2", cid: "2", name: "yingyong", condition: ""},
            { id:13, pid:1, title:"网站界面", type: "2", cid: "1", name: "jiemian", condition: ""},
            { id:14, pid:1, title:"标志图标", type: "1", cid: "2", name: "tubiao", condition: ""},

            { id:2, pid:0, title:"文章", open:true},
            { id:21, pid:2, title:"荣誉奖项", type: "1", cid: "2", name: "jiangxiang", condition: ""},
            { id:22, pid:2, title:"最新动态", type: "2", cid: "1", name: "dongtai", condition: ""},
            { id:23, pid:2, title:"加入我们", type: "2", cid: "1", name: "women", condition: ""}
        ];

        var clickTime = null, currentCategory = null;
        function ztreeOnClick(event, treeId, treeNode){
            if (clickTime) {
                clearTimeout(clickTime);
                clickTime = null;
            } else {
                clickTime = setTimeout(function() {
                    currentCategory = treeNode;
                    var url = "Data/Html/categoryInfo.htm";
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