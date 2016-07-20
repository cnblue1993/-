<?php
	//绑定Admin模块到当前入口文件
	define('BIND_MODULE','Admin');
	
	//自动生成指定控制器类
	//define('BUILD_CONTROLLER_LIST','Index,Administrator');
	//自动生成指定模型类
	//define('BUILD_MODEL_LIST','Index,Administrator');
	//设置禁止访问的模块列表
	//'MODULE_DENY_LIST'=>array('Common','Runtime','Api');
	//项目名称
	define('APP_NAME','APP');
	//项目路径
	define('APP_PATH','./APP/');

	define('APP_DEBUG','TRUE');//开启调试模式，以后记得关
	
	//url区分大小写
	//'URL_CASE_INSENSITIVE'=>true;
	
	//加载thinkphp核心文件
	require'./ThinkPHP/ThinkPHP.php';
	
?>