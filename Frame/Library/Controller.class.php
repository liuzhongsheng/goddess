<?php
namespace Frame;
class Controller{
     protected $data = array();

    public function __construct()
    {

    }

    /**
     * 输出模板
     * @author 普修米洛斯 www.php63.cc
     * @param string $file 视图名称
     * 格式:  目录@方法(Public@login)  方法(index) 默认为当前方法
     */
    public function display($file = '')
    {

        extract($this->data);
        $dir = explode('/', $_SERVER['PATH_INFO']);
        if (count($dir) == 1) {
            $dir['1'] = MODULE_NAME;
            $dir['2'] = CONTROLLER_NAME;
        }
        if ($file == '') {
            if(empty(strtolower($dir['3']))){
                $dir['3']= 'index';
            }
            $url = APP_PATH . ucfirst(strtolower($dir['1'])) . '/View/' . ucfirst(strtolower($dir['2'])) . '/' . strtolower($dir['3']) . '.php';
        } else {

            $dirName = explode('@', $file);
            $isDir = count($dirName);
            if ($isDir == 2) {
                 $url = $dirName[0].$dirName[1].'.php';
                //$url = APP_PATH . ucfirst(strtolower($dir['1'])) . '/View/' . ucfirst(strtolower($dirName['0'])) . '/' . strtolower($dirName['1']);
            } else {
                $url = APP_PATH . ucfirst(strtolower($dir['1'])) . '/View/' . ucfirst(strtolower($dir['2'])) . '/' . $file;
            }
        }
        $html =  APP_PATH . ucfirst(strtolower($dir['1'])) . '/View/';
        defined('HTML_PATH') or define('HTML_PATH',$html);
        if (!file_exists($url)) {
            exit($url . '不存在');
        }
        include $url;
        exit;
    }

    /**
     * @author 普修米洛斯 www.php63.cc
     * @param $key 要输出的变量名
     * @param $value 值
     */
    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }


    /**
     * @author 普修米洛斯 www.php63.cc
     * @param $message
     * @param string 返回json数据
     */
    protected function ajaxSuccess($message, $url = '')
    {
        $array = array(
            'statusCode' => 200,
            'message'    => $message,
            'url'        => $url
        );
        die(json_encode($array));
    }
    protected function ajaxError($message, $url=''){
        $array = array(
            'statusCode' => 300,
            'message'    => $message,
            'url'        => $url
        );
        die(json_encode($array));
    }

        /**
     * @author 普修米洛斯 www.php63.cc
     * @param string $msg 提示消息
     * @param string $url 跳转地址
     * @return bool 成功返回true 失败返回提示消息
     */
    protected function check_token($msg = '请不要重复提交', $url = ''){
        $token = I('post','_token','');
        if($token !== $_SESSION['_token']){
            $this -> ajax_error('请不要重复提交');
        }
        return true;
    }

    /**
     * Action跳转(URL重定向） 支持指定模块和延时跳转
     * @access protected
     * @param string $url 跳转的URL表达式
     * @param array $params 其它URL参数
     * @param integer $delay 延时跳转的时间 单位为秒
     * @param string $msg 跳转提示信息
     * @return void
     */
    protected function redirect($url,$params=array(),$delay=0,$msg='') {
        $url    =   Url($url,$params);
        redirect($url,$delay,$msg);
    }
}