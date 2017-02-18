<?php
namespace Home\Controller;
use Think\Controller;
class EmailController extends CommonController{
    //写信
    public function add(){
        if(IS_POST){
            //将用户发送的信件内容存入数据库
            $email=D('Email');
            if($email->create()){
                if ($_FILES['email_file']['name']) {
                    //调用当前类的upload方法
                    $info = $this->upload();
                    $filepath = $info['email_file']['savepath'] . $info['email_file']['savename'];
                    $email->email_file = $filepath;
                    $email->email_truename=$info['email_file']['name'];

                }
                if($email->add()){
                    $this->success('发送成功',U('send'));
                }else{
                    $this->error('发送失败');
                }
            }else{
                $this->error($email->getError());
            }
        }else{
            //取出所有的部门
            $dept=M('Dept');
            $data=$dept->select();
            $data=getTree($data);
            $this->assign('data',$data);
            $this->display();
        }

    }

    //收件箱
    public function receive(){
        $user=session('user');
        $receive_id=$user['user_id'];
        $email=M('email');
        //$send_id=$email->where(array('receive_id'=>$receive_id))->getField('send_id');
        $sql="select e.*,u.user_name from oa_email as e join oa_user as u on e.send_id=u.user_id where e.receive_id=".$receive_id;
        $data=$email->query($sql);
        $this->assign('data',$data);
        $this->display();

    }

    //发件箱
    public function send(){
        $user=session('user');
        $send_id=$user['user_id'];
        $data=D('email')->where(array('send_id'=>$send_id))->relation(true)->select();

        $this->assign('data',$data);
        $this->display();
    }

    //上传方法
    public function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 5*1024*1024 ;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'doc', 'docx', 'pdf', 'ppt','txt');// 设置附件上传类型
        $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath = 'Email/'; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            //$this->success('上传成功！');
            return $info;
        }
    }

    //下载的方法
    public function download(){
        //获取地址栏中的DOC_ID
        $email_id=I('get.id');

        $doc=M('Email');
        $info=$doc->field('email_file,email_truename')->find($email_id);
        $file = "./Public/Uploads/".$info['email_file'];  //下载文件的地址，包括文件名
        header("Content-type: application/octet-stream");  //告诉浏览器要以流的形式返回
        header('Content-Disposition: attachment; filename="' . $info['email_truename'] . '"'); //提示给用户此次下载的文件的名字是什么
        header("Content-Length: ". filesize($file)); //提示给浏览器，此次下载的文件大小是多少
        readfile($file);  //读取文件到输出缓存，下载
    }

    //ajax返回部门下的所有员工
    public function ajax_get_user(){
       $dept_id=I('get.did');
        //通过dept_id取出所有的员工
        $user=M('User');
        $data=$user->where(array('dept_id'=>$dept_id))->select();//二维数组
        /*echo json_encode($data);*/
        $this->ajaxReturn($data);//TP提供的ajax返回数据的方法 默认返回数据的类型是json 还可以指定第二个可选参数为xml
    }

    //查看邮件内容的方法
    public function showEmail(){
        $email_id=I('get.email_id');
        $email=M('Email');
        $data=$email->where(array('email_id'=>$email_id))->find();
        $email->where(array('email_id'=>$email_id))->save(array('is_read'=>1));
        $this->assign('data',$data);
        $this->display();
    }

    //提醒即时邮件
    public function checkEmail(){
        $user=session('user');
        $where['receive_id']=$user['user_id'];
        $where['is_read']=0;
        $count=M('Email')->where($where)->count();
        echo $count;    //因为用ajax方法获取text 所以直接输出即可
    }
}

?>