<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <!-- container-fluid -->
  <head>
    <title>Community</title>
    <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/community/Public/Css/bootstrap.min.css" />
    <link rel="stylesheet" href="/community/Public/Css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="/community/Public/Css/fullcalendar.css" /> 
    <link rel="stylesheet" href="/community/Public/Css/unicorn.main.css" />
    <link rel="stylesheet" href="/community/Public/Css/unicorn.grey.css" class="skin-color" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
  <body>
    <div id="sidebar">
      <a href="#" class="visible-phone" target="main"><i class="icon icon-home"></i>导航栏</a>
      <ul>
         <li class="submenu">
          <a href="<?php echo U('Admin/Administrator/index');?>" target="main"><i class="icon icon-th-list"></i> <span>管理员管理</span> </a>
          <ul>
            <li><a href="<?php echo U('Admin/Administrator/showadd');?>" target="main">添加管理员</a></li>
            <li><a href="<?php echo U('Admin/Administrator/showmodify');?>" target="main">修改管理员</a></li>
            <li><a href="<?php echo U('Admin/Administrator/index');?>" target="main">删除管理员</a></li>
          </ul>
        </li>
        <li class="submenu">
          <a href="#" target="main"><i class="icon icon-th-list"></i> <span>住户管理</span> </a>
          <ul>
            <li><a href="<?php echo U('Admin/Resident/index');?>" target="main">住户查看</a></li>
            <li><a href="<?php echo U('Admin/Resident/showadd');?>" target="main">住户添加</a></li>
            <li><a href="<?php echo U('Admin/Resident/showmodify');?>" target="main">住户修改</a></li>
             <li><a href="<?php echo U('Admin/Resident/showdel');?>" target="main">住户注销</a></li>
          </ul>
        </li>
        <li class="submenu">
          <a href="#" target="main"><i class="icon icon-file"></i> <span>蓝牙管理</span> </a>
          <ul>
            <li><a href="<?php echo U('Admin/Bluetooth/index');?>" target="main">蓝牙密钥更新</a></li>
            <li><a href="<?php echo U('Admin/Bluetooth/set');?>" target="main">蓝牙密钥设置</a></li>
          </ul>
        </li>
          <li class="submenu">
          <a href="#" target="main"><i class="icon icon-th-list"></i> <span>消息管理</span> </a>
          <ul>
            <li><a href="<?php echo U('Admin/Message/index');?>" target="main">消息查看</a></li>
            <li><a href="<?php echo U('Admin/Message/showadd');?>" target="main">消息添加</a></li>
            <li><a href="<?php echo U('Admin/Message/showmodify');?>" target="main">消息修改</a></li>
             <li><a href="<?php echo U('Admin/Message/showdel');?>" target="main">消息删除</a></li>
          </ul>
        </li>
        <li class="submenu">
          <a href="#" target="main"><i class="icon icon-th-list"></i> <span>系统设置</span> </a>
          <ul>
            <li><a href="<?php echo U('Admin/System/index');?>" target="main">系统信息</a></li>
            <li><a href="<?php echo U('Admin/System/building');?>" target="main">住房信息</a></li>
            <li><a href="#" target="main"></a></li>
            
          </ul>
        </li>
      </ul>
  	</div>
            <script src="/community/Public/Js/excanvas.min.js"></script>
            <script src="/community/Public/Js/jquery.min.js"></script>
            <script src="/community/Public/Js/jquery.ui.custom.js"></script>
            <script src="/community/Public/Js/bootstrap.min.js"></script>
            <script src="/community/Public/Js/jquery.flot.min.js"></script>
            <script src="/community/Public/Js/jquery.flot.resize.min.js"></script>
            <script src="/community/Public/Js/jquery.peity.min.js"></script>
            <script src="/community/Public/Js/fullcalendar.min.js"></script>
            <script src="/community/Public/Js/unicorn.js"></script>
            <script src="/community/Public/Js/unicorn.dashboard.js"></script>
  </body>
</html>