<?php
namespace Home\Model;
use Think\Model\RelationModel;
class EmailModel extends RelationModel{
    //表数据关联
    protected $_link=array(
        'User'=>array(
            'mapping_type'=>self::BELONGS_TO,
            'foreign_key'=>'receive_id',
            'mapping_fields'=>'user_name',
            'as_fields'=>'user_name',
        ),
    );

    //自动完成
    protected $_auto=array(
        array('email_addtime','time',1,'function'),
        array('send_id','getUserId',1,'callback')
    );

    //获取ID
    protected function getUserId(){
        $user=session('user');
        return $user['user_id'];
    }
}


?>