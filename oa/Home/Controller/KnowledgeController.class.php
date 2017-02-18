<?php
namespace Home\Controller;
use Think\Controller;
class KnowledgeController extends CommonController{
    //添加
    public function add(){
        if(IS_POST){
           $kl=D('Knowledge');
            if ($kl->create()) {
                //检测是否有附件上传
                if ($_FILES['kl_file']['name']) {
                    //调用当前类的upload方法
                    $info = $this->upload(array('txt','doc','docx','xls','xlsx'));
                    $filepath = $info['kl_file']['savepath'] . $info['kl_file']['savename'];
                    $kl->kl_filepath = $filepath;
                    $kl->kl_truename=$info['kl_file']['name'];


                }
                //检测是否有图片上传
                if ($_FILES['kl_pic']['name']) {
                    //调用当前类的upload方法
                    $pic = $this->upload(array('jpg','jpeg','bmp','gif','png'));
                    $filename = $pic['kl_pic']['savepath'] . $pic['kl_pic']['savename'];
                    $kl->kl_pic = $filename;

                    //对上传的图片进行缩略图处理
                    $basepath='./Public/Uploads/'.$filename;//要进行缩略的图片
                    $image=new \Think\Image();//实例化Image类进行缩略图操作
                    $savepath='./Public/Uploads/'.$pic['kl_pic']['savepath'].'thumb_'.$pic['kl_pic']['savename'];
                    $image->open($basepath)->thumb(100,100)->save($savepath);
                }
                if ($kl->add()) {
                    $this->success('添加成功', U('index'));
                } else {
                    $this->error('添加失败');
                }
            } else {
                $this->error($kl->getError());
            }
        } else {
            $this->display();
        }
    }

    //知识列表显示
    public function index(){
            $kl=D('Knowledge');
            $data=$kl->relation(true)->order('kl_addtime asc')->select();
            $this->assign('data',$data);
            $this->display('showList');

    }

    //上传方法
    public function upload($ext=array()){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 5*1024*1024 ;// 设置附件上传大小
        $upload->exts = $ext;// 设置附件上传类型
        $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
        $upload->savePath = 'Knowledge/'; // 设置附件上传（子）目录
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
        $doc_id=I('get.id');

        $doc=M('Knowledge');
        $info=$doc->field('kl_filepath,kl_truename')->find($doc_id);
        $file = "./Public/Uploads/".$info['kl_filepath'];  //下载文件的地址，包括文件名
        header("Content-type: application/octet-stream");  //告诉浏览器要以流的形式返回
        header('Content-Disposition: attachment; filename="' . $info['kl_truename'] . '"'); //提示给用户此次下载的文件的名字是什么
        header("Content-Length: ". filesize($file)); //提示给浏览器，此次下载的文件大小是多少
        readfile($file);  //读取文件到输出缓存，下载
    }

    //查看知识内容
    public function showkl(){
        $id=I('get.kl_id');
        $kl=M('Knowledge');
        $content=$kl->where(array('kl_id'=>$id))->getField('kl_content');
        $this->assign('content',$content);
        $this->display();
    }
}


?>