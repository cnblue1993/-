<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<title>住户查看</title>
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
				
					<h5>住户查看</h5>
				</div>
				<div class="widget-content nopadding">
					<table class="table table-bordered data-table">
						<thead>
							<tr>
							<th>姓名</th>
							<th>栋</th>
							<th>单元</th>
							<th>室</th>
							<th>手机</th>
							<th>人数</th>
							<th>蓝牙密钥</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($resident)): foreach($resident as $key=>$r): ?><tr class="gradeX">
								<td style="text-align:center"><?php echo ($r["r_name"]); ?></td>
								<td style="text-align:center"><?php echo ($r["r_zone"]); ?></td>
								<td style="text-align:center"><?php echo ($r["r_unit"]); ?></td>
								<td style="text-align:center"><?php echo ($r["r_room"]); ?></td>
								<td style="text-align:center"><?php echo ($r["r_tel"]); ?></td>
								<td style="text-align:center"><?php echo ($r["r_people"]); ?></td>
								<td style="text-align:center"><?php echo ($r["r_key"]); ?></td>
								</tr><?php endforeach; endif; ?>
						
						
						</tbody>
						</table>  
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