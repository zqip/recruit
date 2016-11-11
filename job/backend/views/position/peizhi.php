<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Bootstrap表格插件 - Bootstrap后台管理系统</title>
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

		<script src="assets/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

<body>
<div class="main-content">
<center>
<table>
	<tr>
		<td><h3>请选择</h3></td>
	</tr>
	<tr>
		<td><input type="button" value="职位列表配置文件生成" class="icon-time bigger-110 hidden-480 btn btn-xs btn-success" id="postion" /></td>
		
	</tr>
</table>
</center>						
</div>
<script src="style/js/jquery-1.8.3.min.js" type="text/javascript"></script>			
<script>
	$(function(){
		$("#postion").click(function(){
			var urlposition="?r=position/pos";
			$.get(urlposition,function(msg){
				alert(msg);
			})
		})
	})
</script>	
</body>
</html>
