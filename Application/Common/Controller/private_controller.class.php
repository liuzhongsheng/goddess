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


}