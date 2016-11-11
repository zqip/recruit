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

		<script src="assets/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		
	
	</head>
<body>
<div class="main-content">
<form action='<?=\yii\helpers\Url::to(['rbac/addprivilege'])?>' method="post" class="form-search" id='addPrivilege'>
  <input name="_csrf" value="<?= \yii::$app->request->csrfToken ?>"  type="hidden"/>
	<div class="table-responsive">
		<table id="sample-table-1" class="table table-striped table-bordered table-hover">
			<tr>
				<td>权限名称</td>
				<td><input type="text" name="p_name"></td>
			</tr>
			<tr>
				<td>控制器名称</td>
				<td><input type="text" name="p_controller"></td>
			</tr>
			<tr>
				<td>方法名称</td>
				<td><input type="text" name="p_action"></td>
			</tr>
			<tr>
				<td>父集权限</td>
				<td>
				<select name="parent_id" id="">
					<option value="0">请选择父集权限</option>
				<?php foreach ($topList as $key => $value) { ?>
						<option value="<?=$value['id'] ?>"><?=$value['p_name'] ?></option>
				<?php } ?>
				</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span><font color = 'red'> * 不选择父集权限默认顶级权限 </font></span>
				</td>
			</tr>
			<tr>
				<td align="right"><input type="submit" value="确定添加" class="btn btn-xs btn-success"></td>
				<td></td>
			</tr>
		</table>
	</div>
</form>
</div>
</body>
</html>
<script src="style/js/jquery.1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="style/js/jquery.lib.min.js"></script>
<script>
	$("#addPrivilege").validate({
	    	        rules: {
	    	        	p_name:{
	    	        		required: true
	    	        	},
			    	   	p_controller: {
			    	    	required: true,
			    	   	},
			    	   	p_action: {
			    	    	required: true,
			    	   	},
			    	},
			    	messages: {
			    		p_name:{
	    	        		required:"<font color = 'red'>请输入权限名称 </font>"
	    	        	},
			    	 	p_controller: {
			    	    	required: "<font color = 'red'>请输入控制器 </font>",
			    	    	
			    	   	},
			    	   	p_action: {
			    	    	required: "<font color = 'red'>请输入方法</font>",
			    	    	
			    	   	},
			    	
			    	},
			    	errorPlacement:function(label, element){
			    		
			    		if(element.attr("type") == "radio"){
			    			label.insertAfter($(element).parents('ul')).css('marginTop','-20px');
			    		}else if(element.attr("type") == "checkbox"){
			    			label.insertAfter($(element).parent()).css('clear','left');
			    		}else{
			    			label.insertAfter(element);
			    		};	
			    	},
			    	
	    	});
</script>