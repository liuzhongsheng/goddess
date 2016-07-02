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
        $this->model = model('system_group');
        $but = array(
            array(
                'url'   => 'group_edit',
                'name'  => '添 加',
                'title' => '添加管理分组',
                'type'  => 1
            ),
        );
        self::_button($but);
        //计算总数
        self::_public_count();
        $where = array(
            'status' => 1
        );
        $list = $this->model->_public_select($where, '*','sort DESC');
        $this->assign('list', $list);
        $this -> display();
    }

    /**
     * 添加编辑管理分组
     * @author
     **/
    public function group_edit(){
        $this -> model = model('system_group');
        if(IS_POST){
            self::_public_add('group_list');
        }
        //创建token
        create_token();
        $id = I('get','id',0,'intval');
        if($id != 0){
            $where = array(
                'status' => 1,
                'id'     => $id
            );
            self::_public_find($where);
        }
        $this->display();
    }

    /** 权限规则列表 */
    public function rules()
    {
        self::_public_list('system_rules','权限管理', $sort='sort DESC');
        $this -> display();
    }

    /** 权限规则详情 **/
    public function rules_info(){
        $this->model = model('system_rules');
        $id = I('get','id', 0, 'intval');
        if($id != 0){
            $where = array(
                'id'    => $id,
                'statu' => 1
            );
            $info = self::_public_find($where, 2);
        }else{
            $info['id'] = 0;
        }

        if(self::_check_rule('authedit') && $info['level'] != 2){
             $info['butadd'] = self::_catebut('authedit', '添加权限', $info['id']);
        }
        if(self::_check_rule('authdel')){
            $info['butdel'] = self::_catebut('authdel', '删除权限', $info['id'], '您确认要删除该权限吗?', 2);
        }
        $this->assign('info', $info);
        $this->display();
    }
}