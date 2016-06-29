<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php include './Public/top.php'; ?>
    <title>组件管理</title>
</head>
<body>
    <!-- 头部 -->
    <?php include './Public/header.php' ?>

    <div class="body">
        <div class="inner clearfix">
            <div class="col_side">
                <?php
                    define("SELECT_MENU", "zujian");
                ?>
                <!-- 左侧菜单栏 -->
                <?php include './Public/leftMenu.php' ?>
            </div>
            <div class="col_main">
                <div class="main_hd">
                    <h2>组件管理</h2>
                    <div class="title_tab">
                        <ul class="tab_ul dib-wrap">
                            <li class="dib selected"><a href="zujian.php">自定义组件</a></li>
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
                            <label class="ui_label">操作按钮</label>
                            <a href="#" target="ajaxDel" data-opt='{
                                url: "Data/Json/Success.php",
                                title: "删除",
                                msg: "你确认要删除吗？",
                                param: {id:1,uid:"2"}
                            }'>删除（成功）</a>&nbsp;&nbsp;&nbsp;

                            <a href="#" target="ajaxDel" data-opt='{
                                url: "Data/Json/ErrorLogin.php",
                                title: "删除",
                                msg: "你确认要删除吗？",
                                param: {id:1,uid:"2"}
                            }'>删除（需登录后才可以操作）</a>&nbsp;&nbsp;&nbsp;

                            <a href="#" target="popDialog" data-opt='{
                                title: "修改密码",
                                url: "Data/Html/updatePwd.htm",
                                dataType: "html"
                            }'>修改密码（弹出修改密码框）</a>&nbsp;&nbsp;&nbsp;

                            <a href="#" target="popDialog" data-opt='{
                                title: "表单修改（可纵向滚动）",
                                height: "400",
                                url: "Data/Html/updateForm.htm",
                                dataType: "html"
                            }'>弹出框（可纵向滚动）</a>&nbsp;&nbsp;&nbsp;

                            <a href="#" target="ajaxTodo" data-opt='{
                                title: "审核",
                                msg: "你确认要让XXX通过审核吗？",
                                param: {id:1,uid:"2"},
                                btnArr: [{name: "审核不通过", url: "Data/Json/Success.php", callback: "btn1Success"},{name: "审核通过", url: "Data/Json/Success.php", callback: "btn2Success"}]
                            }'>请求操作（审核）</a>&nbsp;&nbsp;&nbsp;

                            <a href="#" target="ajaxTodo" data-opt='{
                                url: "Data/Json/Success.php",
                                param: {id:1,uid:"2"},
                                callback: "successCallback"
                            }'>请求操作（带回调函数）</a>
                            <script type="text/javascript">
                                function btn1Success(json, obj){
                                    console.log(json);
                                    console.log(obj);
                                    alert("点击按钮1，回调成功");
                                }
                                function btn2Success(json, obj){
                                    console.log(json);
                                    console.log(obj);
                                    alert("点击按钮2，回调成功");
                                }
                                function successCallback(json, obj){
                                    console.log(json);
                                    console.log(obj);
                                    alert("回调成功 o(^▽^)o");
                                }
                            </script>
                        </div>

                        <div class="ui_col_8">
                            <label class="ui_label">标题文本框</label>
                            <input class="ui_text_input title" type="text" name="" />
                        </div>
                        <div class="ui_col_8">
                            <label class="ui_label">普通文本框</label>
                            <input class="ui_text_input" type="text" name="" />
                        </div>
                        <div class="ui_col_8">
                            <label class="ui_label">必填文本框</label>
                            <input class="ui_text_input" type="text" name="" data-opt='{
                                type : "require",
                                msg : "这是必填字段"
                            }' />
                        </div>

                        <div class="ui_col_12">
                            <label class="ui_label">只读文本框</label>
                            <input class="ui_text_input" type="text" name="" value="文本框内容只读" readonly="readonly" />
                        </div>
                        <div class="ui_col_12">
                            <label class="ui_label">禁用文本框</label>
                            <input class="ui_text_input" type="text" name="" value="文本框禁用" disabled="disabled" />
                        </div>

                        <div class="ui_col_8">
                            <label class="ui_label">普通文本域</label>
                            <textarea class="ui_textarea" name=""></textarea>
                        </div>
                        <div class="ui_col_8">
                            <label class="ui_label">必填文本域</label>
                            <textarea class="ui_textarea" name="" data-opt='{
                                type : "require",
                                msg : "这是必填字段"
                            }'></textarea>
                        </div>
                        <div class="ui_col_8">
                            <label class="ui_label">只读文本域</label>
                            <textarea class="ui_textarea" name="" readonly="readonly">文本域内容只读</textarea>
                        </div>

                        <div class="ui_col_8">
                            <label class="ui_label">时间（yyyy-mm-dd）</label>
                            <input type="text" name="time" class="Wdate" onFocus="WdatePicker({isShowClear:false,readOnly:true})" />
                        </div>
                        <div class="ui_col_8">
                            <label class="ui_label">时间（yyyy-mm-dd HH:mm:ss）</label>
                            <input type="text" name="time" class="Wdate" onFocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
                        </div>
                        <div class="ui_col_8">
                            <label class="ui_label">时间（yyyy年MM月dd日）</label>
                            <input type="text" name="time" class="Wdate" onFocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt:'yyyy年MM月dd日'})" />
                        </div>

                        <div class="ui_col_24">
                            <label class="ui_label">单选按钮</label>
                            <label class="ui_radio">
                                <input type="radio" checked="checked" value="0" name="radioName" />选项一
                            </label>
                            <label class="ui_radio">
                                <input type="radio" value="1" name="radioName" />选项二
                            </label>
                            <label class="ui_radio">
                                <input type="radio" value="2" name="radioName" />选项三
                            </label>
                            <label class="ui_radio">
                                <input type="radio" value="3" name="radioName" />选项四
                            </label>
                            <label class="ui_radio">
                                <input type="radio" value="4" name="radioName" />选项五
                            </label>
                        </div>

                        <div class="ui_col_12">
                            <div class="ui_checkbox_wrap">
                                <label class="ui_label">多选框</label>
                                <label class="ui_checkbox">
                                    <input type="checkbox" value="1" name="checkboxName" />选择1
                                </label>
                                <label class="ui_checkbox">
                                    <input type="checkbox" value="2" name="checkboxName" />选择2
                                </label>
                                <label class="ui_checkbox">
                                    <input type="checkbox" value="3" name="checkboxName" />选择3
                                </label>
                                <label class="ui_checkbox">
                                    <input type="checkbox" value="4" name="checkboxName" />选择4
                                </label>
                                <label class="ui_checkbox">
                                    <input type="checkbox" value="5" name="checkboxName" />选择5
                                </label>
                                <label class="ui_checkbox">
                                    <input type="checkbox" value="6" name="checkboxName" />选择6
                                </label>
                                <label class="ui_checkbox">
                                    <input type="checkbox" value="7" name="checkboxName" />选择7
                                </label>
                                <label class="ui_checkbox">
                                    <input type="checkbox" value="8" name="checkboxName" />选择8
                                </label>
                            </div>
                        </div>

                        <div class="ui_col_24">
                            <div class="ui_select_wrap">
                                <label class="ui_label">多级联动下拉框</label>
                                <select name="level_1" class="combox" data-opt='{
                                    ref : "level_2",
                                    name : "请选择省份1",
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
                                    ref : "level_3",
                                    name : "请选择城市2",
                                    url : "Data/Json/selectThree.php"
                                }'>
                                    <option value="">请选择城市</option>
                                </select>
                                <select name="level_3" class="combox" data-opt='{
                                    ref : "level_4",
                                    name : "请选择城市3",
                                    url : "Data/Json/selectTwo.php"
                                }'>
                                    <option value="">请选择城市</option>
                                </select>
                                <select name="level_4" class="combox" data-opt='{
                                    ref : "level_5",
                                    name : "请选择城市4",
                                    url : "Data/Json/selectThree.php"
                                }'>
                                    <option value="">请选择城市</option>
                                </select>
                                <select name="level_5" class="combox" data-opt='{
                                    name : "请选择城市5"
                                }'>
                                    <option value="">请选择城市</option>
                                </select>
                            </div>
                        </div>

                        <div class="ui_col_20">
                            <label class="ui_label">内容（UMEdit编辑器）</label>
                            <textarea name="content" class="editor" style="height:300px;"></textarea>
                        </div>

                        <div class="ui_col_20">
                            <label class="ui_label">内容（kindEditor编辑器）</label>
                            <textarea name="content" class="kindEditor" style="height:400px;"></textarea>
                            <script type="text/javascript">
                                KindEditor.ready(function(K) {
                                    var editor = K.create('.kindEditor', {
                                        uploadJson : './Js/Plugin/kindEditor/php/upload_json.php',
                                        allowFileManager : true,
                                        resizeMode: 1,
                                        filterMode: true,
                                        formatUploadUrl: false,
                                        htmlTags: {
                                            br: ['/'],
                                            img: ['src', 'width', 'height', 'border', 'alt', 'title', 'align', 'style', '/'],
                                            'p,strong,b,em': []
                                        },
                                        items: [
                                            'source','|','plainpaste','|','bold','|','italic','|','image','|','clearhtml','|','unlink'
                                        ]
                                    });
                                });
                            </script>
                        </div>

                        <div class="ui_col_12">
                            <label class="ui_label">查找带回</label>
                            <div class="ui_find_back">
                                <input type="text" readonly="readonly" class="ui_text_input js_find_back" />
                                <a href="javascript:void(0);" target="popDialog" data-opt='{
                                    type: "findBack",
                                    title: "查找数据带回id",
                                    url: "Data/Html/findBack.htm",
                                    dataType: "html",
                                    callback: "findBackSuccess"
                                }' class="btn_find_back"></a>
                                <script type="text/javascript">
                                    function findBackSuccess(){
                                        var str = "";
                                        $('input[name="popCheckbox"]:checked').each(function(){
                                            str += $(this).val() + ',';
                                        });
                                        str = str.substring(0, str.length-1);
                                        $('.js_find_back').val(str);
                                    }
                                </script>
                            </div>
                        </div>

                        <div class="ui_col_12">
                            <label class="ui_label">查找带回（内部带搜索）</label>
                            <div class="ui_find_back">
                                <input type="text" readonly="readonly" class="ui_text_input js_find_search" />
                                <input type="hidden" class="js_find_search_ids" name="findSearchIds" />
                                <a href="javascript:void(0);" target="popDialog" data-opt='{
                                    type: "findBack",
                                    title: "查找数据带回id",
                                    url: "Data/Html/findSearchBack.htm",
                                    dataType: "html",
                                    callback: "findSearchSuccess"
                                }' class="btn_find_back"></a>
                                <script type="text/javascript">
                                    function findSearchSuccess(){
                                        var ids = "";
                                        var texts = "";
                                        $('input[name="popCheckbox"]:checked').each(function(){
                                            texts += $(this).data().text + ',';
                                            ids += $(this).val() + ',';
                                        });
                                        texts = texts.substring(0, texts.length-1);
                                        ids = ids.substring(0, ids.length-1);
                                        $('.js_find_search_ids').val(ids);
                                        $('.js_find_search').val(texts);
                                    }
                                </script>
                            </div>
                        </div>

                        <div class="ui_col_20">
                            <label class="ui_label">下拉框选项获取内容</label>
                            <select name="selectName" class="combox" data-opt='{
                                stype : "selectBack",
                                ref : "selectContentId",
                                url : "Data/Html/selectBack.htm"
                            }'>
                                <option value="">请选择</option>
                                <option value="1">查找带回</option>
                                <option value="2">文章录入</option>
                            </select>
                            <div id="selectContentId" class="clearfix" style="padding:10px 0;"></div>
                        </div>

                        <div class="ui_col_20">
                            <label class="ui_label">联动+下拉获取内容</label>
                            <select name="test_1" class="combox" data-opt='{
                                ref : "test_2",
                                name : "请选择省份1",
                                url : "Data/Json/selectTwo.php"
                            }'>
                                <option value="">请选择省份</option>
                                <option value="1">北京</option>
                                <option value="2">上海</option>
                                <option value="3">湖南</option>
                                <option value="4">湖北</option>
                                <optgroup label="天津"></optgroup>
                            </select>
                            <select name="test_2" class="combox" data-opt='{
                                name: "请选择",
                                stype: "selectBack",
                                ref : "testCon",
                                url : "Data/Html/selectBack.htm"
                            }'>
                                <option value="">请选择</option>
                            </select>
                            <div id="testCon" class="clearfix" style="padding:10px 0;"></div>
                        </div>

                        <div class="ui_col_5">
                            <label class="ui_label">获取颜色（输入色值）</label>
                            <div class="ui_color_input dib-wrap">
                                <i class="dib">#</i>
                                <input class="dib js_color_input ui_text_input" type="text" name="color" />
                                <span class="dib"></span>
                            </div>
                        </div>

                        <div class="ui_col_5">
                            <label class="ui_label">获取颜色（选择色值）</label>
                            <div class="ui_color_select">
                                <input type="text" class="js_color_chang ui_text_input" data-control="hue" readonly value="#fff" />
                            </div>
                        </div>

                        <div class="ui_col_20">
                            <label class="ui_label">按钮</label>
                            <button type="button" class="ui_button small">按钮（小）</button><br /><br />
                            <button type="button" class="ui_button medium r3">按钮（中）</button><br /><br />
                            <button type="button" class="ui_button large r5">按钮（大）</button><br /><br />
                            <button type="button" class="ui_button large long">按钮（长）</button><br /><br />
                            <button type="submit" class="ui_button bold">按钮（加粗）</button><br /><br />
                            <input type="submit" value="input按钮" class="ui_button" /><br /><br />
                            <a href="javascript:void(0);" class="ui_button">a标签按钮</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>