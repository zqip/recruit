<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>用户展示</title>
		<meta name="keywords" content="Bootstrap模版,Bootstrap模版下载,Bootstrap教程,Bootstrap中文" />
		<meta name="description" content="站长素材提供Bootstrap模版,Bootstrap教程,Bootstrap中文翻译等相关Bootstrap插件下载" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!-- ace styles -->

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		
		<script sec="style/js/jquery-1.9.1.min.js"></script>
		<script src="assets/js/ace-extra.min.js"></script>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<style>
			li{
				list-style:none;
			}
		</style>
	</head>
<body>
<div class="main-content">

	<div class="table-responsive">
		<form action="?r=rbac/addp_a" method="post">
			<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">

		<table id="sample-table-1" class="table table-striped table-bordered table-hover">
			<thead>
				<th>角色</th>
				<th>权限</th>
			</thead>
			<?php
			 foreach ($roleList as $key => $value) { 
				$data = [];
				foreach ($r_p_list as $k => $v) {

			 	if ($value['id']==$v['rid']) {
			 			$data[] = $v['pid'];
			 		}	
				}
				?>
			<tbody rid="<?= $value['id']?>">
				<td><?=$value['r_name']?></td>
				<td>
					<ul>
					<?php foreach ($privilege as $k => $v): ?>
						<li><?=$v['html']?><input type="checkbox" value="<?=$v['id'] ?>" 
						<?php
							if (in_array($v['id'], $data)) {
								echo "checked";
							}
						?>  name="<?= $value['id']?>[]" onclick="dian(this)"
						>&nbsp;&nbsp;<?=$v['p_name']?></li>
				<?php endforeach ?></td>
					</ul>
			</tbody>
			<?php } ?>
			<tbody>
				<td><input type="submit" value="提交"></td>
				<td></td>
			</tbody>
		</table>
				</form>
	</div>
</form>
</div>

</body>
</html>