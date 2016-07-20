<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<meta http-equiv="Content-Type" CONTENT="text/html;charset=utf-8">
	<meta http-equiv="content-language" content="utf-8" />
	<TITLE>Community</TITLE>
</head>
	<frameset rows="50,*" cols="*" frameborder="NO" border="0" framespacing="0">
	<frame name="top" style="Noprint" scrolling="No"  frameborder="0" src="<?php echo U('Admin/Index/top');?>" >
	<frameset rows="*" cols="170,*" framespacing="0" frameborder="NO" border="0" name="myFrame" >
	<frame name="left" style="Noprint" id="left"  scrolling="No"  frameborder="0" src="<?php echo U('Admin/Index/left');?>">
	<frame name="main" id="main" scrolling="Auto"  frameborder="0" src="<?php echo U('Admin/System/index');?>" ></frameset>
<noframes>
	<p>
		This page requires frames, but your browser does not support them.
	</p>
</noframes>
</frameset>
</html>