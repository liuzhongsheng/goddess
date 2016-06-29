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
                            <li class="dib selected"><a href="category.php">普通分类</a></li>
                            <li class="dib"><a href="category_quanxian.php">权限分类（ajax请求）</a></li>
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
                            <h2 class="border_r">分类</h2>
                            <ul id="categoryTree" class="ztree"></ul>
                        </div>
                        <div class="category_right">
                            <h2>分类操作</h2>
                            <div class="category_main">
                                <p class="category_tips">请选择左侧分类在进行相关操作</p>
                                <div class="category_info">
                                    <ul class="category_tools dib-wrap">
                                        <li class="dib">
                                            <a id="categoryBtAdd" href="javascript:void(0);" target="popDialog" data-opt="{
                                                title: '添加子分类',
                                                url: 'Data/Html/categoryAdd.htm',
                                                dataType: 'html'
                                            }">添 加</a>
                                        </li>
                                        <li class="dib">
                                            <a id="categoryBtDel" href="javascript:void(0);" target="ajaxDel" data-opt="{
                                                title: '删除分类',
                                                msg: '是否删除该分类？',
                                                url: 'Data/Json/Success.php'
                                            }">删 除</a>
                                        </li>
                                    </ul>
                                    <form action="" method="post" class="clearfix" onsubmit="return Juuz.ajaxForm(this)">
                                        <div class="ui_col_10">
                                            <label class="ui_label">分类编号 : </label>
                                            <input id="categoryId" class="ui_text_input" readonly="readonly" type="text" name="id" />
                                        </div>
                                        <div class="ui_col_10">
                                            <label class="ui_label">分类名称 : </label>
                                            <input id="categoryName" class="ui_text_input" type="text" name="name" data-opt='{
                                                type : "require",
                                                msg : "分类名称不能为空"
                                            }' />
                                        </div>
                                        <div class="ui_col_10">
                                            <label class="ui_label">分类序号 : </label>
                                            <input id="categorySort" class="ui_text_input" type="text" name="sort" />
                                            <label class="ui_label">（序号越大，分类越靠前，默认序号 99）</label>
                                        </div>
                                        <div class="ui_col_10 mt20">
                                            <button type="submit" id="categoryBtSave" class="ui_button medium r3">保 存</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var deleteUrl = '{:U("delete", array("id"=>"000000"))}';
        var setting = {
            data: {
                simpleData: {
                    enable: true,
                    pIdKey : 'pid'
                },
                key : {
                    name : 'name'
                }
            },
            callback:{
                onDblClick: ztreeOnDbClick,
                onClick: ztreeOnClick
            }
        };
        var zNodes =[
            { id:0, pid:null, name:"思励格分类管理", isParent:true, open:true},

            { id:1, pid:0, name:"案例", open:true},
            { id:11, pid:1, name:"精选案例"},
            { id:12, pid:1, name:"移动应用"},
            { id:13, pid:1, name:"网站界面"},
            { id:14, pid:1, name:"标志图标"},

            { id:2, pid:0, name:"文章", open:true},
            { id:21, pid:2, name:"荣誉奖项"},
            { id:22, pid:2, name:"最新动态"},
            { id:23, pid:2, name:"加入我们"}
        ];

        var clickTime = null;
        var currentCategory = null;
        function ztreeOnClick(event, treeId, treeNode){
            if(treeNode.id == 0){
                $('#categoryBtSave').hide();
                $('#categoryBtDel').hide();
            }else{
                $('#categoryBtSave').show();
                $('#categoryBtDel').show();
            }

            if (clickTime) {
                clearTimeout(clickTime);
                clickTime = null;
            } else {
                clickTime = setTimeout(function() {
                    $('#categoryId').val(treeNode.id);
                    $('#categoryName').val(treeNode.name);
                    $('#categorySort').val(treeNode.sort);

                    var delUrl = deleteUrl.replace('000000',treeNode.id);
                    var $opt = $('#categoryBtDel').data();
                    $opt.url = delUrl;
                    $('#categoryBtDel').data($opt);

                    $('.category_tips').hide();
                    $('.category_info').show();
                    currentCategory = treeNode;
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