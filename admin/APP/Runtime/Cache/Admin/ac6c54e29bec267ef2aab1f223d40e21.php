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
  	<h1 style="color:#fff">Community </h1>  
    <div id="header">
      <h1 style="color:#f00">Community </h1>   
    </div>
    <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav btn-group">
                <li class="btn btn-inverse"><a title="" href="#"><i class="icon icon-user"></i> <span class="text">欢迎，<?php echo ($_SESSION['username']); ?></span></a></li>
                <li class="btn btn-inverse dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">消息</span> <span class="label label-important">5</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class="sAdd" title="" href="#" target="main">新消息</a></li>
                    </ul>
                </li>
                <li class="btn btn-inverse"><a title="" href="<?php echo U('Admin/System/help');?>" target="main"><i class="icon icon-cog"></i> <span class="text">帮助</span></a></li>
                <li class="btn btn-inverse"><a title="" href="<?php echo U('Admin/Login/index');?>" target="_top"><i class="icon icon-share-alt"></i> <span class="text">退出</span></a></li>
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