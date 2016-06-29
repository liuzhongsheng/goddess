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
        'join'  => '',
        'limit' => '',
        'order' => ''
    );
    private $model = '';
    private $prefix = '';
//自动验证
    protected $_auth_check = array();
    //报错信息
    protected $error = '';
    //自动完成
    protected $_auth_complete = array();
    public function __construct()
    {

        $table = explode('\\', get_class($this));
        $this->prefix = load_config('DB_PREFIX');
        $this->model = load_config('DB_PREFIX') . substr($table[2], 0, strlen($table[2]) - 6);
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

    /** 以下为条件处理 **/
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
    public function table($table = '')
    {
        if ($table != '') {
            //将前面指定字符替换为表前缀
            $this->sql['table'] = str_replace('__', $this->prefix, $table);
        }
        return $this;
    }

    /* 链表查询 */
    public function join($join = '')
    {
        if ($join != '') {
            //将前面指定字符替换为表前缀
            $this->sql['join'] = str_replace('__', $this->prefix, $join);
        }
        return $this;
    }

    /* limit 分页参数 */
    public function limit($start_num, $page_num)
    {
        $this->sql['limit'][0] = $start_num;
        $this->sql['limit'][1] = $page_num;
        $this->sql['limit'] = implode(',', $this->sql['limit']);
        return $this;
    }

    /* order 排序 */
    public function order($order)
    {
        $this->sql['order'] = $order;
        return $this;
    }

    /**
     * 检测是否为join连接
     * @author 普罗米修斯 www.php63.cc
     * @return string 返回表名或者join串
     */
    protected function check_join()
    {
        if ($this->sql['join'] != '' && $this->sql['table'] != '') {
            $table = $this->sql['table'] . ' ' . $this->sql['join'];
        } else {
            $table = $this->model;
        }
        return $table;
    }
    /***** 以下为查询操作  ******/
    /**
     * 查询某个字段或者多个字段
     * @author 普罗米修斯 www.php63.cc
     **/
    public function getField($field, $type = false)
    {
        $table = self::check_join();
        $order = self::_ordere();
        if ($type) {
            $field_data = explode(',', $field);
            $count = count($field_data);
            if ($count == 2) {
                //如果为多个个字段,自动以第一个字段为key第二个字段为value
                if ($table == $this->model) {
                    $field_arr[0] = '`' . $field_data[0] . '`';
                    $field_arr[1] = '`' . $field_data[1] . '`';
                } else {
                    $field_arr[0] = $field_data[0];
                    $field_arr[1] = $field_data[1];
                }
                $field = implode(',', $field_arr);
                $sql = 'SELECT ' . $field . ' FROM ' . $table . $this->sql['where'] . $order . ' limit 0,1';
                $datas = $this->query($sql);
                if ($datas) {
                    $datas = $datas->fetch(PDO::FETCH_ASSOC);
                    $field_data[0] = explode('.', $field_data[0]);
                    $field_data[1] = explode('.', $field_data[1]);
                    //普通关联查询待完成
                    if (!empty($field_data[0][1]) || !empty($field_data[1][1])) {
                        $field_data[0] = $field_data[0][1];
                        $field_data[1] = $field_data[1][1];
                        $data[$datas[$field_data[0]]] = $datas[$field_data[1]];
                        return $data;
                    } else {
                        $key = $field_data[0][0];
                        $value = $field_data[1][0];
                        $data[$datas[$key]] = $datas[$value];
                        return $data;
                    }


                }
            } else {
                //查询单字段多数据
                $sql = 'SELECT ' . $field . ' FROM ' . $table . $this->sql['where'] . $order;
                $datas = $this->query($sql);
                if ($datas) {
                    $datas = $datas->fetchAll(PDO::FETCH_ASSOC);
                    $value = explode('.', $field);
                    if ($value) {
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
            $sql = 'SELECT ' . $field . ' FROM ' . $table . $this->sql['where'] . $order . ' limit 0,1';
            $data = $this->query($sql);
            if ($data) {
                $data = $data->fetch(PDO::FETCH_ASSOC);
                if (!empty($data)) {
                    //检测是否为join查询如果是则去除前缀
                    $value = explode('.', $field);
                    if ($value) {
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
        $order = self::_ordere();
        $sql = 'SELECT ' . $field . ' FROM ' . $table . $this->sql['where'] . $order . ' limit 0,1';
        $data = $this->query($sql);
        if ($data) {
            $data = $data->fetch(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    /**
     * 查询多条数据
     **/
    public function select()
    {
        $field = $this->sql['field'] ? $this->sql['field'] : '*';
        $table = self::check_join();
        if (empty($this->sql['limit'])) {
            $limit = '';
        } else {
            $limit = ' limit ' . $this->sql['limit'];
        }
        $order = self::_ordere();
        $sql = 'SELECT ' . $field . ' FROM ' . $table . $this->sql['where'] . $order . $limit;
        $data = $this->query($sql);
        $data = $data->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    /**
     * 查询某个字段是否存在与某个表
     * @author 普修米洛斯 www.php63.cc
     * @param $model 要查询的表
     * @param $fields 要查询的字段
     * @return bool 存在字段返回true
     */
    private function _is_fields($model, $fields)
    {
        $fields = '`'.$fields.'`';
        $test = $this->query("Describe {$model} {$fields}")->fetchAll(PDO::FETCH_ASSOC);
        if (empty($test)) {
            return false;
        }
        return true;
    }
    /***** 以下为修改,添加操作 ******/
    /**
     * 添加数据
     **/
    public function add($data)
    {
        $field = '';
        $values = '';
        foreach ($data as $key => $value) {
            $field .= '`' . $key . '`,';
            if (is_string($value)) {
                $values .= '\'' . $value . '\',';
            } else {
                $values .= $value . ',';
            }
        }
        $sql = "insert into " . $this->model . " ( " . substr($field, 0, -1) . ") values (" . substr($values, 0, -1) . ")";
      
        $this->query($sql);
        return $this->db->lastInsertId();
    }

    /** 以下为其他设置 **/
    /**
     * 执行sql
     * @author 普罗米修斯 www.php63.cc
     **/
    public function query($sql)
    {
        $data = $this->db->query($sql);
        if (!$data) {
            try {
                $error = $this->db->errorInfo();
                throw new \Exception($error[2]);
            } catch (Exception $e) {
                print $e->getMessage($error[2]);
                die();
            }
        }
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
     * 排序设置
     * 普罗米修斯 www.php63.cc
     * @return string $order 如果为空返回空 否则返回排序字符串
     **/
    protected function _ordere()
    {
        if (empty($this->sql['order'])) {
            $order = '';
        } else {
            $order = ' ORDER BY ' . $this->sql['order'];
        }
        return $order;
    }
        /**
     * @author 普修米洛斯 www.php63.cc
     * @param string $str
     * @param int $type 自动检测结构
     */
    public function create($str = '$_POST', $type = 1)
    {
        if ($str == '$_POST') {
            $data_post = $_POST;
        }
        $data = array();
        foreach ($data_post as $key => $value) {
            if (self::_is_fields($this->model, $key)) {
                $data[$key] = strtolower($value);
            }
        }
        $data__auth_complete = self::input_auth_complete();
        $data = array_merge($data, $data__auth_complete);
        $is_result = $this->_auth_check_from($data);
        if ($is_result === false) {
            $data = false;
        }
        return $data;
    }

        /**
     * @author 普修米洛斯 www.php63.cc
     * @param array $data
     * @return bool 失败返回false
     */
    protected function _auth_check_from($data = array())
    {
//        array(字段,验证方法,提示,验证时间)
        $data_arr = $this->_auth_check;
        foreach ($data_arr as $key => $value) {
            foreach ($data as $k => $v) {
                if (in_array($k, $value)) {
                    if (is_input_check($value['1'], $v) === false) {
                        $this->error = $value[2];
                        return false;
                    }
                }
            }
        }
    }

        /**
     * @author 普修米洛斯 www.php63.cc
     * @return array 自动完成组装的数组
     */
    protected function input_auth_complete()
    {
        $data = $this->_auth_complete;
        $data_result = array();
        foreach ($data as $key => $value) {
            if (self::_is_fields($this->model, $value)) {
                $data_result[$value[0]] = input_auth_complete($value[1]);
            }

        }
        return $data_result;
    }

    /**
     * 获取错误信息
     * @author 普修米洛斯 www.php63.cc
     * @return string 返回错误信息
     */
    public function getError()
    {
        return $this->error;
    }

}