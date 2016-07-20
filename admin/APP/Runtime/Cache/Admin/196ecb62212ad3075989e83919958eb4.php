<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<title>蓝牙密钥更新</title>
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
						
			<div class="widget-box">
				<div class="widget-title">
				
					<h5>密钥更新</h5>
				</div>
				<div class="widget-content nopadding">
					<form action="<?php echo U('Admin/Bluetooth/update');?>" method="post"/>
					<table class="table table-bordered data-table">
						<thead>
							<tr>
							<th>栋</th>
							<th>单元</th>
							<th>人数</th>
							<th>蓝牙密钥</th>
							<th>编辑</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($build)): foreach($build as $key=>$b): ?><tr class="gradeX">
								<td style="text-align:center"><?php echo ($b["b_zone"]); ?></td>
								<td style="text-align:center"><?php echo ($b["b_unit"]); ?></td>
								<td style="text-align:center"><?php echo ($b["b_people"]); ?></td>
								<td style="text-align:center"><?php echo ($b["b_key"]); ?></td>
								<td style="text-align:center">[<a href="<?php echo U('Admin/Bluetooth/update2',array('zone'=>$b['b_zone'],'unit'=>$b['b_unit']));?>">更新</a>]</td>
								</tr><?php endforeach; endif; ?>
						</tbody>
						</table>  
						<div class="form-actions">
							<button type="submit" class="btn btn-primary" onclick="window.location.href='update'" name="all" value="all">全部更新</button>
						</div>
					</form>
				</div>
			</div>
				
				<div class="row-fluid">
					<div id="footer" class="span12">
						2015 ustc
					</div>
				</div>
		
		
            
            <script src="/community/Public/Js/jquery.min.js"></script>
            <script src="/community/Public/Js/jquery.ui.custom.js"></script>
            <script src="/community/Public/Js/bootstrap.min.js"></script>
            <script src="/community/Public/Js/jquery.uniform.js"></script>
            <script src="/community/Public/Js/select2.min.js"></script>
            <script src="/community/Public/Js/jquery.dataTables.min.js"></script>
            <script src="/community/Public/Js/unicorn.js"></script>
            <script src="/community/Public/Js/unicorn.tables.js"></script>
	</body>
</html>