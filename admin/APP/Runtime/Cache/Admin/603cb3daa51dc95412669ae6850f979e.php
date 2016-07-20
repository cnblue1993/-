<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<title>Unicorn Admin</title>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="/community/Public/Css/bootstrap.min.css" />
		<link rel="stylesheet" href="/community/Public/Css/bootstrap-responsive.min.css" />
		<link rel="stylesheet" href="/community/Public/Css/uniform.css" />	
		<link rel="stylesheet" href="/community/Public/Css/unicorn.main.css" />
		<link rel="stylesheet" href="/community/Public/Css/unicorn.grey.css" class="skin-color" />	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
	<body style="text-align:center;">
		
		<div style="background-color: #ffffff;border-color: #aaaaaa;height:500px;text-align:center" >
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
								<h5>系统信息</h5>
							</div>
							<div class="widget-content nopadding">
								<form method="post" action="<?php echo U('Admin/System/modify');?>" class="form-horizontal" />
									<table class="table table-bordered table-striped" style="margin:auto">
										<?php if(is_array($info)): foreach($info as $key=>$i): ?><tr>
												<th style="text-align:center;font-size:14px" ><?php echo ($i["info_type"]); ?></th>
												<td style="text-align:left"><input type="text" name="<?php echo ($i["info_type"]); ?>" value="<?php echo ($i["info_content"]); ?>"/></td>
											</tr><?php endforeach; endif; ?>
									</table>	
									<div class="form-actions">
										<button type="submit" class="btn btn-primary" name="save">保存</button>
									</div>
								</form>						
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		
	</body>
</html>