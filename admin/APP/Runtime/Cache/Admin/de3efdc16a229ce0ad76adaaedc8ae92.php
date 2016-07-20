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
<script> 
function deletemessage(mid)
{
	if(!confirm("真的要删除吗？")){
			return false;	
	}		
	window.location.href="<?php echo U('Admin/Message/del');?>?m_id="+mid;	
	return true;
}
function deletepicture(mid)
{
	if(!confirm("真的要删除吗？")){
			return false;	
	}		
	window.location.href="<?php echo U('Admin/Message/delpicture');?>?m_id="+mid;	
	return true;
}
</script>
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
									<div class="control-group">
										<table class="table table-bordered data-table">
										<?php $num=array("一","二","三","四","五","六","七","八","九","十"); ?>
										<thead>
											<tr>
											<?php if(is_array($picture)): foreach($picture as $key=>$p): $i=$p['m_title']-1; ?>
											<th>图片<?php echo ($num[$i]); ?></th><?php endforeach; endif; ?>
											</tr>
										</thead>
										<tbody>
											<tr class="gradeX">
												<?php if(is_array($picture)): foreach($picture as $key=>$p): ?><td style="text-align:center"><img src="/community/App/Picture/<?php echo ($p["m_content"]); ?>.jpg" alt="" /></td><?php endforeach; endif; ?>
											</tr>
											<tr>
												<?php if(is_array($picture)): foreach($picture as $key=>$p): ?><td style="text-align:center">[<a href="#" onClick="javascript:return deletepicture(<?php echo ($p['m_id']); ?>);">删除</a>]</td><?php endforeach; endif; ?>
											</tr>
										</tbody>
									</table> 
									</div>
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
											<th>编辑</th>
											</tr>
										</thead>
										<tbody>
											<?php if(is_array($message1)): foreach($message1 as $key=>$m1): ?><tr class="gradeX">
												<td style="text-align:center;width:5%;">通知</td>
												<td style="text-align:center;width:10%;"><?php echo ($m1["m_title"]); ?></td>
												<td nowrap  style="text-align:center; width:50%;overflow:hidden;text-overflow:ellipsis;"><a href="<?php echo U('Admin/Message/showmessage');?>?m_id=<?php echo ($m1["m_id"]); ?>;"><?php echo ($m1["m_content"]); ?></a></td>
												<td style="text-align:center;width:10%;"><?php echo ($m1["m_date"]); ?></td>
												<td style="text-align:center;width:10%;"><?php echo ($m1["m_admin"]); ?></td>
												<td style="text-align:center">[<a href="#" onClick="javascript:return deletemessage(<?php echo ($m1['m_id']); ?>);">删除</a>]</td><?php endforeach; endif; ?>
											<?php if(is_array($message2)): foreach($message2 as $key=>$m2): ?><tr class="gradeX">
												<td style="text-align:center">社区活动</td>
												<td style="text-align:center"><?php echo ($m2["m_title"]); ?></td>
												<td nowrap  style="text-align:center; width:50%;overflow:hidden;text-overflow:ellipsis;"><a href="<?php echo U('Admin/Message/showmessage');?>?m_id=<?php echo ($m2["m_id"]); ?>;"><?php echo ($m2["m_content"]); ?></a></td>
												<td style="text-align:center"><?php echo ($m2["m_date"]); ?></td>
												<td style="text-align:center"><?php echo ($m2["m_admin"]); ?></td>
												<td style="text-align:center">[<a href="#" onClick="javascript:return deletemessage(<?php echo ($m2['m_id']); ?>);">删除</a>]</td><?php endforeach; endif; ?>
										</tbody>
									</table> 
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
            <script src="/community/Public/Js/bootstrap-colorpicker.js"></script>
            <script src="/community/Public/Js/bootstrap-datepicker.js"></script>
            <script src="/community/Public/Js/jquery.uniform.js"></script>
            <script src="/community/Public/Js/select2.min.js"></script>
            <script src="/community/Public/Js/unicorn.js"></script>
            <script src="/community/Public/Js/unicorn.form_common.js"></script>
	</body>
</html>