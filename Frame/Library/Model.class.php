<?php
// +----------------------------------------------------------------------
// | 框架model文件
// +----------------------------------------------------------------------
// | Copyright (c) www.php63.cc All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 普罗米修斯 <996674366@qq.com>
// +----------------------------------------------------------------------
namespace Frame;

use PDO;

class Model
{
    private $db = null;
    private $sql = array(
        'where' => '',
        'field' => '',
        'table' => '',
        'join'  => ''
    );
    private $model = '';
    private $prefix = '';
    public function __construct()
    {

        $table = explode('\\', get_class($this));
        $this -> prefix = load_config('DB_PREFIX');
        // $this->model = load_config('DB_PREFIX') . substr($table[2], 0, strlen($table[2]) - 6);
        $this->model = 'a_test';
        $db_host = load_config('DB_HOST');
        $db_name = load_config('DB_NAME');
        $db_user = load_config('DB_USER');
        $db_pwd = load_config('DB_PWD');
        $db_charset = load_config('DB_CHARSET') ? load_config('DB_CHARSET') : 'utf8';
        try {
            $this->db = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_pwd);
            $this->db->query("SET NAMES {$db_charset}");
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * 查询条件
     * @author 普罗米修斯 www.php63.cc
     **/
    public function where($where)
    {
        if (!is_array($where)) {
            exit('条件错误');
        }
        if (!empty($where)) {
            $str = '';
            $where_str = '';
            /* 拆分组装条件 */
            foreach ($where as $key => &$value) {
                /* 如果为数组则再次检测 **/
                if (is_array($value)) {
                    switch ($value[0]) {
                        /* 如果是in方法查询则组装为in方法查询*/
                        case 'in':
                            $field = $key . ' in(' . $value[1] . ')';
                            $where_str = $str .= $field;
                            break;
                        default:
                            # code...
                            break;
                    }
                } else {
                    /* 如果为字符串则转为字符串格式 否则转换为数字类型*/
                    $value = is_string($value) ? '\'' . $value . '\'' : $value;
                    $str .= '`' . $key . '`' . '=' . $value . ' AND ';
                    $where_str = substr_replace($str, '', (strlen($str) - 5), -1);
                }
            }
        }
        $this->sql['where'] = ' WHERE ' . $where_str;
        return $this;
    }

    /** 要查询的字段 **/
    public function field($field = '*')
    {
        $this->sql['field'] = $field;
        return $this;
    }
    /**
     * 链表查询主表
     * @param $table string 要查询的主表 格式: '__test a'
     * @author 普罗米修斯 www.php63.cc
     **/
    public function table($table = ''){
        if($table != ''){
            //将前面指定字符替换为表前缀
            $this -> sql['table'] = str_replace('__',$this -> prefix,$table);
        }
        return $this;
    }

    /* 链表查询 */
    public function join($join=''){
        if($join != ''){
            //将前面指定字符替换为表前缀
            $this -> sql['join'] = str_replace('__',$this -> prefix,$join);
        }
        return $this;
    }

    /**
     * 查询某个字段或者多个字段
     * @author 普罗米修斯 www.php63.cc
     **/
    public function getField($field, $type = false)
    {
        $table = self::check_join();
        if ($type) {
            $field_data = explode(',', $field);
            $count = count($field_data);
            if ($count == 2) {
                //如果为多个个字段,自动以第一个字段为key第二个字段为value
                if($table == $this ->model){
                    $field_arr[0] = '`' . $field_data[0] . '`';
                    $field_arr[1] = '`' . $field_data[1] . '`';
                }else{
                    $field_arr[0] = $field_data[0];
                    $field_arr[1] = $field_data[1];
                }
                $field = implode(',', $field_arr);
                $sql = 'SELECT ' . $field . ' FROM ' . $table . $this->sql['where'] . ' limit 0,1';
                $datas = $this->query($sql);
                if ($datas) {
                    $datas = $datas->fetch(PDO::FETCH_ASSOC);
                    $field_data[0] = explode('.', $field_data[0]);
                    $field_data[1] = explode('.', $field_data[1]);
                    //普通关联查询待完成
                    if(!empty($field_data[0][1]) || !empty($field_data[1][1])){
                        $field_data[0] = $field_data[0][1];
                        $field_data[1] = $field_data[1][1];
                        $data[$datas[$field_data[0]]] = $datas[$field_data[1]];
                        return $data;
                    }else{
                       $key  = $field_data[0][0];
                       $value  = $field_data[1][0];
                       $data[$datas[$key]] = $datas[$value];
                       return $data;
                    }  
                    
                    
                }
            } else {
                //查询单字段多数据
                $sql = 'SELECT ' . $field . ' FROM ' . $table . $this->sql['where'];
                $datas = $this->query($sql);
                if ($datas) {
                    $datas = $datas->fetchAll(PDO::FETCH_ASSOC);
                    $value = explode('.', $field);
                    if($value){
                        $field = $value[1];
                    }
                    foreach ($datas as $key => $value) {
                        if (!empty($datas)) {
                            $data[] = $value[$field];
                        }
                    }
                }
                $data = array_filter($data);
                return $data;
            }
        } else {
            //查询单个字段单数据
            $sql = 'SELECT ' . $field . ' FROM ' . $table . $this->sql['where'] . ' limit 0,1';
            $data = $this->query($sql);
            if ($data) {
                $data = $data->fetch(PDO::FETCH_ASSOC);
                if (!empty($data)) {
                    //检测是否为join查询如果是则去除前缀
                    $value = explode('.', $field);
                    if($value){
                        $field = $value[1];
                    }
                    $data = $data[$field];
                    return $data;
                }
            }
        }
        
    }

    /**
     * 查询一条数据
     * @author 普罗米修斯 www.php63.cc
     **/
    public function find()
    {
        /* 检测是否指定查询字段,如果没有指定,则为*号 */
        $field = $this->sql['field'] ? $this->sql['field'] : '*';
        $table = self::check_join();
        $sql = 'SELECT ' . $field . ' FROM ' . $table . $this->sql['where'] . ' limit 0,1';
        $data = $this->query($sql);
        if ($data) {
            $data = $data->fetch(PDO::FETCH_ASSOC);
        }
        return $data;
    }



    /**
     * 执行sql
     * @author 普罗米修斯 www.php63.cc
     **/
    public function query($sql)
    {
        $data = $this->db->query($sql);
        self::close();
        return $data;

    }

    /**
     * 关闭数据库连接
     * @author 普罗米修斯 www.php63.cc
     */
    protected function close()
    {
        $this->db->close = null;
    }

    /**
     * 检测是否为join连接
     * @author 普罗米修斯 www.php63.cc
     * @return string 返回表名或者join串
     */
    protected  function check_join(){
        if($this->sql['join'] != '' && $this->sql['table'] != ''){
            $table = $this->sql['table'].' '.$this->sql['join'];
        }else{
            $table = $this->model;
        }
        return $table;
    }

}