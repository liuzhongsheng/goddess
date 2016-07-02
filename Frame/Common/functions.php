<?php
// +----------------------------------------------------------------------
// | 框架核心方法文件
// +----------------------------------------------------------------------
// | Copyright (c) www.php63.cc All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 普罗米修斯 <996674366@qq.com>
// +----------------------------------------------------------------------

/**
 * @author 普罗米修斯 www.php63.cc
 * @param $file 要加载的文件
 * @return mixed 返回对象
 */
function load_file($file){
    return require $file;
}
/**
 * 加载配置信息
 * @author 普修米洛斯 www.php63.cc
 * @param $name 配置名称
 * @return string 配置
 */
function load_config($name)
{
    return $GLOBALS[$name] ? $GLOBALS[$name] : '';
}


/**
 * 自定义打印方法原样输出
 **/
function dump($data){
    echo '<pre>';
    print_r($data);
}

/**
 * 引入model
 **/
function model($table_name){
    $dir = explode('/', $_SERVER['PATH_INFO']);
    if(count($dir) > 1){
        $model_dir = $dir['1'];
    }else{
        $model_dir = load_config('DEFAULT_MODUlE');
    }
    $table_name = strtolower($table_name);
    $url = APP_PATH.$model_dir.'/Model/'.$table_name.'_model'. CLASS_SUFFIX;
    if (!file_exists($url)) {
        exit($url . '模型不存在');
    }
    $table_name = $model_dir.'\\Model\\'.$table_name.'_model';
    return new $table_name;
    
}
/**
 * 生成公用文件目录配置
 * @author 普修米洛斯 www.php63.cc
 */
function define_path()
{
    $config = load_config('DEFAULT_PUBLIC');
    foreach ($config as $key => $value) {
        defined($key) or define($key, $value);
    }
    return;
}

/**
 * @author 普修米洛斯 www.php63.cc
 * @param $url 跳转地址格式为模块/控制器/方法
 * @param array $parameter 参数
 * @return array|string 返回跳转的地址
 */
function Url($url, $parameter = array())
{
    //获取跳转地址
    $url = explode('/', $url);
    if (empty($url)) {
        exit('请传入url地址');
    }
    if (!empty($parameter)) {
        $parameter = '?' . http_build_query($parameter);
    } else {
        $parameter = '';
    }
    $dir = explode('/', $_SERVER['PATH_INFO']);
    if (count($dir) == 1) {
        $dir['1'] = load_config('DEFAULT_MODUlE');
        $dir['2'] = load_config('DEFAULT_CONTROLLER');
    }
    //获取跳转地址的类型
    switch (count($url)) {
        case 1:
            $url = __ROOT__ . '/' . $dir[1] . '/' . $dir[2] . '/' . $url[0] . $parameter;
            break;
        case 2:
            $url = __ROOT__ . '/' . $dir[1] . '/' . $url[0] . '/' . $url[1] . $parameter;
            break;
        case 3:
            $url = __ROOT__ . '/' . $url[0] . '/' . $url[1] . '/' . $url[2] . $parameter;
            break;
        default:
            exit('请传入跳转地址');
            break;
    }
    return $url;
}
/**
 * 请求类型表
 * @author 普修米洛斯 www.php63.cc
 */
function is_post_type()
{
    $data = $_SERVER['REQUEST_METHOD'];
    switch (strtolower($data)) {
        case 'get':
            $get_type = true;
            break;
        case 'post':
            $post_type = true;
            break;
        case 'ajax':
            $ajax_type = true;
            break;
    }
    defined('IS_GET') OR define('IS_GET', $get_type ? true : false);
    defined('IS_POST') OR define('IS_POST', $post_type ? true : false);
    defined('IS_AJAX') OR define('IS_AJAX', $ajax_type ? true : false);
    return;
}
/**
 * 自动验证
 * @author 普修米洛斯 www.php63.cc
 * @param string $str 要验证的字段
 * @param $value 要验证的内容
 * @return bool 成功返回true 失败返回false
 */
