<?php
namespace Home\Model;
use Think\Model\RelationModel;
class DocModel extends RelationModel{
    //数据关联
    protected $_link=array(
        'User'=>array(
            'mapping_type'=>self::BELONGS_TO,
            'foreign_key'=>'user_id',
            'mapping_fields'=>'user_name',
            'as_fields'=>'user_name',
        ),
    );



    //自动完成
    protected $_auto=array(
        array('doc_addtime','time',1,'function'),
        array('user_id','getUserId',1,'callback')
    );

    protected  function getUserId(){
        return $_SESSION['user']['user_id'];
    }
}

?>