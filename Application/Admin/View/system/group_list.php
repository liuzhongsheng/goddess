<!DOCTYPE html>
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
                    define("SELECT_MENU", "auth");
                ?>
                <!-- 左侧菜单栏 -->
                <?php include PUBLIC_HTML.'Public/leftMenu.php'; ?>
            </div>
            <div class="col_main">

                <div class="main_bd">
                    <div class="main_bd_top clearfix">
                        <ul class="tab_caozuo dib-wrap">
                            <?php foreach($editTag as $key=>$value){?>
                                <li class="dib">
                                        <a href="<?php echo $value['href'];?>" target="<?php echo $value['target'];?>" data-opt="<?php echo $value['dataopt']['data-opt'];?>"><?php echo $value['dataopt']['content'];?></a>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="quanxian_wrap clearfix">
                        <div class="quanxian_list ui_col_18">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width:200px;">分类名称</th>
                                        <th style="width:50px">人数</th>
                                        <th>描述</th>
                                        <th style="width:50px">排序</th>
                                        <th style="width:150px;">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $key => $value) {?>
                                    <tr class="js_remove">
                                        <td><span><?php echo $value['title'];?></span></td>
                                        <td><?php echo $value['num'];?></td>
                                        <td><?php echo $value['desc'];?></td>
                                        <td><?php echo $value['sort'];?></td>
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
                                    <?php } ?>
                                   
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