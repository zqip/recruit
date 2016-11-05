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
	<script src="style/js/jquery.1.10.1.min.js"></script>

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
				<a href="#">Home</a>
			</li>

			<li>
				<a href="#">Tables</a>
			</li>
			<li class="active">Simple &amp; Dynamic</li>
		</ul><!-- .breadcrumb -->

		<div class="nav-search" id="nav-search">
			<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
			</form>
		</div><!-- #nav-search -->
	</div>

	<div class="page-content">


		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->

				<div class="row">
					<div class="col-xs-12">
						<div class="table-responsive">
							<table id="sample-table-1" class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th class="center">
										<label>
											<input type="checkbox" class="ace" />
											<span class="lbl"></span>
										</label>
									</th>
									<th>用户</th>
									<th>登录时间</th>
									<th>设置角色</th>
								</tr>
								</thead>

								<tbody>

								<?php foreach ($userList as $key => $value) { ?>
									<tr uid="<?php echo $value['id'] ?>">
										<td class="center">
											<label>
												<input type="checkbox" class="ace" />
												<span class="lbl"></span>
											</label>
										</td>
										<td>
											<span class="sp"><?= $value['u_name'] ?></span>
										</td>
										<td><?= $value['u_login_time'] ?></td>
										<td>
											<select name="" class="roles">
												<option value="0">请更改角色</option>
												<?php foreach($roleList as $k=>$v){ ?>
													<option value="<?php echo $v['id']?>"><?php echo $v["r_name"] ?></option>
												<?php } ?>
											</select>
											<span>当前角色：<?php echo $value["r_name"] ?></span>
										</td>
										<td>
											<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
												<!--<button class="btn btn-xs btn-success">
													<i class="icon-ok bigger-120"></i>
												</button>-->

												<!--<button class="btn btn-xs btn-info">
													<i class="icon-edit bigger-120"></i>
												</button>-->

												<button class="btn btn-xs btn-danger">
													<i class="icon-trash bigger-120"></i>
												</button>

												<!--<button class="btn btn-xs btn-warning">
													<i class="icon-flag bigger-120"></i>
												</button>-->
											</div>

											<div class="visible-xs visible-sm hidden-md hidden-lg">
												<div class="inline position-relative">
													<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown">
														<i class="icon-cog icon-only bigger-110"></i>
													</button>

													<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
														<li>
															<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="icon-zoom-in bigger-120"></i>
																				</span>
															</a>
														</li>

														<li>
															<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="icon-edit bigger-120"></i>
																				</span>
															</a>
														</li>

														<li>
															<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="icon-trash bigger-120"></i>
																				</span>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</td>
									</tr>
								<?php }
								?>



								</tbody>
							</table>
						</div><!-- /.table-responsive -->
					</div><!-- /span -->
				</div><!-- /row -->

				<div class="hr hr-18 dotted hr-double"></div>

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.page-content -->
</div>
</body>
</html>
<script src="style/js/jquery-1.8.3.min.js"></script>
<script>


	$(function(){
		$(".roles").change(function(){
			var obj=$(this);
			var rid=obj.val();
			var uid=obj.parents("tr").attr("uid");
			var roleadd='?r=rbac/roleadd';
			$.ajax({
				type:'post',
				url:roleadd,
				data:{
					rid:rid,
					uid:uid,
					_csrf:'<?php echo \yii::$app->request->csrfToken ?>'
				},
				success:function(data)
				{
					if(data==2)
					{
						obj.next().remove();
						obj.after("<font color='red'>修改失败，请联系管理员</font>");
					}
					else if(data==1)
					{
						obj.next().remove();
						obj.after("<font color='#228b22'>√</font>");
					}
					//alert(data)
				}
			})
		})
		$(document).delegate(".sp","click",function(){
			var name=$(this).html();
			$(this).parent().html("<input type='text' name='u_name' value='"+name+"' />")
		})
		$(document).delegate("input[name='u_name']","blur",function(){
			var new_name=$(this).val();
			var id=$(this).parents("tr").attr("uid");
			var updu='?r=rbac/updateuser';
			var obj=$(this);
			$.ajax({
				type:"post",
				url:updu,
				data:{
					new_name:new_name,
					id:id,
					_csrf:'<?php echo \yii::$app->request->csrfToken ?>'
				},
				//dataType:'json',
				success:function(data)
				{
					if(data==3)
					{
						obj.next().remove();
						obj.after("<font color='red'>该用户名已存在</font>");
					}
					else if(data==2)
					{
						alert("修改失败，请联系管理员")
					}
					else if(data==1)
					{
						obj.parent().html("<span class='sp'>"+new_name+"</span>");
					}
				}
			})
		})
	})
</script>