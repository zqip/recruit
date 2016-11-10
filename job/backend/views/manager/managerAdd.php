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
					 <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="#">首页</a>
            </li>
            <li class="active">控制台</li>
        </ul>
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                管理员中心
                <small>
                    <i class="icon-double-angle-right"></i>
                    管理员添加
                </small>
            </h1>
        </div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<div class="col-xs-12">
										<div class="table-responsive">
									<form action="index.php?r=manager/manager-add" method="post" id="loginForm">
									
											<table id="sample-table-1" class="table table-striped table-bordered table-hover"> 
												<thead>
													<tr>
														<th class="hidden-480" style="padding-left:480px;">管理员名称：</th>
														<th>
															<input type="text"   placeholder="请输入名称" name='u_name'> <font  style="padding-right:320px;"></font>
														</th>
														
													</tr>
												</thead>
												<thead>
													<tr>
														<th class="hidden-480" style="padding-left:480px;">设置密码：</th>

														<th>
															
															<input type="password" placeholder="设置密码" name='u_pwd'>
														</th>
													</tr>
												</thead>
												
												<thead>
													<tr>
														<th class="hidden-480" style="padding-left:480px;">确认密码：</th>

														<th>
															
															<input type="password" placeholder="确认密码" name='q_pwd'>
														</th>
													</tr>
												</thead>

												<thead>
													<tr>
														<th class="hidden-480" style="padding-left:480px;">管理员角色：</th>

														<th>
															<select name="role" class=" bigger-110 hidden-480">
																
															<?php foreach ($privilege as $key => $val) { ?>
																<option value="<?=$val['id']?>"><?= $val['r_name'] ?></option>
															<?php } ?>    
															</select>
														</th>
													</tr>
												</thead>
												
												<thead>
													<tr>
														<td class="hidden-480;" style="padding-left:505px;"><input type="submit" value=" 添加 " class="icon-time bigger-110 hidden-480 btn btn-xs btn-success" ></td>

														<td style="padding-right:400px;"><input type="reset" value=" 重置 " class="icon-time bigger-110 hidden-480 btn btn-xs btn-success">
														</td>
														
													</tr>
												</thead>
											
											</table>
										</form>
										</div><!-- /.table-responsive -->
									</div><!-- /span -->
								</div><!-- /row -->											

								<div id="modal-table" class="modal fade" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header no-padding">
												<div class="table-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														<span class="white">&times;</span>
													</button>
													Results for "Latest Registered Domains
												</div>
											</div>

											<div class="modal-body no-padding">
												<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
													<thead>
														<tr>
															<th>Domain</th>
															<th>Price</th>
															<th>Clicks</th>

															<th>
																<i class="icon-time bigger-110"></i>
																Update
															</th>
														</tr>
													</thead>

													<tbody>
														<tr>
															<td>
																<a href="#">ace.com</a>
															</td>
															<td>$45</td>
															<td>3,330</td>
															<td>Feb 12</td>
														</tr>

														<tr>
															<td>
																<a href="#">base.com</a>
															</td>
															<td>$35</td>
															<td>2,595</td>
															<td>Feb 18</td>
														</tr>

														<tr>
															<td>
																<a href="#">max.com</a>
															</td>
															<td>$60</td>
															<td>4,400</td>
															<td>Mar 11</td>
														</tr>

														<tr>
															<td>
																<a href="#">best.com</a>
															</td>
															<td>$75</td>
															<td>6,500</td>
															<td>Apr 03</td>
														</tr>

														<tr>
															<td>
																<a href="#">pro.com</a>
															</td>
															<td>$55</td>
															<td>4,250</td>
															<td>Jan 21</td>
														</tr>
													</tbody>
												</table>
											</div>

											<div class="modal-footer no-margin-top">
												<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
													<i class="icon-remove"></i>
													Close
												</button>

												<ul class="pagination pull-right no-margin">
													<li class="prev disabled">
														<a href="#">
															<i class="icon-double-angle-left"></i>
														</a>
													</li>

													<li class="active">
														<a href="#">1</a>
													</li>

													<li>
														<a href="#">2</a>
													</li>

													<li>
														<a href="#">3</a>
													</li>

													<li class="next">
														<a href="#">
															<i class="icon-double-angle-right"></i>
														</a>
													</li>
												</ul>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->
				<script src="style/js/jquery.1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="style/js/jquery.lib.min.js"></script>
<script>
	$("#loginForm").validate({
	    	        rules: {
	    	        	position_name:{
	    	        		required: true
	    	        	},
			    	},
			    	messages: {
			    		position_name:{
	    	        		required:"<font color = 'red'>请输入职位名称 </font>"
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
	
</body>
</html>
