<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller{
    //显示登录页面
    public function login(){
        $this->display();
    }

    //显示退出界面
    public function logout(){
        session(null);
        $this->success('退出成功',U('Login/login'));
    }

    //处理登录页面的方法
    public function loginCheck(){
        $post=I('post.');
        //判断验证码
        $v = new \Think\Verify();
        if(!$v->check($post['yzm'])){
            $this->error('验证码错误');
        }
        //根据用户名查询密码
        $user=M('user');
        $row=$user->where("user_name='$post[user_name]'")->find();
        if($row){
            if(md5($post['user_pwd'])==$row['user_pwd']){
                //登陆成功
                //记录session TP默认开启session
                session('user',$row);
                //记录用户的id到session
                session(C('USER_AUTH_KEY'),$row['user_id']);
                //超级管理员
                if($row['user_id']==18){
                    //user_id为18的人为超级管理员
                    session(C('ADMIN_AUTH_KEY'),123);
                }
                //记录该用户的权限列表
                \Org\Util\Rbac::saveAccessList();
                $this->success('登陆成功',U('Index/index'));
            }else{
                //登录失败 密码错误
                $this->error('密码错误');
            }
        }else{
            //登录失败 用户名不存在
                $this->error('用户名不存在');
        }

    }
}

?>