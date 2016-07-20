<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        //echo "login";
        $this->display(login);
    }
    public function login(){
    	//dump($_POST);
    	if(!isset($_POST['submit']))
    		exit('非法访问!');
       	$db=M('admin');
       	$admin=$db->where(array('a_name'=>I('username')))->find();
        
       	if(!$admin||$admin['a_pwd']!=I('password','','md5'))
        {            
       		$this->error('账号或密码错误');
        }
       		
          //更新最后一次登录时间
        $data=array(
            'a_id'=>$admin['a_id'],
            'a_logintime'=>date("Y-m-d H:i:s")
        );
        $db->save($data);
        session('id',$admin['a_id']);
        session('username',$admin['a_name']); 
        redirect(U('Index/index'));
    }
}