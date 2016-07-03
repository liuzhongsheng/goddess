<style>
    .category_add_form{
        padding-bottom:42px;
    }
    .ui_pop_foot{
        background-color:#F4F5F9;border-top:1px solid #ddd;text-align:right;
        position:absolute;padding:8px 0;bottom:0;left:0;width:100%;
    }
</style>
<script>
    if(currentCategory){
        $('#categoryAddPid').val(currentCategory.id);
        $('#categoryAddPname').val(currentCategory.title);
    }
</script>
<form class="category_add_form clearfix" action="<?php echo Url('auth_edit');?>" method="post" onsubmit="return Juuz.ajaxForm(this);">
<div class="ui_col_10" style="padding:10px 20px 20px">
    <input id="categoryAddPid" type="hidden" name="pid" />
    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'];?>"/>
    <div class="ui_col_10">
        <label class="ui_label">上级分类 : </label>
        <input id="categoryAddPname" class="ui_text_input" readonly="readonly" type="text" />
    </div>
    <?php switch($info['level']){case 0:?>
             <input type="hidden" name="module" value="<?php echo $info['module'];?>">
             <input type="hidden" name="level" value="1">
             <div class="ui_col_5">
                <label class="ui_label">控制器标题 : </label>
                <input class="ui_text_input" type="text" name="title" data-opt='{
                    type : "require",
                    msg : "请输入控制器标题"
                }' />
            </div>
             <div class="ui_col_5">
                <label class="ui_label">控制器名称 : </label>
                <input class="ui_text_input" type="text" name="controller" data-opt='{
                    type : "require",
                    msg : "请输入控制器名称"
                }' />
            </div>
            <div class="ui_col_6">
                <label class="ui_label">控制器路径 : </label>
                <input id="categoryTitle" class="ui_text_input" readonly="readonly" type="text" value="<?php echo $info['name'];?>" />
            </div>
            <div class="ui_col_2">
                <label class="ui_label">分类序号: </label>
                <input class="ui_text_input" type="text" name="sort" value="99"  data-opt='{
                    type : "require number",
                    msg : "请输入排序序号 排序序号只能为数字"
                }'/>
            </div>
    <?break;case 1:?>
                 <input type="hidden" name="module" value="<?php echo $info['module'];?>">
                 <input type="hidden" name="controller" value="<?php echo $info['controller'];?>">
                 <input type="hidden" name="level" value="2">
                 <div class="ui_col_5">
                    <label class="ui_label">方法标题 : </label>
                    <input class="ui_text_input" type="text" name="title" data-opt='{
                        type : "require",
                        msg : "请输入方法标题"
                    }' />
                </div>
                 <div class="ui_col_5">
                    <label class="ui_label">方法名称 : </label>
                    <input class="ui_text_input" type="text" name="method" data-opt='{
                        type : "require",
                        msg : "请输入方法名称"
                    }' />
                </div>
                <div class="ui_col_6">
                    <label class="ui_label">方法路径 : </label>
                    <input id="categoryTitle" class="ui_text_input" readonly="readonly" type="text" value="<?php echo $info['name'];?>" />
                </div>
                <div class="ui_col_4">
                    <label class="ui_label">序号(降序) : </label>
                    <input class="ui_text_input" type="text" name="sort" value="99" data-opt='{
                    type : "require number",
                    msg : "请输入排序序号 排序序号只能为数字"
                }'/>
                </div>
                <div class="ui_col_4">
                    <label class="ui_label">是否菜单</label>
                    <label class="ui_radio">
                        <input type="radio" checked="checked" value="0" name="is_menu" />菜单
                    </label>
                    <label class="ui_radio">
                        <input type="radio" value="1" name="is_menu" />非菜单
                    </label>
                </div>
        <?php break;default:?>
            <div class="ui_col_10">
                <label class="ui_label">模块标题 : </label>
                <input class="ui_text_input" type="text" name="title" data-opt='{
                    type : "require",
                    msg : "请输入模块标题"
                }' />
            </div>
            <div class="ui_col_10">
                <label class="ui_label">模块名称 : </label>
                <input class="ui_text_input" type="text" name="module" data-opt='{
                    type : "require",
                    msg : "请输入模块名称"
                }' />
            </div>
            <div class="ui_col_5">
                <label class="ui_label">排序序号 : </label>
                <input class="ui_text_input" type="text" name="sort" value="99" data-opt='{
                    type : "require number",
                    msg : "请输入排序序号 排序序号只能为数字"
                }' />
                <label class="ui_label">（序号越大，分类越靠前，默认序号 99）</label>
            </div>
    <?php } ?>

</div>
<div class="ui_pop_foot">
    <button type="submit" class="ui_button small mr10">保 存</button>
</div>
</form>