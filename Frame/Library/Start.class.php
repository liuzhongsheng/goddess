<?php
// +----------------------------------------------------------------------
// | 框架核心启动文件
// +----------------------------------------------------------------------
// | Copyright (c) www.php63.cc All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 普罗米修斯 <996674366@qq.com>
// +----------------------------------------------------------------------
namespace Frame;
class Start
{
    /**
     * 启动方法
     * 调用框架需要默认加载的方法
     * @author 普罗米修斯 www.php63.cc
     **/
    public function Start()
    {
        //加载系统配置文件
        self::_load_system_file();
        //加载系统配置
        $this->_function();
        /* 自动加载 */
        spl_autoload_register(array($this, 'autoload'));
        //加载路由配置
        $this->parse();
    }

    /**
     * 加载系统文件
     * 加载系统继承配置文件
     * @author 普罗米修斯 www.php63.cc
     **/
    protected function _load_system_file()
    {
        /* 加载系统核心函数文件 */
        require_once SYSTEM_FUNC . 'functions.php';
        /* 加载自定义公共函数文件 */
        $function_file = PUBLIC_FUNC . 'function.php';
        if (is_file($function_file)) {
            load_file($function_file);
        }
        $config_file = SYSTEM_FUNC . 'config.php';
        $GLOBALS = load_file($config_file);
        /* 加载自定义公共配置文件 */
        $config_file = PUBLIC_FUNC . 'config.php';
        if (is_file($config_file)) {
            $config2 = load_file($config_file);
            $GLOBALS = array_merge($GLOBALS, $config2);
        }
    }

    /**
     * 自动加载
     * @author 普修米洛斯 www.php63.cc
     * @param $class_name
     */
    public function autoload($class_name)
    {
        $dir = explode('\\', $class_name);
        $count = count($dir);
        if (($dir[0] . '\\' . $dir[1]) == 'Frame\Lib') {
            $url = LIB_PATH . $dir[1] . '/' . $dir[2] . CLASS_SUFFIX;
        } elseif ($count == 2) {
            if ($dir[0] == 'Frame') {
                $url = LIB_PATH . $dir[1] . CLASS_SUFFIX;
            }
            //     if($class_name == 'System\PDO'){
            //         return ;
            //     }
            // }else{
            //     if($dir[0].'\\'.$dir[1]){
            //         $url =  APP_PATH.implode('/',$dir).CLASS_SUFFIX;
            //     }
        }
        if (file_exists($url)) {
            require_once $url;
        } else {
            exit($url . '加载失败');
        }

    }

    public function parse()
    {
        $include_path = get_include_path();
        $include_path .= PATH_SEPARATOR . APP_PATH . MODULE_NAME . "/Controller/";
        set_include_path($include_path);
        $name = MODULE_NAME . '\\Controller\\' . CONTROLLER_NAME . '_controller';
        require_once CONTROLLER_NAME . '_controller' . CLASS_SUFFIX;
        $file_name = ARTICLE_NAME;
        $obj = new $name;
        $obj->$file_name();
    }

    /**
     * 加载自定义配置项
     * @author 普罗米修斯 www.php63.cc
     */
    private function _function()
    {
        // define_path();
        // //检测请求类型
        // is_post_type();
        url_config();
    }
}