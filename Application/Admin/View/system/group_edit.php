<style>
    .ui_pop_foot{
        background-color:#F4F5F9;border-top:1px solid #ddd;text-align:right;
        position:absolute;padding:8px 0;bottom:0;left:0;width:100%;
    }
</style> 
<form class="clearfix" action="<?php echo Url('group_edit');?>" method="post" onsubmit="return Juuz.ajaxForm(this);">
    <div class="ui_col_8" style="padding:10px 20px 62px">
        <input type="hidden" name="id" value="<?php echo $info['id'];?>">
        <div class="ui_col_8">
            <label class="ui_label">分组名称 : </label>
            <input class="ui_text_input" type="text" name="title" value="<?php echo $info['title'];?>" data-opt='{
                type : "require",
                msg : "请输入分组名称"
            }' />
        </div>
        <div class="ui_col_8">
            <label class="ui_label">描述</label>
            <textarea class="ui_textarea" name="desc"><?php echo $info['desc'];?></textarea>
        </div>
        <div class="ui_col_8">
            <div class="ui_col_2">
                <label class="ui_label">排序 : </label>
                <input class="ui_text_input" name="sort" data-opt='{
                    type : "require number",
                    msg : "请输入顺序 排序只能是数字"
                }' value="<?php echo $info['sort'];?>"/>

            </div>
            <label class="ui_label">&nbsp;</label>
            <span> (序号越大越靠前)</span>
        </div>
       
    </div>
    <div class="ui_pop_foot">
        <button type="submit" class="ui_button small mr10">提 交</button>
    </div>
</form>