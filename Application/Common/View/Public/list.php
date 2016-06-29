<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php include PUBLIC_HTML.'Public/base.php'; ?>
    <title>列表管理</title>
</head>
<body>
    <!-- 头部 -->
<?php include PUBLIC_HTML.'Public/header.php'; ?>
    <div class="body">
        <div class="inner clearfix">
            <div class="col_side">
                <?php
                    define("SELECT_MENU", "list");
                ?>
                <!-- 左侧菜单栏 -->
                <?php include PUBLIC_HTML.'Public/leftMenu.php'; ?>
            </div>
            <div class="col_main">
                <div class="main_hd">
                    <h2>列表管理</h2>
                    <div class="title_tab">
                        <ul class="tab_ul dib-wrap">
                            <li class="dib selected"><a href="list.php">普通列表</a></li>
                        </ul>
                    </div>
                </div>
                <div class="main_bd">
                    <div class="main_bd_top clearfix">
                        <div class="search_condition">
                            <form id="searchForm" action="Data/Json/page.php" method="post" onsubmit="return Manage.updateListData(this);">
                                <select name="level_1" class="combox" data-opt='{
                                    ref : "level_2",
                                    name : "请选择省份",
                                    url : "Data/Json/selectTwo.php"
                                }'>
                                    <option value="">请选择省份</option>
                                    <option value="1">北京</option>
                                    <option value="2">上海</option>
                                    <option value="3">湖南</option>
                                    <option value="4">湖北</option>
                                    <optgroup label="天津"></optgroup>
                                </select>
                                <select name="level_2" class="combox" data-opt='{
                                    name : "请选择城市"
                                }'>
                                    <option value="">请选择城市</option>
                                </select>
                                <input type="text" name="time" class="Wdate mr10" onFocus="WdatePicker({isShowClear:false,readOnly:true})" />
                                <input type="text" name="searchText" class="ui_text_input mr10" placeHolder="请输入搜索内容" />
                                <input type="hidden" name="currentPage" value="1" />
                                <input type="hidden" name="pageNum" value="10" />
                                <button type="submit" class="js_list_find" onclick="return Manage.clearPage();">查询</button>
                            </form>
                        </div>
                        <ul class="tab_caozuo dib-wrap">
                            <li class="dib"><a href="#">添加</a></li>
                        </ul>
                    </div>
                    <div class="ui_list_wrap">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).off('click').on("click",function(e){
            var menuObj = $('.list_tools_menu');
            var target = $(e.target);
            if(target.closest(".js_list_tools").length == 0){
                menuObj.hide();
            }
        });

        var listJson = {
            currentPage: 1,
            totalPage: 20,
            showPageNum: 10,
            pageNum: 10,
            toolsOption: [{
                name: "编辑",
                opt: {
                    url: "http://www.baidu.com/id/___id___/sid/___sid___"
                }
            },{
                name: "审核",
                target: "ajaxTodo",
                opt: {
                    title: "审核文章",
                    msg: "确定要让___title___通过审核吗？",
                    btnArr: '[{name: "审核不通过", url: "Data/Json/Success.php/id/___id___"},{name: "审核通过", url: "Data/Json/Success.php/id/___id___"}]'
                }
            },{
                name: "上线|下线",
                target: "ajaxTodo",
                opt: {
                    type: "switch",
                    value: "___isonline___",
                    name: "上线|下线",
                    url: "Data/Json/Success.php/id/___id___/sid/___sid___|Data/Json/Success.php/id/___id___/",
                    callback: "onlineSuccess"
                }
            },{
                name: "删除",
                target: "ajaxDel",
                opt: {
                    title: "删除文章",
                    msg: "确定要删除___title___吗？",
                    url: "Data/Json/Success.php/id/___id___"
                }
            }],
            thead: [{
                name: "缩略图",
                width: "100",
                field: "img",
                type: "IMG"
            },{
                name: "标题",
                field: "title",
                order: "desc",
                align: 'center'
            },{
                name: "所属分类",
                width: "120",
                field: "catory",
                order: "desc"
            },{
                name: "时间",
                width: "100",
                field: "time",
                order: "desc"
            },{
                name: "操作",
                width: "40",
                field: "__TOOLS",
                type: "TOOLS"
            }],
            tbody: [{
                id: "01",
                sid: "001",
                isonline: 1,
                img: "Data/Images/article_img_1.jpg",
                title: "荣获年度中国十佳网页(互动)设计师称号",
                catory: "最新动态",
                time: "2011-07-08"
            },{
                id: "02",
                sid: "002",
                isonline: 0,
                img: "Data/Images/article_img_2.jpg",
                title: "寰球汽车传媒集团官方移动应用Quick Car",
                catory: "最新动态",
                time: "2011-07-08"
            },{
                id: "03",
                sid: "003",
                isonline: 0,
                img: "Data/Images/article_img_3.jpg",
                title: "双晖传媒创意总监王子年接受UIRSS专访",
                catory: "荣誉奖项",
                time: "2011-07-08"
            },{
                id: "04",
                sid: "004",
                isonline: 1,
                img: "Data/Images/article_img_4.jpg",
                title: "精品传媒集团《世界》杂志官方APP",
                catory: "加入我们",
                time: "2011-07-08"
            },{
                id: "05",
                sid: "005",
                isonline: 1,
                img: "Data/Images/article_img_5.jpg",
                title: "双晖传媒合作法国雷诺推出新纬度APP体验版",
                catory: "加入我们",
                time: "2011-07-08"
            },{
                id: "06",
                sid: "006",
                isonline: 0,
                img: "Data/Images/article_img_6.jpg",
                title: "China Daily News中国日报新闻APP",
                catory: "最新动态",
                time: "2011-07-08"
            },{
                id: "07",
                sid: "007",
                isonline: 0,
                img: "Data/Images/article_img_7.jpg",
                title: "双晖传媒创意总监王子年接受UIRSS专访",
                catory: "荣誉奖项",
                time: "2011-07-08"
            },{
                id: "08",
                sid: "008",
                isonline: 1,
                img: "Data/Images/article_img_8.jpg",
                title: "双晖传媒受邀国际权威在线创意杂志NWP专访",
                catory: "最新动态",
                time: "2011-07-08"
            }]
        }

        $(function(){
            var listTable = Manage.listTemp(listJson);
            var listWrap = $('.ui_list_wrap');
            listWrap.html(listTable);
            Manage.uiInit(listWrap);
        });

        function onlineSuccess(json, obj){
            var nameArr = obj.data().name.split('|');
            var value = json.value;
            obj.text(nameArr[value]);
        }
    </script>
</body>
</html>