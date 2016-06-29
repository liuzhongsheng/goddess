<?php
namespace Admin\Model;
class system_group_model extends \Common\Model\public_model{
    protected $_auth_check = array(
        array('title', 'require', '标题必须填写'),
        array('sort', 'require', '排序必须填写'),
        array('sort', 'number', '排序只能为数字'),
    );

}