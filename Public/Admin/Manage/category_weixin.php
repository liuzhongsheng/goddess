<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php include './Public/top.php'; ?>
    <title>微信菜单管理</title>
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
                    <h2>自定义菜单管理</h2>
                    <div class="title_tab">
                        <ul class="tab_ul dib-wrap">
                            <li class="dib"><a href="category.php">普通分类</a></li>
                            <li class="dib"><a href="category_quanxian.php">权限分类（ajax请求）</a></li>
                            <li class="dib selected"><a href="category_weixin.php">微信菜单</a></li>
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
                            <h2 class="border_r">菜单</h2>
                            <ul id="categoryTree" class="ztree"></ul>
                        </div>
                        <div class="category_right">
                            <h2>菜单操作</h2>
                            <div class="category_main">
                                <p class="category_tips">请选择左侧分类在进行相关操作</p>
                                <div class="category_info">
                                    <ul class="category_tools dib-wrap">
                                        <li class="dib">
    										<a id="categoryBtConfig" href="javascript:void(0);" target="popDialog" data-opt="{
                                                title: '菜单配置',
                                                url: 'Data/Html/configview.htm',
                                                dataType: 'html'
                                            }">配 置</a>
                                        </li>
                                        <li class="dib">
    										<a id="categoryBtAdd" href="javascript:void(0);" target="popDialog" data-opt="{
                                                title: '添加子菜单',
                                                url: 'Data/Html/categoryAdd.htm',
                                                dataType: 'html',
                                                before: 'addCategroyBefore'
                                            }">添 加</a>
                                        </li>
                                        <li class="dib">
    										<a id="categoryBtDel" href="javascript:void(0);" target="ajaxDel" data-opt="{
                                                title: '删除菜单',
                                                msg: '是否删除该菜单？',
                                                url: 'Data/Json/Success.php'
                                            }">删 除</a>
                                        </li>
                                    </ul>
                                    <form action="" method="post" class="clearfix" onsubmit="return Juuz.ajaxForm(this)">
                                        <input type="hidden" id="sid" name="sid" value="" />

                                        <div class="ui_col_10">
                                            <label class="ui_label">菜单编号 : </label>
                                            <input id="categoryId" class="ui_text_input" readonly="readonly" type="text" name="id" />
                                        </div>
                                        <div class="ui_col_10">
                                            <label class="ui_label">菜单名称 : </label>
                                            <input id="categoryName" class="ui_text_input" type="text" name="name" data-opt='{
                                                type : "require",
                                                msg : "菜单名称不能为空"
                                            }' />
                                        </div>
                                        <div class="ui_col_10">
                                            <label class="ui_label">显示序号 : </label>
                                            <input id="categorySort" class="ui_text_input" type="text" name="sort" />
                                            <label class="ui_label">序号越大，菜单越靠前，默认序号 0 不排序）</label>
                                        </div>
                                        <div class="ui_col_10 r3 mt20">
                                            <button type="submit" id="categoryBtSave" class="ui_button medium r3">保 存</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui_col_24 pt20 pb20 tr">
                        <a href="javascript:void(0);" class="ui_button r3">发布菜单</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var deleteUrl = "{:U('delete',array('id'=>'000000'))}";
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
            { id:23, pid:2, name:"加入我们"},
            { id:24, pid:2, name:"最新动态"},
            { id:25, pid:2, name:"加入我们"},

            { id:3, pid:0, name:"文章", open:true},
            { id:31, pid:3, name:"荣誉奖项"},
            { id:32, pid:3, name:"最新动态"},
            { id:33, pid:3, name:"加入我们"}
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

            if(treeNode.level == 2){
                $('#categoryBtAdd').hide();
            }else{
                $('#categoryBtAdd').show();
            }

            if(!treeNode.children){
                $('#categoryBtConfig').show();
            }else{
                $('#categoryBtConfig').hide();
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

        function addCategroyBefore(){
            if(currentCategory.children){
                if(currentCategory.id == 0 && currentCategory.children.length == 3){
                    Juuz.tipsMsg("一级菜单最多三个");
                    return false;
                }else if(currentCategory.id != 0 && currentCategory.children.length == 5){
                    Juuz.tipsMsg("二级菜单最多五个");
                    return false;
                }else{
                    return true;
                }
            }
        }

        $(function(){
            $.fn.zTree.init($("#categoryTree"), setting, zNodes);
        })
    </script>
</body>
</html>