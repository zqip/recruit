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
								<a href="#">Home</a>
							</li>

							<li>
								<a href="#">Tables</a>
							</li>
							<li class="active">管理中心 </li>
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
						<div class="page-header">
							<h1>
								职位管理
								<small>
									<i class="icon-double-angle-right"></i>
									修改职位
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<div class="col-xs-12">
										<div class="table-responsive">
									<form action="index.php?r=position/update" method="post" id="loginForm">
									<input type="hidden" name="_csrf" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
									<input type="hidden" name="id" value="<?= $date['id'] ?>">
											<table id="sample-table-1" class="table table-striped table-bordered table-hover"> 
												<thead>
													<tr>
														<th class="hidden-480" style="padding-left:480px;">职位名称：</th>
														<th>
															<input type="text" id="position_name" name="position_name" maxlength="20" value="<?= $date['position_name']?>" size="27" class="icon-time bigger-110 hidden-480" placeholder="请输入职位"> <font  style="padding-right:320px;"></font>
														</th>
														
													</tr>
												</thead>
												<?php if($date['parent_id']!=0){ ?>
												<thead>
													<tr>
														<th class="hidden-480" style="padding-left:480px;">上级职位：</th>

														<th>
															<select name="parent_id" class=" bigger-110 hidden-480">
															<?php foreach ($data as $key => $val) { ?>

																<option value="<?=$val['id']?>" <?php echo $date['parent_id']==$val['id'] ? "selected" :''  ?> ><?= $val['html'],$val['position_name'] ?></option>
															<?php } ?>    
															</select>
														</th>
													</tr>
												</thead>
												<?php	} ?>
												<thead>
													<tr>
														<th class="hidden-480" style="padding-left:480px;">是否热门:</td>
														<?php if($date['is_hot']==1){ ?>
															<th><input type="radio" name="is_hot" value="1" checked="true"> 是<input type="radio" name="is_hot" value="0"> 否  </td>
														<?php }else{ ?>
															<th><input type="radio" name="is_hot" value="1" > 是<input type="radio" name="is_hot" value="0" checked="true"> 否  </td>
														<?php	} ?>
														
													</tr>
												</thead>
												<thead>
													<tr>
													
														<th class="hidden-480" style="padding-left:480px;">是否新兴:</td>
													<?php if($date['is_new']==1){ ?>
														<th><input type="radio" name="is_new" value="1" checked="true"> 是<input type="radio" name="is_new" value="0"> 否  </td>
													<?php }else{ ?>
														<th><input type="radio" name="is_new" value="1" checked="true"> 是<input type="radio" name="is_new" value="0" checked="true"> 否  </td>
													<?php	} ?>
													</tr>
												</thead>
												<thead>
													<tr>
														<th class="hidden-480" style="padding-left:480px;">是否展示:</td>
													<?php if($date['is_show']==1){ ?>
														<th><input type="radio" name="is_show" value="1" checked="true"> 是<input type="radio" name="is_show" value="0"> 否  </td>
													<?php }else{ ?>
														<th><input type="radio" name="is_show" value="1" checked="true"> 是<input type="radio" name="is_show" value="0" checked="true"> 否  </td>
													<?php	} ?>
													</tr>
												</thead>
												<thead>
													<tr>
														<td class="hidden-480;" style="padding-left:505px;"><input type="submit" value=" 修改 " class="icon-time bigger-110 hidden-480 btn btn-xs btn-success" ></td>

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
</body>
</html>
