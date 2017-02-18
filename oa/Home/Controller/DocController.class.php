<?php
namespace Home\Controller;
use Think\Controller;
class DocController extends CommonController
{
    //显示添加模板
    public function add()
    {
        if (IS_POST) {
            $doc = D('Doc');
            if ($doc->create()) {
                if ($_FILES['doc_file']['name']) {
                    //调用当前类的upload方法
                    $info = $this->upload();
                    $filepath = $info['doc_file']['savepath'] . $info['doc_file']['savename'];
                    $doc->doc_filepath = $filepath;
                    $doc->doc_truename=$info['doc_file']['name'];
                    $doc->doc_isfile = 1;

                }
                if ($doc->add()) {
                    $this->success('添加成功', U('index'));
                } else {
                    $this->error('添加失败');
                }
            } else {
                $this->error($doc->getError());
            }
        } else {
            $this->display();
        }
    }

    //显示公文管理模板
    public function index()
    {
        $doc=D('Doc');
        $data=$doc->order('doc_addtime desc')->relation(true)->select();
        $this->assign('data',$data);
        $this->display('showList');
    }

    //上传方法
    public function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 5*1024*1024 ;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'doc', 'docx', 'pdf', 'ppt');// 设置附件上传类型
        $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
        //$upload->savePath = ''; // 设置附件上传（子）目录
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

        $doc=M('Doc');
        $info=$doc->field('doc_filepath,doc_truename')->find($doc_id);
        $file = "./Public/Uploads/".$info['doc_filepath'];  //下载文件的地址，包括文件名
        header("Content-type: application/octet-stream");  //告诉浏览器要以流的形式返回
        header('Content-Disposition: attachment; filename="' . $info['doc_truename'] . '"'); //提示给用户此次下载的文件的名字是什么
        header("Content-Length: ". filesize($file)); //提示给浏览器，此次下载的文件大小是多少
        readfile($file);  //读取文件到输出缓存，下载
    }
}
?>