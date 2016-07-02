<?php
/**
 * Created by Ezos
 * User: 普修米洛斯 www.php63.cc
 * Date: 16/4/12
 * Time: 13:51
 */
namespace Frame\Lib;

class Token
{
    public function token(){
        return $_SESSION['_token'] = $this ->_token();
    }
    //创建token
    public static function _token()
    {
        return md5(time() . mt_rand(1, 99999).session_id());
    }

//    //检测token
    public function check_token()
    {
        $session_token = $_SESSION['_token'];
        if ($this->token_str !== $session_token) {
            return false;
        }
        return true;
    }

//    //删除token
    public function _del_token()
    {
        return session_unset($_SESSION['_token']);
    }

}