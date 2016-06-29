<?php
namespace Home\Controller;
use Frame\Controller;
// use Frame\Model;

class index_controller extends Controller{
    public function index(){
        $model = model('test');
        $this -> assign('info',12);
        $this -> display();
       //$obj = new Model();
       /**
        * where 查询条件,只能接受数组
        * find 查询一条数据
        * getField 查询单个字段 1.参数1里面只有一个字段时,如果参数二为false或者空,返回单个字段的值,如果参数2为true则为一维数组,参数1里面可以接受2字段,第一个字段读取后会变为key,第二个字段会变为value
        * join 连接相关说明
        * table join连接的主表格式: table('__test a') 前面以两个_开头固定格式 a为别名
        * join 连接串
        * select 查询多条数据
        * limit 分页显示条数设置
        * order 排序
        **/
       // $where = array(
            /* 如果要用in方法查询则使用方法如下*/
            //'id'    => array('in','1,2')
        //     'title' => '测试',
        //     'desc'  => 'test'
        // );
       //查询一条数据(完成)
       // $data = $obj ->order('id DESC')->where($where)->find();

        //查询一个字段或者多个字段(完成)
       // $datas = $obj->where($where)->getField('title,id',true);

        //join 方式查询完成
         // $data = $obj
         //     -> table('__test a')
         //     -> join('LEFT JOIN __test_one b ON a.id=b.cid')
         //     -> getField('b.title,a.desc',true);
        
        //查询多条数据(完成)
        //$data = $obj->order('id desc')->limit(0,1)->select();
        //插入语句插入成功后返回受影响的id
        
        // $data = $obj -> add($where);
        // dump($data);
    }
}