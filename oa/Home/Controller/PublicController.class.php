<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller{
    public function verify(){
        $config=array(
            'fontSize'=>'25',
            'length'=>4,
            'useCurve'=>true,
            'fontttf'=>'5.ttf',
        );
        $v=new \Think\Verify($config);
        $v->entry();
    }
}

?>