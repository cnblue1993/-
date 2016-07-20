<?php
namespace Admin\Controller;
use Think\Controller;
class BluetoothController extends Controller {
	public function index(){
		$build=M('building')->group('b_key')->order('b_zone','b_unit')->select();
		$this->assign('build',$build);
		$this->display();
	}
	public function update(){
		foreach($_POST as $k=>$v){
			$zone=(int)M('site_info')->where("info_type='小区栋数'")->getField('info_content');
			$unit=(int)M('site_info')->where("info_type='小区单元数'")->getField('info_content');
			if($v=='all'){
				for($i=1;$i<=$zone;$i++){
					for($j=1;$j<=$unit;$j++){
						$key=$this->createKey();
						$r=M()->execute("update tb_building set b_key=".$key." where b_zone=".$i." and b_unit=".$j);
					}
				}
			}
		}
		if($r)
            $this->success('密钥更新成功！',U('Admin/Bluetooth/index'));
        else
            $this->error('密钥更新失败！');
		//redirect(U('/Bluetooth/index'));
	}
	public function update2($zone,$unit){
		$key=$this->createKey();
		$result=$r=M()->execute("update tb_building set b_key=".$key." where b_zone=".$zone." and b_unit=".$unit);
		if($result)
            $this->success('密钥更新成功！',U('Admin/Bluetooth/index'));
        else
            $this->error('密钥更新失败！');
	}
	public function createKey(){
		$length=(int)M('site_info')->where("info_type='key_length'")->getField('info_content');
		$key="";
		for($i=0;$i<$length;$i++)
			$key .=(mt_rand(1, 9));
		//dump($key);
		return $key;
	}
	public function set(){

		echo "bluetooth";
	}
}