<?php
namespace Admin\Controller;
use Think\Controller;
class SystemController extends Controller {
	public function help(){
		$this->display();
	}
	public function index(){
		$info=M('site_info')->select();
		$this->assign('info',$info);
		//dump($info);
		$this->display();
	}
	public function building(){
		$build=M('building')->select();
		$this->assign('build',$build);
		$this->display();
	}
	public function initbuild(){
		M()->execute("TRUNCATE table tb_building");
		$zone=(int)M('site_info')->where("info_type='小区栋数'")->getField('info_content');
		$unit=(int)M('site_info')->where("info_type='小区单元数'")->getField('info_content');
		$room=(int)M('site_info')->where("info_type='每单元房间数'")->getField('info_content');
		$day=(int)M('key')->getField('k_day');
		$build=M('building');

		for($i=1;$i<=$zone;$i++){
			for($j=1;$j<=$unit;$j++){
				for($k=1;$k<=$room;$k++){
					$data=array(
						'b_zone'=>$i,
						'b_unit'=>$j,
						'b_room'=>$k,
						'b_begintime'=>date("Y-m-d H:i:s"),
						'b_endtime'=>date("Y-m-d H:i:s",strtotime($day." days"))
						);
					$condition=array('b_zone'=>$i,"b_unit"=>$j,"b_room"=>$k);
					if($build->where($condition)->select())
						$result=$build->where($condition)->save($data);
					else
						$result=$build->add($data);
				}
			}
		}
		if($result)
            $this->success('住房信息初始化成功！',U('Admin/System/building'));
        else
            $this->error('住房信息初始化失败！');
	}
	public function modify(){
		//dump($_POST);
		$system=M('site_info');
		$result=false;
		foreach ($_POST as $k => $v) {
			if($v!=''){
				$system->where("info_type='".$k."'")->setField('info_content',$v);
				$result=true;
			}
		}
		if($result)
            $this->success('系统信息修改成功！',U('Admin/System/index'));
        else
            $this->error('系统信息修改失败！');
	}
}