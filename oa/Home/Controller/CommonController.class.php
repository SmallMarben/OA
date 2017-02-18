<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{
    public function _initialize()
    {
        if(!session('?user')){
            $this->error('请登录',U('Login/login'));
            //parent.location.replace('绝对路径地址');
        }
        //当用户没有当前操作的权限时提示无权访问的操作
        if(\Org\Util\Rbac::AccessDecision()===false){
            $this->error('无权访问');
        }
    }
}

?>