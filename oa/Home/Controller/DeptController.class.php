<?php
namespace Home\Controller;
use Think\Controller;
class DeptController extends CommonController{
   //添加部门的方法
    public function add(){
        if(IS_POST){
            //如果有post提交 说明添加处理
            //使用$_POST获取数据并不能将用户输入的标签转化成实体，TP中提供了一个获取数据的方法 I方法                  这个方法可以获取所有的数据 比如post数据，get数据还有cookie等
            $post=I('post.');//获取post提交的所有数据
            $dept=M('Dept');
            if($dept->add($post)){
                $this->success('添加部门成功',U('index'));//添加成功跳转到部门列表页面
            }else{
                $this->error('添加失败');//添加失败默认跳转上一页面
            }
        }else {
            //显示添加页面
            //获取所有的部门分配到添加页面的select>option 位置
            $data=M('Dept')->order('dept_sort')->select();
            $this->assign('data',$data);
            $this->display('add');
        }
    }

    //显示部门列表
    public function index(){
        $dept = M('Dept');
        $data = $dept->order('dept_sort')->select();
        //将dept_pid转化成部门名称，如果dept_pid的值为0，则表示顶级部门
        foreach($data as $key=>$value){
            if($value['dept_pid'] == 0){
                $data[$key]['deptName'] = '顶级部门';
            }else{
                $data[$key]['deptName'] = $dept->where('dept_id='.$value['dept_pid'])->getField('dept_name');
            }
        }
        $data = getTree($data);
        //dump($data);
        $this->assign('data', $data);
        $this->display('showList');
    }

    //显示公文图表
    public function tongji(){
        $sql="select dept_name,count(*) as count from oa_user,oa_dept where oa_user.dept_id=oa_dept.dept_id group by oa_user.dept_id";
        $data=M()->query($sql);
        $str = "[";
        foreach($data as $value) {
            $str .= "['" . $value['dept_name'] . "'," . $value['count'] . "],";
        }
        $str=rtrim($str,',').']';
        $this->assign('str',$str);
        $this->display();
    }
}


?>