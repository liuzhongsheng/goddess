<div class="heade" id="header">
    <div class="head_box">
        <h1 class="logo">
            <a href="main.php" title="Juuz"><img src="<?php echo ADMIN ?>Images/logo_header.png" /></a>
        </h1>
        <div class="account">
            <span class="account_bg_left"></span>
            <span class="account_bg_right"></span>
            <span class="account_welcom">当前用户：<strong>管理员</strong></span>
            <a href="javascript:void(0);" class="account_update" target="popDialog" data-opt="{
                title: '修改密码',
                url: 'Data/Html/updatePwd.htm',
                dataType: 'html'
            }">修改密码</a>
            <a href="javascript:void(0);" class="account_logout">安全退出</a>
        </div>
        <div class="head_menu">
            <?php foreach($head_menu as $key => $value){?>
                <a href="#" class="<?php if($value['module'] == MODULE_NAME){ echo 'selected';}?>"><?php echo $value['title'];?></a>
            <?php } ?>
        </div>
    </div>
</div>