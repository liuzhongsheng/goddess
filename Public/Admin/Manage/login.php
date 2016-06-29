<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php include './Public/top.php'; ?>
    <title>登陆</title>
</head>
<body>
    <div id="loginWarp">
        <div class="login_warp_main">
            <div class="login_head">
                <img title="Juuz" src="./Images/logo_login.png" />
                <span>后台管理系统</span>
            </div>
            <div class="login_content">
                <div class="login_form">
                    <span class="login_jiantou"></span>
                    <form action="" method="post" onsubmit="return Juuz.ajaxForm(this);">
                        <div class="login_username">
                            <img src="./Images/login_img_username.jpg" />
                            <input type="text" name="username" data-opt='{
                                type : "require",
                                msg : "请输入用户名"
                            }' placeholder="请输入用户名" />
                        </div>
                        <div class="login_password">
                            <img src="./Images/login_img_pwd.jpg" />
                            <input type="password" name="password" data-opt='{
                                type : "require",
                                msg : "请输入密码"
                            }' placeholder="请输入密码" />
                        </div>
                        <div class="login_code">
                            <i><img src="./Images/login_img_code.jpg" /></i>
                            <input type="text" name="code" placeholder="请输入验证码" />
                            <img src="http://www.stroke-academy.com/Admin/Public/makecode.html" class="code_img" onclick="change(this)" />
                            <script>
                                var __url = "http://www.stroke-academy.com/Admin/Public/makecode.html";
                                function change(img){
                                    img.src =  __url +'?t='+ Math.random();
                                }
                            </script>
                        </div>
                        <button type="submit" class="login_bt_submit">登 录</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>