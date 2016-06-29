<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php include './Public/top.php'; ?>
    <title>权限管理</title>
</head>
<body>
    <!-- 头部 -->
    <?php include './Public/header.php' ?>

    <div class="body">
        <div class="inner clearfix">
            <div class="col_side">
                <?php
                    define("SELECT_MENU", "auth");
                ?>
                <!-- 左侧菜单栏 -->
                <?php include './Public/leftMenu.php' ?>
            </div>
            <div class="col_main">
                <div class="main_hd">
                    <h2>权限管理</h2>
                    <div class="title_tab">
                        <ul class="tab_ul dib-wrap">
                            <li class="dib selected"><a href="auth.php">分组管理</a></li>
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
                    <div class="main_bd_top clearfix">
                        <ul class="tab_caozuo dib-wrap">
                            <li class="dib"><a href="#">添加</a></li>
                        </ul>
                    </div>
                    <div class="quanxian_wrap clearfix">
                        <div class="quanxian_list ui_col_18">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width:200px;">分类名称</th>
                                        <th>描述</th>
                                        <th style="width:150px;">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="js_remove">
                                        <td><span>运营组</span></td>
                                        <td>运营组</td>
                                        <td>
                                            <a href="#">编辑</a>
                                            <a href="javascript:void(0);" class="js_slide_show_del" target="ajaxDel" data-opt="{
                                                title: '删除文章',
                                                tips: '确定要删除该记录吗？',
                                                url: 'Data/Json/Error.php',
                                                callback: 'delSuccess'
                                            }">删除</a>
                                            <a href="javascript:void(0);" class="jsQuanxian" data-opt="{
                                                id: '1',
                                                name: '运营组',
                                                url: 'Data/Json/quanxianJson.php'
                                            }">权限</a>
                                        </td>
                                    </tr>
                                    <tr class="js_remove">
                                        <td><span>美工组</span></td>
                                        <td>美工组</td>
                                        <td>
                                            <a href="#">编辑</a>
                                            <a href="javascript:void(0);" class="js_slide_show_del" target="ajaxDel" data-opt="{
                                                title: '删除文章',
                                                msg: '确定要删除该记录吗？',
                                                url: 'Data/Json/Error.php',
                                                callback: 'delSuccess'
                                            }">删除</a>
                                            <a href="javascript:void(0);" class="jsQuanxian" data-opt="{
                                                id: '2',
                                                name: '美工组',
                                                url: 'Data/Json/quanxianJson.php'
                                            }">权限</a>
                                        </td>
                                    </tr>
                                    <tr class="js_remove">
                                        <td><span>超级管理员</span></td>
                                        <td>超级管理员</td>
                                        <td>
                                            <a href="#">编辑</a>
                                            <a href="javascript:void(0);" class="js_slide_show_del" target="ajaxDel" data-opt="{
                                                title: '删除文章',
                                                msg: '确定要删除该记录吗？',
                                                url: 'Data/Json/Success.php',
                                                callback: 'delSuccess'
                                            }">删除</a>
                                            <a href="javascript:void(0);" class="jsQuanxian" data-opt="{
                                                id: '3',
                                                name: '超级管理员',
                                                url: 'Data/Json/quanxianJson.php'
                                            }">权限</a>
                                        </td>
                                    </tr>
                                    <tr class="js_remove">
                                        <td><span>PHP组</span></td>
                                        <td>PHP组</td>
                                        <td>
                                            <a href="#">编辑</a>
                                            <a href="javascript:void(0);" class="js_slide_show_del" target="ajaxDel" data-opt="{
                                                title: '删除文章',
                                                msg: '确定要删除该记录吗？',
                                                url: 'Data/Json/Success.php',
                                                callback: 'delSuccess'
                                            }">删除</a>
                                            <a href="javascript:void(0);" class="jsQuanxian" data-opt="{
                                                id: '4',
                                                name: 'PHP组',
                                                url: 'Data/Json/quanxianJson.php'
                                            }">权限</a>
                                        </td>
                                    </tr>
                                    <tr class="js_remove">
                                        <td><span>IOS组</span></td>
                                        <td>IOS组</td>
                                        <td>
                                            <a href="#">编辑</a>
                                            <a href="javascript:void(0);" class="js_slide_show_del" target="ajaxDel" data-opt="{
                                                title: '删除文章',
                                                msg: '确定要删除该记录吗？',
                                                url: 'Data/Json/Success.php',
                                                callback: 'delSuccess'
                                            }">删除</a>
                                            <a href="javascript:void(0);" class="jsQuanxian" data-opt="{
                                                id: '5',
                                                name: 'IOS组',
                                                url: 'Data/Json/quanxianJson.php'
                                            }">权限</a>
                                        </td>
                                    </tr>
                                    <tr class="js_remove">
                                        <td><span>销售组</span></td>
                                        <td>销售组</td>
                                        <td>
                                            <a href="#">编辑</a>
                                            <a href="javascript:void(0);" class="js_slide_show_del" target="ajaxDel" data-opt="{
                                                title: '删除文章',
                                                msg: '确定要删除该记录吗？',
                                                url: 'Data/Json/Success.php',
                                                callback: 'delSuccess'
                                            }">删除</a>
                                            <a href="javascript:void(0);" class="jsQuanxian" data-opt="{
                                                id: '6',
                                                name: '销售组',
                                                url: 'Data/Json/quanxianJson.php'
                                            }">权限</a>
                                        </td>
                                    </tr>
                                    <tr class="js_remove">
                                        <td><span>普通会员</span></td>
                                        <td>普通会员</td>
                                        <td>
                                            <a href="#">编辑</a>
                                            <a href="javascript:void(0);" class="js_slide_show_del" target="ajaxDel" data-opt="{
                                                title: '删除文章',
                                                msg: '确定要删除该记录吗？',
                                                url: 'Data/Json/Success.php',
                                                callback: 'delSuccess'
                                            }">删除</a>
                                            <a href="javascript:void(0);" class="jsQuanxian" data-opt="{
                                                id: '7',
                                                name: '普通会员',
                                                url: 'Data/Json/quanxianJson.php'
                                            }">权限</a>
                                        </td>
                                    </tr>
                                    <tr class="js_remove">
                                        <td><span>超级会员</span></td>
                                        <td>超级会员</td>
                                        <td>
                                            <a href="#">编辑</a>
                                            <a href="javascript:void(0);" class="js_slide_show_del" target="ajaxDel" data-opt="{
                                                title: '删除文章',
                                                msg: '确定要删除该记录吗？',
                                                url: 'dataHtml/Success.php',
                                                callback: 'delSuccess'
                                            }">删除</a>
                                            <a href="javascript:void(0);" class="jsQuanxian" data-opt="{
                                                id: '8',
                                                name: '超级会员',
                                                url: 'Data/Json/quanxianJson.php'
                                            }">权限</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="list_tree ui_col_6">
                            <div class="category_tree">
                                <input type="hidden" id="currentGroupId" />
                                <h2>分类<span id="currentGroupName"></span></h2>
                                <ul id="categoryTree" class="ztree">
                                    <li class="tips">请点击权限按钮进行分配</li>
                                </ul>
                                <a href="#" class="ui_button small mt10 ml15 jsQuanxianSave">保 存</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('a.jsQuanxian').each(function(){
            var $this = $(this);
            $this.off('click').on('click', function(){
                var $this = $(this);
                var $data = $this.data();
                var _url = $data.url;
                var data = {
                    id: $data.id
                }
                Juuz.ajaxGet(_url, data, function(json){
                    var setting = {
                        check: {
                            enable: true
                        },
                        data: {
                            simpleData: {
                                enable: true,
                                pIdKey : 'pid'
                            }
                        }
                    };
                    var zNodes = json.res;

                    $.fn.zTree.init($("#categoryTree"), setting, zNodes);
                    $.fn.zTree.getZTreeObj("categoryTree").expandAll(true);

                    $('.jsQuanxianSave').css('display','inline-block');
                    $('#currentGroupId').val($data.id);
                    $('#currentGroupName').text('（' + $data.name + '）');

                    $this.parents('tr').addClass('active').siblings().removeClass('active');
                }, Juuz.noop);

                return false;
            })
        });

        $('a.jsQuanxianSave').off('click').on('click', function(){
            var $this = $(this);
            var _url = $this.attr('href') || '';
            var quanxianSelect = '';
            var groupId = $('#currentGroupId').val();
            var zTree = $.fn.zTree.getZTreeObj("categoryTree"),
            checkCount = zTree.getCheckedNodes(true);
            for(var i = 0; i < checkCount.length; i++){
                quanxianSelect += checkCount[i].id + ',';
            }
            quanxianSelect = quanxianSelect.substring(0, quanxianSelect.length-1);
            var data = {
                'groupId': groupId,
                'idStr': quanxianSelect
            }
            Juuz.ajaxGet(_url, data, function(json){
                console.log(json);
            });

            return false;
        });

        function delSuccess(obj){
            var className = obj.parents('tr')[0].className;
            if(className.indexOf('active') >= 0){
                $('#categoryTree').html('<li class="tips">请点击权限按钮进行分配</li>');
                $('.jsQuanxianSave').hide();
                $('#currentGroupName').text('');
            }
        }

    </script>
</body>
</html>