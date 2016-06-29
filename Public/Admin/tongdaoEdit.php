<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php include './Public/top.php'; ?>
    <title>内容编辑管理</title>

    <!-- 地图api -->
    <script src="http://api.map.baidu.com/api?v=2.0&ak=9aedeed92ae13d1cddf4b6ee9265a536"></script>
    <script src="./Js/Plugin/gps.js"></script>
    <script src="./Js/Plugin/jquery.map.js"></script>

    <!-- 选择内容添加 -->
    <script type="text/javascript" src="./Js/Plugin/selectBox.js"></script>

    <!-- md5加密 -->
    <script src="./Js/Plugin/CryptoJS/md5.js"></script>

    <!-- 裁剪图片 -->
    <link rel="stylesheet" type="text/css" href="./Js/Plugin/Jcrop/css/jquery.Jcrop.css">
    <script src="./Js/Plugin/Jcrop/js/jquery.Jcrop.min.js"></script>
</head>
<body>
    <!-- 头部 -->
    <?php include './Public/header.php' ?>

    <div class="body">
        <div class="inner clearfix">
            <div class="col_side">
                <?php
                    define("SELECT_MENU", "tongdaoEdit");
                ?>
                <!-- 左侧菜单栏 -->
                <?php include './Public/leftMenu.php' ?>
            </div>
            <div class="col_main">
                <div class="main_hd">
                    <h2>内容编辑管理</h2>
                    <div class="title_tab">
                        <ul class="tab_ul dib-wrap">
                            <li class="dib selected"><a href="tongdaoEdit.php">同道（添加/编辑）</a></li>
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
                    <div class="main_bd_inner clearfix" style="position:relative;">
                        <div class="ui_col_6">
                            <ul id="categoryTree" class="ztree tongdao_tree" style="padding:10px 10px 10px 0;overflow-x: auto;"></ul>
                            <div id="treeTarget">
                                <input id="123456789" type="hidden" name="target[1][]" value="民间玩具" />
                                <input id="223456789" type="hidden" name="target[1][]" value="赏析" />
                                <input id="323456789" type="hidden" name="target[1][]" value="救援直升机" />
                                <input id="423456789" type="hidden" name="target[1][]" value="从商从政之路" />
                                <input id="523456789" type="hidden" name="target[2][]" value="音乐是解药" />
                                <input id="623456789" type="hidden" name="target[2][]" value="亚足联规定" />
                                <input id="723456789" type="hidden" name="target[2][]" value="政治经济学" />
                                <input id="823456789" type="hidden" name="target[3][]" value="公司薪酬" />
                                <input id="923456789" type="hidden" name="target[3][]" value="百年座谈会" />
                            </div>
                            <script>
                                var setting = {
                                    edit:{
                                        enable: true,
                                        showRemoveBtn: showRemoveBtn,
                                        showRenameBtn: false
                                    },
                                    data: {
                                        simpleData: {
                                            enable: true,
                                            pIdKey : 'pid'
                                        }
                                    },
                                    callback:{
                                        onClick: ztreeOnClick,
                                        beforeRemove: beforeRemove
                                    }
                                };
                                var zNodes = [{
                                    id:0, pid:null, name:"通道关键字管理", isParent:true, open:true
                                },{
                                    id:1, pid:0, name:"主题"
                                },{
                                    id:11, pid:1, md5:'123456789', name:"民间玩具"
                                },{
                                    id:12, pid:1, md5:'223456789', name:"赏析"
                                },{
                                    id:13, pid:1, md5:'323456789', name:"救援直升机"
                                },{
                                    id:14, pid:1, md5:'423456789', name:"从商从政之路"
                                },{
                                    id:2, pid:0, name:"主讲人"
                                },{
                                    id:21, pid:2, md5:'523456789', name:"音乐是解药"
                                },{
                                    id:22, pid:2, md5:'623456789', name:"亚足联规定"
                                },{
                                    id:23, pid:2, md5:'723456789', name:"政治经济学"
                                },{
                                    id:3, pid:0, name:"内容"
                                },{
                                    id:31, pid:3, md5:'823456789', name:"公司薪酬"
                                },{
                                    id:32, pid:3, md5:'923456789', name:"百年座谈会"
                                }];

                                var currentNode = null;
                                function ztreeOnClick(event, treeId, treeNode){
                                    currentNode = treeNode;
                                }

                                function showRemoveBtn(treeId, treeNode) {
                                    if(treeNode.level == 0 || treeNode.level == 1){
                                        return false;
                                    }else{
                                        return true;
                                    }
                                }

                                function beforeRemove(treeId, treeNode){
                                    var md5 = treeNode.md5;
                                    $('#'+md5).remove();
                                    return true;
                                }

                                function addHoverDom(selectStr) {
                                    var _md5 = CryptoJS.MD5(selectStr);
                                    if($('#'+_md5).size() > 0){
                                        Juuz.tipsMsg("该关键字已经添加过，无法继续添加");
                                        return;
                                    }
                                    var zTree = $.fn.zTree.getZTreeObj("categoryTree");
                                    zTree.addNodes(currentNode, {pId:currentNode.id, md5: _md5, name:selectStr});
                                    var str = '<input id="'+_md5+'" type="hidden" name="target['+currentNode.id+'][]" value="'+selectStr+'" />';
                                    $('#treeTarget').append(str);
                                }

                                $(function(){
                                    var treeObj = $("#categoryTree");
                                    $.fn.zTree.init(treeObj, setting, zNodes);
                                    $.fn.zTree.getZTreeObj("categoryTree").expandAll(true);
                                });
                            </script>
                        </div>
                        <div class="ui_col_18">
                            <div class="ui_col_18">
                                <label class="ui_label">主题</label>
                                <input class="ui_text_input title" type="text" name="title" />
                            </div>
                            <div class="ui_col_18">
                                <div class="ui_col_6">
                                    <label class="ui_label">开始时间</label>
                                    <input type="text" name="startTime" class="Wdate" onFocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
                                </div>
                                <div class="ui_col_6">
                                    <label class="ui_label">结束时间</label>
                                    <input type="text" name="endTime" class="Wdate" onFocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
                                </div>
                                <div class="ui_col_6">
                                    <label class="ui_label">使用模板</label>
                                    <select name="articleTemp" class="combox">
                                        <option value="">请选择模板</option>
                                        <option value="1">页面模板一</option>
                                        <option value="2">页面模板二</option>
                                        <option value="3">页面模板三</option>
                                    </select>
                                </div>
                            </div>
                            <div class="ui_col_18">
                                <div class="ui_col_18">
                                    <label class="ui_label">地点</label>
                                    <input class="ui_text_input" type="text" name="address" />
                                </div>
                                <div class="ui_col_18">
                                    <label class="ui_label"></label>
                                    <div class="js_map_warp" data-opt='{
                                        type: "",
                                        lng: "116.403891",
                                        lat: "39.915129",
                                        width: "710",
                                        height: "300",
                                        lookupGroup: "mapInput"
                                    }'></div>
                                </div>
                            </div>
                            <div class="ui_col_18">
                                <label class="ui_label">主办方</label>
                                <div class="ui_select_input">
                                    <div id="uiSelectVal" class="select_val" data-ids="2,6,8">
                                        <span>
                                            吴建明<a href="#" class="js_label_del"></a>
                                            <input type="hidden" name="ids[]" value="2" />
                                        </span>
                                        <span>
                                            王华<a href="#" class="js_label_del"></a>
                                            <input type="hidden" name="ids[]" value="6" />
                                        </span>
                                        <span>
                                            周星驰<a href="#" class="js_label_del"></a>
                                            <input type="hidden" name="ids[]" value="8" />
                                        </span>
                                    </div>
                                    <a href="#" class="btn_add" target="popDialog" data-opt='{
                                        title: "主办方",
                                        url: "Data/Html/zhubanfangForm.htm",
                                        dataType: "html"
                                    }'></a>
                                </div>
                            </div>
                            <div class="ui_col_18">
                                <label class="ui_label">主讲人</label>
                                <div class="ui_select_input">
                                    <div id="uiSelectVal2" class="select_val" data-ids="21,81">
                                        <span>
                                            刘德华<a href="#" class="js_label_del"></a>
                                            <input type="hidden" name="iids[]" value="21" />
                                        </span>
                                        <span>
                                            贾静雯<a href="#" class="js_label_del"></a>
                                            <input type="hidden" name="iids[]" value="81" />
                                        </span>
                                    </div>
                                    <a href="#" class="btn_add" target="popDialog" data-opt='{
                                        title: "主讲人",
                                        url: "Data/Html/zhujiangrenForm.htm",
                                        dataType: "html"
                                    }'></a>
                                </div>
                            </div>
                            <div class="ui_col_18">
                                <label class="ui_label">内容</label>
                                <div id="selectText">
                                    <textarea name="content" class="editor" style="height:300px;"></textarea>
                                    <div class="selectBox"></div>
                                </div>
                                <script type="text/javascript">
                                    $(".selectBox").selectBox({
                                        text: "#selectText",
                                        items: [{
                                            title: "新增",
                                            style: "add",
                                            onClick: function() {
                                                var selectStr = $(this).selectBox('getSelectText');

                                                if(!currentNode || currentNode == null){
                                                    Juuz.tipsMsg('请选择左侧关键字分类！');
                                                }else if(currentNode.pid != 0){
                                                    Juuz.tipsMsg('关键字只能添加到二级分类下！');
                                                }else{
                                                    var url = "./Data/Json/keywordAdd.php";
                                                    var data = {
                                                        aid: "",
                                                        tid: currentNode.id,
                                                        str: selectStr
                                                    }
                                                    addHoverDom(selectStr);
                                                }

                                                return false;
                                            }
                                        }]
                                    });
                                </script>
                            </div>
                            <div class="ui_col_18">
                                <label class="ui_label">分类</label>
                                <div class="ui_category_label">
                                    <div id="uiCategoryLabel" class="cagegory_label" data-ids="11,12,13,14">
                                        <span>
                                            蓝色<a href="#" class="js_label_del"></a>
                                            <input type="hidden" name="labelId[1][]" value="11" />
                                        </span>
                                        <span>
                                            灵魂<a href="#" class="js_label_del"></a>
                                            <input type="hidden" name="labelId[1][]" value="12" />
                                        </span>
                                        <span>
                                            女性<a href="#" class="js_label_del"></a>
                                            <input type="hidden" name="labelId[2][]" value="13" />
                                        </span>
                                        <span>
                                            杂志<a href="#" class="js_label_del"></a>
                                            <input type="hidden" name="labelId[3][]" value="14" />
                                        </span>
                                    </div>
                                </div>
                                <label class="ui_label"></label>
                                <select name="selectName" class="combox" data-opt='{
                                    stype : "selectBack",
                                    ref : "categoryLabelCon",
                                    ids: "11,12,13,14",
                                    url : "Data/Html/category_label.htm"
                                }'>
                                    <option value="">请选择</option>
                                    <option value="1">无线通信</option>
                                    <option value="2">自动化基础理论</option>
                                    <option value="3">图书馆学</option>
                                    <option value="4">档案事业</option>
                                </select>
                                <div id="categoryLabelCon" class="clearfix" style="padding:10px 0;"></div>
                            </div>
                            <div class="ui_col_18">
                                <label class="ui_label">图片</label>
                                <div class="ui_jcrop">
                                    <input data-opt='{
                                        fileType: "jcropImg",
                                        width: "500",
                                        height: "50",
                                        btnHeight: "50",
                                        name: "封面图上传",
                                        x: "",
                                        y: "",
                                        w: "",
                                        h: "",
                                        thumb: ""}
                                    ' type="hidden" class="js_hidden_file" />
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