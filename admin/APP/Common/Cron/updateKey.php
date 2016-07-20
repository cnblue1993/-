<?php
	$build=M('building')->select();
	$day=(int)M('key')->getField('k_day');
	foreach ($build as $key => $value) {
		$now_time=date('Y-m-d');
		if($now_time>$value['b_endtime']){
			$length=(int)M('site_info')->where("info_type='key_length'")->getField('info_content');
			$key="";
			for($i=0;$i<$length;$i++)
				$key .=(mt_rand(1, 9));
			$data=array(
				'b_begintime'=>date("Y-m-d H:i:s"),
				'b_endtime'=>date("Y-m-d H:i:s",strtotime($day." days")),
				'b_key'=>$key
				);
			M('building')->where('b_id='.$value['b_id'])->save($data);
		}
	}
);