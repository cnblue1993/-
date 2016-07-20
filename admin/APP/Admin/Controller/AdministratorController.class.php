<?php
namespace Admin\Controller;
use Think\Controller;
class AdministratorController extends Controller {
    public function index(){
        $admin=M('admin')->select();
        $this->assign('admin',$admin);
        $this->display();
    }
    public function showadd(){
    	$this->display();
    }
    public function add(){
        if($_POST['submit'])
        {
            $condition=array('a_name'=>$_POST['username']);
            if(M('admin')->where($condition)->select())
                $this->error('该用户名已存在！');
            $data=array(
                'a_name'=>$_POST['username'],
                'a_pwd'=>I('pwd','','md5'),
                'a_authority'=>$_POST['authority']=='高级管理员'?0:1
            );
            //dump($data);
            $result=M('admin')->add($data);
            if($result)
                $this->success('添加管理员成功！',U('Admin/Administrator/index'));
            else
                $this->error('添加管理员失败！');
        }
		
    }
    public function showmodify(){
        $_GET['id']=$_GET['id']==NULL?$_SESSION['id']:$_GET['id'];
        //dump($_GET['id']);
    	$name=M('admin')->where('a_id='.$_GET['id'])->getField('a_name');
        $this->assign('name',$name);
        $this->assign('a_id',$_GET['id']);
        $this->display();
    }
    public function modify()
        {
            $p=M('admin')->where('a_id='.$_POST['a_id'])->getField('a_pwd');
            $oldpwd=I('oldpwd','','md5');
            if($oldpwd!=$p)
                $this->error('原密码错误，请重新输入！');
            if($_POST['submit'])
            {
                if($_POST['name']!='')
                    $data['a_name']=$_POST['name'];
                if($_POST['pwd']!='')
                    $data['a_pwd']=I('pwd','','md5');
                M('admin')->where('a_id='.$_POST['a_id'])->setfield($data);

                if($data)
                    $this->success('修改管理员成功！',U('Admin/Administrator/index'));
                else
                    $this->error('修改管理员失败！');
            }

        }
    public function del(){
    	M('admin')->delete($_GET['a_id']);
        $result=M('admin')->where('a_id='.$_GET['a_id'])->select();
        if($result)
            $this->error('删除管理员失败！',U('Admin/Administrator/index'));
        else
            $this->success('删除管理员成功！',U('Admin/Administrator/index'));
    }
}