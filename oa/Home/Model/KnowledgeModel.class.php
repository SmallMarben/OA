<?php
namespace Home\Model;
use Think\Model\RelationModel;
class KnowledgeModel extends RelationModel{
    protected $_link=array(
        'User'=>array(
            'mapping_type'=>self::BELONGS_TO,
            'foreign_key'=>'user_id',
            'mapping_fields'=>'user_name',
            'as_fields'=>'user_name',
        ),
    );

    protected $_auto=array(
        array('kl_addtime','time',1,'function'),
        array('user_id','getUserId',1,'callback'),
    );

    protected function getUserId(){
        $user=session('user');
        return $user['user_id'];
    }
}


?>