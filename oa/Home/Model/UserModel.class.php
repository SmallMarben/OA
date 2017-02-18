<?php
namespace Home\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel{
   //定义关联关系(关联模型)
    //当前的关联关系定义在User模型中，所以站在用户的角度看，用户应该是属于部门，所以应该是belogns to 一对多的关系
    protected $_link=array(
        //一张表对应一个数组
        'Dept'=>array(
            'mapping_type'=>self::BELONGS_TO,//指定关联关系
            'foreign_key'=>'dept_id',//指定；两表之间的关联字段，也就是是user表中的外键
            'mapping_fields'=>'dept_name',//关联查询的字段
            'as_fields'=>'dept_name',

        ),
    );


    //定义自定义验证
    protected $_validate=array(
        array('user_name','require','员工姓名必填'),
        array('user_pwd','require','登录密码必填'),
        array('user_age','number','员工年龄必须是数字'),
        array('user_email','email','邮箱格式不正确'),
        array('user_pwd','re_user_pwd','两次密码不一致',0,'confirm'),
    );

    protected $_auto=array(
        array('user_pwd','md5',3,'function'),
        array('user_addtime','time',1,'function'),
    );
}


?>