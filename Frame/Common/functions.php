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
 * 设置url默认配置
 **/
function url_config(){
    $url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $url = ltrim($url,'/');
    $path_info = !empty($url) ? explode('/', $url) : array(load_config('DEFAULT_MODUlE'), load_config('DEFAULT_CONTROLLER'), load_config('DEFAULT_ARTICLE'));
    defined('MODULE_NAME') or define('MODULE_NAME',$path_info[0]);
    defined('CONTROLLER_NAME') or define('CONTROLLER_NAME',$path_info[1]);
    defined('ARTICLE_NAME') or define('ARTICLE_NAME',$path_info[2]);
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
        $model_dir = load_config(DEFAULT_MODUlE);
    }
    $table_name = strtolower($table_name);
    $url = APP_PATH.$model_dir.'/Model/'.$table_name.'_model'. CLASS_SUFFIX;
    if (!file_exists($url)) {
        exit($url . '模型不存在');
    }
    $table_name = $model_dir.'\\Model\\'.$table_name.'_model';
    return new $table_name;
    
}