function is_input_check($str = '', $value)
{
    $value = trim($value);
    switch (strtolower($str)) {
        //验证是否必填
        case 'require':
            return empty($value) ? false : true;
            break;
        //验证邮箱
        case 'email':
            $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
            return preg_match( $pattern, $value ) ? true : false;
            break;
        //验证电话|手机
        case 'phone':
        case 'tel':
            $isMob="/^1[3-5,7,8]{1}[0-9]{9}$/";
            $isTel="/^([0-9]{3,4}-)?[0-9]{7,8}$/";
            return (!preg_match($isMob,$value) && !preg_match($isTel,$value)) ? false : true;
            break;
        case 'number':
            if(!is_numeric($value)){
                return false;
            }
            return true;
            break;
//        case 'url':
//            break;

    }
    return true;

}
/**
 * @param string $type 过滤类型 post,get
 * @param string $str 要过滤的字段
 * @param string $default 默认值
 * @param string $filter 默认过滤方式
 * @return string 返回处理好的数据
 */
function I($type='post',$str='',$default='', $filter='htmlspecialchars'){
    switch (strtolower($type)) {
        case 'post':
            $str = isset($_POST[$str]) ? $_POST[$str] : $default;
            break;
        case 'get':
            $str = isset($_GET[$str]) ? $_GET[$str] : $default;
            break;
        default:
            # code...
            break;
    }
    $str = call_user_func($filter,$str);
    return addslashes($str);
}

/**
 * 开启token
 * @author 普修米洛斯 www.php63.cc
 * @return string token
 */
function create_token(){
    $obj = new \Frame\Lib\Token();
    return $obj->token();
}

/**
 * @author 普修米洛斯 www.php63.cc
 * @return mixed 删除token
 */
function del_token(){
    $obj = new \Frame\Lib\Token();
    return $obj->_del_token();
}

function url_config(){
    $url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $url = ltrim($url,'/');
    $path_info = !empty($url) ? explode('/', $url) : array(load_config('DEFAULT_MODUlE'), load_config('DEFAULT_CONTROLLER'), load_config('DEFAULT_ARTICLE'));
    defined('MODULE_NAME') or define('MODULE_NAME',$path_info[0]);
    defined('CONTROLLER_NAME') or define('CONTROLLER_NAME',$path_info[1]);
    defined('ARTICLE_NAME') or define('ARTICLE_NAME',$path_info[2]);
}

/**
 * URL重定向
 * @param string $url 重定向的URL地址
 * @param integer $time 重定向的等待时间（秒）
 * @param string $msg 重定向前的提示信息
 * @return void
 */
function redirect($url, $time=0, $msg='') {
    //多行URL地址支持
    $url        = str_replace(array("\n", "\r"), '', $url);
    if (empty($msg))
        $msg    = "系统将在{$time}秒之后自动跳转到{$url}！";
    if (!headers_sent()) {
        // redirect
        if (0 === $time) {
            header('Location: ' . $url);
        } else {
            header("refresh:{$time};url={$url}");
            echo($msg);
        }
        exit();
    } else {
        $str    = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
        if ($time != 0)
            $str .= $msg;
        exit($str);
    }
}

/**
 * @author 普修米洛斯 www.php63.cc
 * @param $file 缓存文件名
 * @param int $time 缓存时间
 */
function check_cache($file, $time = 0){
    if($time == 0){
        $time = load_config('CACHE_TIME');
    }
    if (is_file($file) && (time() - filemtime($file)) < $time) {
        require_once $file;
        exit;
    }
}

/**
 * @author 普修米洛斯 www.php63.cc
 * @param $file 生成静态页面
 */
function create_cache($file){
    file_put_contents($file,ob_get_contents());
}

/**
 * 将对象转为数组
 **/
function objectToArray($e){
    $e=(array)$e;
    foreach($e as $k=>$v){
        if( gettype($v)=='resource' ) return;
        if( gettype($v)=='object' || gettype($v)=='array' )
            $e[$k]=(array)objectToArray($v);
    }
    return $e;
}






