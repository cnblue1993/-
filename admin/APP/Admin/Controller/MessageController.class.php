<?php
namespace Admin\Controller;
use Think\Controller;
class MessageController extends Controller {
    public function index(){
        $picture=M('message')->where('m_type=0')->order('m_title')->select();
        $this->assign('picture',$picture);
        $message1=M('message')->where('m_type=1')->order('m_date')->select();
        $this->assign('message1',$message1);
        $message2=M('message')->where('m_type=2')->order('m_date')->select();
        $this->assign('message2',$message2);
    	$this->display();
    }
    public function showadd(){
        $message1=M('message')->where('m_type=1')->order('m_date')->select();
        $this->assign('message1',$message1);
        $message2=M('message')->where('m_type=2')->order('m_date')->select();
        $this->assign('message2',$message2);
        $this->display();
    }
    public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }
    public function add(){
        $data=array(
                'm_type'=>$_POST['type'],
                'm_title'=>$_POST['title'],
                'm_content'=>$_POST['editorValue'],
                'm_date'=>date("Y-m-d H:i:s"),
                'm_admin'=>$_SESSION['username']
                );
        $result=M('message')->add($data);
        if($result)
            $this->success('消息添加成功！',U('Admin/Message/index'));
        else
            $this->error('消息添加失败！');
    }
    public function showmessage($m_id){
        $message=M('message')->where('m_id='.(int)$m_id)->find();
        $this->assign('message',$message);
        $this->display();
    }
    public function addpage(){
        $this->display();
    }
    public function addpicture(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      ''; // 设置附件上传根目录
        $upload->savePath  =      './App/Picture/'; // 设置附件上传（子）目录
        // 上传文件 
        $title=array("picture1"=>"1","picture2"=>"2","picture3"=>"3","picture4"=>"4","picture5"=>"5");
        foreach($_FILES as $k=>$v){ 
            if($v['name']!=''){
                $path=$upload->savePath.$v['name'];
                //dump($path);
                $image = new \Think\Image(); 
                $image->open($path);
                //将图片缩放为400x300并保存为jpg
                $image->thumb(400, 300,\Think\Image::IMAGE_THUMB_FIXED)->save($upload->savePath.$k.'.jpg');
                $data=array(
                    'm_type'=>0,
                    'm_title'=>$title[$k],
                    'm_content'=>$k,
                    'm_date'=>date("Y-m-d H:i:s"),
                    'm_admin'=>$_SESSION['username']
                    );
                if(M('message')->where("m_content='".$k."'")->find())
                    $result=M('message')->where("m_content='".$k."'")->save($data);
                else
                    $result=M('message')->add($data);
            }
            
        }
        if($result)
            $this->success('图片添加成功！',U('Admin/Message/index'));
        else
            $this->error('图片添加失败！');
    }
    public function showdel(){
        $picture=M('message')->where('m_type=0')->order('m_title')->select();
        $this->assign('picture',$picture);
        $message1=M('message')->where('m_type=1')->order('m_date')->select();
        $this->assign('message1',$message1);
        $message2=M('message')->where('m_type=2')->order('m_date')->select();
        $this->assign('message2',$message2);
        $this->display();
    }
    public function del(){
    	//dump($_GET['m_id']);
        M('message')->delete($_GET['m_id']);
        $result=M('message')->where('m_id='.$_GET['m_id'])->select();
        if($result)
            $this->error('删除消息失败！',U('Admin/Message/showdel'));
        else
            $this->success('删除消息成功！',U('Admin/Message/showdel'));
    }
    public function delpicture(){
        //dump($_GET['m_id']);
        M('message')->delete($_GET['m_id']);
        $result=M('message')->where('m_id='.$_GET['m_id'])->select();
        if($result)
            $this->error('删除图片失败！',U('Admin/Message/showdel'));
        else
            $this->success('删除图片成功！',U('Admin/Message/showdel'));
    }
    public function showmodify(){
        $picture=M('message')->where('m_type=0')->order('m_title')->select();
        $this->assign('picture',$picture);
        $message1=M('message')->where('m_type=1')->order('m_date')->select();
        $this->assign('message1',$message1);
        $message2=M('message')->where('m_type=2')->order('m_date')->select();
        $this->assign('message2',$message2);
        $this->display();
    }
    public function modifypage($mid){
        $message=M('Message')->where('m_id='.$mid)->find();
        $this->assign('message',$message);
        $this->display();
    }
    public function modifypicture(){
        $picture=M('message')->where('m_type=0')->order('m_title')->select();
        $this->assign('picture',$picture);
        $this->display();
    }
    public function modify(){
        $data=array(
                'm_type'=>$_POST['type']=='通知'?1:2,
                'm_title'=>$_POST['title'],
                'm_content'=>$_POST['content'],
                'm_date'=>date("Y-m-d H:i:s"),
                'm_admin'=>$_SESSION['username']
                );
        $result=M('message')->where('m_id='.$_POST['id'])->save($data);
        if($result)
            $this->success('消息修改成功！',U('Admin/Message/showmodify'));
        else
            $this->error('消息修改失败！');
    }
}