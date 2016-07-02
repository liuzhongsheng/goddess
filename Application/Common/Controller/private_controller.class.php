<?php
// +----------------------------------------------------------------------
// | 文件说明:
// +----------------------------------------------------------------------
// | Copyright (c) www.php63.cc All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 普罗米修斯 <996674366@qq.com>
// +----------------------------------------------------------------------
namespace Common\Controller;
class private_controller extends public_controller{
    /** 初始化model **/
    public $model = null;
    public function __construct()
    {
        self::header();
        self::leftMenu();
    }

    /** 顶部菜单 **/
    protected function header(){
        $head_menu_data = array(
            array('id' => 1, 'title' => '后台管理', 'url' => 'Admin/index','module' => 'Admin'),
            array('id' => 2, 'title' => '微信管理', 'url' => 'Home/wx','module' => 'Home'),
        );
        if(count($head_menu_data) > 1){
            $this -> assign('head_menu',$head_menu_data);
        }
    }
    /** 左边菜单 */
    protected function leftMenu(){
        $left_menu_data = array(
            array('id' => 1, 'title' => '系统管理', 'url' => 'system/index','content' => 'system'),
            array('id' => 2, 'title' => '站点配置', 'url' => 'Home/wx','action' => 'Home')
        );
        $this -> assign('left_menu',$left_menu_data);
    }
    /* 检测权限 */
    /**
     * 检测权限
     * @param string $url  需要检测的url地址
     * @author 普罗米修斯 www.php63.cc
     * @return bool 有权限返回true 无权限返回false
     **/
    protected function _check_rule($url){
        return true;
    }

    /**
     * 公用添加方法
     * @param $url Sting 跳转地址
     **/
    protected function _public_add($url = ''){
        $model = $this -> model;
        //开启token验证
        self::check_token();
        $data  = $model -> edit();
        if($data){
            //删除token
            del_token();
            $this -> ajaxSuccess($data['id'] ? '更新成功' : '添加成功', Url($url));
        }else{
            $this -> ajaxError($model -> getError());
        }
    }

    /**
     * 公用查询一条数据的方法
     * @param $where array 要查询的条件
     * @param $type int 为0时直接渲染到页面 为1时返回查询到的数组
     **/
    protected function _public_find($where = array('status'=>1), $type = 0){
        $info = $model -> where($where)->find();
        if($type == 1){
            return $info;
        }else{
            $this -> assign('info',$info);
        }
    }

    /**
     * 查询单标总条数
     * @param array $where 查询的条件
     * @param int $type 类型 :type =1 分页用 type=2普通查询
     * @return mixed
     * @author 刘中胜  <996674366@qq.com>
     */
    protected function _public_count($where = array('status'=>1), $type = 1,$num='')
    {

        $model = $this->model;
        $count =  $model -> total($where);
        if($type == 1){
            if($num == ''){
                $num = load_config('PAGENUM');
            }
            $Page = self::_page($count,$num);
            return $Page;
        }else{
            return $count;
        }
    }

    /**
     * 分类列表
     * @param string $model 要操作的表
     * @param string $cache 缓存名称
     * @author 刘中胜
     * @time 2016-01-21
     **/
    public function _public_list($model, $title, $sort='',$cache='')
    {

        $this->model = model($model);
        $where = array(
            'status' => 1
        );
        $list = $this->model->_public_select($where, '*',$sort);
        if(!$list){
            $list = array();
        }
        $arr = array(
            'id'       => 0,
            'pid'      => null,
            'title'    => $title,
            'isParent' => true,
            'open'     => true,
        );
        array_unshift($list, $arr);
        $list = json_encode($list);
        $this->assign('list', $list);
    }

   /**
     * _button 控制分类页面添加按钮是否显示
     * @param string $title 弹出框标题
     * @param string $url 跳转地址
     * @param int $type 跳转类型: 1为弹出层 2为新窗口打开
     * @author 刘中胜
     * @time 2015-15-05
     **/
    protected function _button($but = array())
    {
        $dataArr = array();
        foreach ($but as $Key => $value) {
            if(self::_check_rule($value['url'])){
                if(!empty($value['parameter'])){
                    $url = Url($value['url'],$value['parameter']);
                }else{
                    $url = Url($value['url']);
                }
                $title = $value['title'];
                if($value['type'] == 1){
                    $href = 'JavaScript:;';
                    $target = 'popDialog';
                    $dataOpt = "{title:'" . "$title',url:'" . "$url'" . '}';
                }else{
                    $href = $url;
                    $target = '';
                    $dataOpt = '';
                }
                $dataArr[] = array(
                    'href'    => $href,
                    'target'  => $target,
                    'dataopt' => array(
                        'data-opt' => $dataOpt,
                        'content'  => $value['name']
                    )
                );
            }
        }
        $this->assign('editTag', $dataArr);
    }

    /**
     * page 分页
     * @param int $count 总条数
     * @param int $num 展示条数
     * @return array 返回组装好的结果
     * @author 刘中胜
     * @time 2015-15-05
     **/
    protected function _page($count, $num)
    {
        $showPageNum = 10;
        $totalPage = ceil($count / $num);
        $currentPage = I('post','currentPage', 1, 'intval');
        $searchValue = I('post','searchValue');
        if($currentPage > $totalPage){
            $currentPage = $totalPage;
        }
        if($currentPage < 1){
            $currentPage = 1;
        }
        $list = array(
            'pageNum'     => $num,
            'showPageNum' => $showPageNum,
            'currentPage' => $currentPage,
            'totalPage'   => $totalPage,
            'limit'       => ($currentPage - 1) * $num . "," . $num,
            'searchValue' => $searchValue,
            'pageUrl'     => ''
        );
        return $list;
    }
}