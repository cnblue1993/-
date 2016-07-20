<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<title>消息查看</title>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="/community/Public/Css/bootstrap.min.css" />
		<link rel="stylesheet" href="/community/Public/Css/bootstrap-responsive.min.css" />
		<link rel="stylesheet" href="/community/Public/Css/uniform.css" />
		<link rel="stylesheet" href="/community/Public/Css/select2.css" />		
		<link rel="stylesheet" href="/community/Public/Css/unicorn.main.css" />
		<link rel="stylesheet" href="/community/Public/Css/unicorn.grey.css" class="skin-color" />	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
	<body>

		
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>海报图片</h5>
							</div>
							<div class="widget-content nopadding">
								<form method="post" action="<?php echo U('Admin/Message/addpicture');?>"enctype="multipart/form-data" class="form-horizontal" name="picture"/>
									<div class="control-group">
										<label class="control-label">图片一</label>
										<div class="controls">
											<input  type="file" name="picture1" style="zoom:120%"/>
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label">图片二</label>
										<div class="controls">
											<input  type="file" name="picture2" style="zoom:120%"/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">图片三</label>
										<div class="controls">
											<input  type="file" name="picture3" style="zoom:120%"/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">图片四</label>
										<div class="controls">
											<input  type="file" name="picture4" style="zoom:120%"/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">图片五</label>
										<div class="controls">
											<input  type="file" name="picture5" style="zoom:120%"/>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" style="margin-left:90%" class="btn btn-primary">保存</button>
									</div>
								</form>
							</div>
						</div>						
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>									
								</span>
								<h5>消息</h5>
							</div>
							<div class="widget-content nopadding">
									<div class="control-group">
										<table style="table-layout:fixed;border-collapse:collapse;"  class="table table-bordered data-table">
										<thead>
											<tr>
											<th>消息类型</th>
											<th>消息标题</th>
											<th>消息内容</th>
											<th>发布时间</th>
											<th>发布人</th>
											</tr>
										</thead>
										<tbody>
											<?php if(is_array($message1)): foreach($message1 as $key=>$m1): ?><tr class="gradeX">
												<td style="text-align:center;width:5%;">通知</td>
												<td style="text-align:center;width:10%;"><?php echo ($m1["m_title"]); ?></td>
												<td nowrap  style="text-align:center; width:50%;overflow:hidden;text-overflow:ellipsis;"><a href="<?php echo U('Admin/Message/showmessage');?>?m_id=<?php echo ($m1["m_id"]); ?>;"><?php echo ($m1["m_content"]); ?></a></td>
												<td style="text-align:center;width:10%;"><?php echo ($m1["m_date"]); ?></td>
												<td style="text-align:center;width:10%;"><?php echo ($m1["m_admin"]); ?></td><?php endforeach; endif; ?>
											<?php if(is_array($message2)): foreach($message2 as $key=>$m2): ?><tr class="gradeX">
												<td style="text-align:center">社区活动</td>
												<td style="text-align:center"><?php echo ($m2["m_title"]); ?></td>
												<td nowrap  style="text-align:center; width:50%;overflow:hidden;text-overflow:ellipsis;"><a href="<?php echo U('Admin/Message/showmessage');?>?m_id=<?php echo ($m2["m_id"]); ?>;"><?php echo ($m2["m_content"]); ?></a></td>
												<td style="text-align:center"><?php echo ($m2["m_date"]); ?></td>
												<td style="text-align:center"><?php echo ($m2["m_admin"]); ?></td><?php endforeach; endif; ?>
										
										</tbody>
									</table> 
									</div>
									<div class="form-actions">
										<button type="submit" style="margin-left:90%" class="btn btn-primary" onclick="window.location.href='addpage'">添加</button>
									</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div id="footer" class="span12">
						2012 ustc
				</div>
			</div>
		
		
            
            <script src="/community/Public/Js/jquery.min.js"></script>
            <script src="/community/Public/Js/jquery.ui.custom.js"></script>
            <script src="/community/Public/Js/bootstrap.min.js"></script>
            <script src="/community/Public/Js/jquery.uniform.js"></script>
            <script src="/community/Public/Js/select2.min.js"></script>
            <script src="/community/Public/Js/unicorn.js"></script>
            <script src="/community/Public/Js/unicorn.form_common.js"></script>
	</body>
</html>