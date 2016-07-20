<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Classes\Category;
class ResidentController extends Controller {
    public function index(){
        $resident=M('resident')->select();
        $this->assign('resident',$resident);
    	$this->display();
    }
    public function showadd(){
        $this->display();
    }
    public function addpage(){
        $this->display();
    }
    public function add(){
        $data=array(
            'r_name'=>$_POST['name'],
            'r_identity'=>$_POST['identity'],
            'r_zone'=>$_POST['zone'],
            'r_unit'=>$_POST['unit'],
            'r_room'=>$_POST['room'],
            'r_tel'=>$_POST['tel'],
            'r_people'=>$_POST['people'],
            'r_key'=>$_POST['key']
            );
        $result=M('resident')->add($data);
        if($result)
            $this->success('住户信息添加成功！',U('Admin/Resident/showadd'));
        else
            $this->error('住户信息添加失败！');

    }

    public function import(){
        $this->display();
    }
    public function runexcel(){
        if (! empty ( $_FILES ['file_stu'] ['name'] )) 
        {
            $tmp_file = $_FILES ['file_stu'] ['tmp_name'];
            $file_types = explode ( ".", $_FILES ['file_stu'] ['name'] );
            $file_type = $file_types [count ( $file_types ) - 1];
            /*判别是不是.xls文件，判别是不是excel文件*/
            if (strtolower ( $file_type ) != "xls")              
            {
                $this->error ( '不是Excel文件，重新上传' );
            }
              /*设置上传路径*/
            $savePath = './Excel/';
              /*以时间来命名上传的文件*/
            $str = date ( 'Ymdhis' ); 
            $file_name = $str . "." . $file_type;
              /*是否上传成功*/
            if (! copy ( $tmp_file, $savePath . $file_name )) 
            {
                $this->error ( '上传失败' );
            }
            $exceldata=Category::read($savePath.$file_name);
            //dump($exceldata);//取$exceldata[2]为这张数据的表头
            $excelTop=Category::getExcelTop($exceldata[2]);
            //dump($excelTop);
            //获取ExcelBody
            $excelBody=Category::getExcelBody($exceldata);
            $rusultExcel=$this->saveExcel($excelBody,$excelTop);
        }

        if($rusultExcel)
            $this->success('住户信息导入成功！',U('Admin/Resident/index'));
        else
            $this->error('住户信息导入失败！');
    }
    public function saveExcel($excel,$excelTop){
        foreach($excel as $k=>$v){
            $project=M('resident');
            if(!empty($project)){
              $data=array(
                'r_name'=>$v[$excelTop['姓名']],
                'r_identity'=>$v[$excelTop['身份证']],
                'r_zone'=>$v[$excelTop['栋']],
                'r_unit'=>$v[$excelTop['单元']],
                'r_room'=>$v[$excelTop['室']],
                'r_tel'=>$v[$excelTop['手机']]
                );
              if($project->where('r_identity='.$v[$excelTop['身份证']])->find())
                continue;
              else
                $result=M('resident')->add($data);
            }
        }
        if($result)
            return true;
        else
            return false;
    }
    public function showdel(){
        $resident=M('resident')->select();
        $this->assign('resident',$resident);
        $this->display();
    }
    public function del(){
    	M('resident')->delete($_GET['r_id']);
        $result=M('resident')->where('r_id='.$_GET['r_id'])->select();
        if($result)
            $this->error('删除住户失败！',U('Admin/Resident/showdel'));
        else
            $this->success('删除住户成功！',U('Admin/Resident/showdel'));
    }
    public function showmodify(){
        $resident=M('resident')->select();
        $this->assign('resident',$resident);
        $this->display();
    }
    public function modifypage($rid){
        $resident=M('resident')->where('r_id='.$rid)->find();
        $this->assign('resident',$resident);
        $this->display();
    }
    public function modify(){
        $old=M('resident')->where('r_id='.$_POST['id'])->find();
        $data=array(
            'r_name'=>$_POST['name']==''?$old['r_name']:$_POST['name'],
            'r_identity'=>$_POST['identity']==''?$old['r_identity']:$_POST['identity'],
            'r_zone'=>$_POST['zone']==''?$old['r_zone']:$_POST['zone'],
            'r_unit'=>$_POST['unit']==''?$old['r_unit']:$_POST['unit'],
            'r_room'=>$_POST['room']==''?$old['r_room']:$_POST['room'],
            'r_tel'=>$_POST['tel']==''?$old['r_tel']:$_POST['tel'],
            'r_people'=>$_POST['people']==''?$old['r_people']:$_POST['people'],
            'r_key'=>$_POST['key']==''?$old['r_key']:$_POST['key']
            );
        $result=M('resident')->where('r_id='.$_POST['id'])->save($data);
        if($result)
            $this->success('住户信息修改成功！',U('Admin/Resident/showmodify'));
        else
            $this->error('住户信息修改失败！');
    }
}