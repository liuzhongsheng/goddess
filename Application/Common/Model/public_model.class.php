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
namespace Common\Model;
use Frame\Model;
class public_model extends Model{
    
    /**
     * 编辑添加页面
     * @author 普罗米修斯 www.php63.cc
     **/
    public function edit()
    {
        $data = $this->create();
        if (empty($data)) {
            return false;
        }
        if (empty($data['id'])) {
            $id = $this->add($data);
            if (!$id) {
                $this->error = '添加操作失败';
                return false;
            }
        } else {
            $res = $this->save($data);
            if ($res === false) {
                $this->error = '更新操作失败';
                return false;
            }
        }
        return $data;
    }
    /**
     * 查询总数
     * @param string $where 查询条件
     * @param string $field 要查询的字段,默认全部
     * @author 刘中胜
     * @return int 总数
     **/
    public function total($where)
    {
        $count = $this -> where($where)->count();
        return $count;
    }

    /**
     * 普通select 查询
     **/
    public function _public_select($where,$field,$order = '',$limit = ''){
        $list = $this -> where($where)->limit($limit)->order($order)->field($field)->select();
        return $list;
    }
}