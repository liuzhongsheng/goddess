<?php
// +----------------------------------------------------------------------
// | 文件说明: 系统管理: 系统分组 系统用户 权限
// +----------------------------------------------------------------------
// | Copyright (c) www.php63.cc All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 普罗米修斯 <996674366@qq.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
class system_controller extends base_controller{
    /**
     * 系统分组列表
     **/
    public function group_list(){
        $but = array(
            array(
                'url'   => 'group_edit',
                'name'  => '添 加',
                'title' => '添加管理分组',
                'type'  => 1
            ),
        );
        self::_button($but);
        $this -> display();
    }

    /**
     * 添加编辑管理分组
     * @author
     **/
    public function group_edit(){
        $model = model('system_group');
        if(IS_POST){
            $data  = $model -> edit();
            if($data){
                $this -> ajaxSuccess($data['id'] ? '更新成功' : '添加成功', Url('group_list'));
            }else{
                $this -> ajaxError($model -> getError());
            }
        }
        $id = I('get','id',0,'intval');
        if($id != 0){
            $where = array(
                'status' => 1,
                'id'     => $id
            );
            $info = $model -> where($where)->find();
            $this -> assign('info',$info);
        }
        $this->display();
    }
}