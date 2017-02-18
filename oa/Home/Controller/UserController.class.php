<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends CommonController{
    //员工列表
    public function index(){
        $User = D('User'); // 实例化User对象
        $count = $User->count();// 查询满足要求的总记录数
        $Page = new \Think\Page2($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        //对Page类进行配置
        //对分页样式进行配置
        $Page->rollPage = 5;
        $Page->setConfig('header', '<span class="rows">共 %TOTAL_ROW% 个员工</span>');
        $Page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->order('user_id')->relation(true)->limit($Page->firstRow.','.$Page->listRows)->
        select();

        $this->assign('data',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display('showList'); // 输出模板

        /* $data=M('User')->order('user_id')->select();
         foreach ($data as $key=>$val){
         $data[$key]['dept_name']=M('Dept')->field('dept_name')->join('oa_user ON oa_dept.dept_id = oa_user.dept_id')-> where('oa_user.user_id='.$val['user_id'])->find();

         }

         $this->assign('data',$data);
         $this->display('showList');*/
    }

    //添加员工的页面和处理添加员工信息的方法
    public function add(){
        if(IS_POST){
           $user=D('User');
            if($user->create()) {
                if ($user->add()) {
                    //创建数据成功
                    $this->success('添加员工成功', U('index'));
                } else {
                    $this->error('添加员工失败');
                }
            }else{
                //创建数据失败
                $this->error($user->getError());
            }
        }else{
            //显示添加界面
            $dept=M('Dept')->order('dept_sort,dept_id')->select();
            $this->assign('dept',$dept);
            $this->display('add');
        }
    }

}



?>