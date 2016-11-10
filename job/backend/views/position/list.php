<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Bootstrap表格插件 - Bootstrap后台管理系统</title>
		<meta name="keywords" content="Bootstrap模版,Bootstrap模版下载,Bootstrap教程,Bootstrap中文" />
		<meta name="description" content="站长素材提供Bootstrap模版,Bootstrap教程,Bootstrap中文翻译等相关Bootstrap插件下载" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />
		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<script src="assets/js/ace-extra.min.js"></script>
	</head>
	<body>
	<?php 
	use yii\widgets\LinkPager;
	?>
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
						</ul>
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
							</form>
						</div>
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>
								职位管理
								<small>
									<i class="icon-double-angle-right"></i>
									职位列表
								</small>
							</h1>
						</div>
						<div class="row">
							<div class="col-xs-12">
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
														<th>职位名称</th>
														<th>Price</th>
														<th class="hidden-480">是否热门</th>

														<th>
															<i class="icon-time bigger-110 hidden-480"></i>
															是否新兴
														</th>
														<th class="hidden-480">是否展示</th>

														<th>操作</th>
													</tr>
												</thead>

												<tbody>
												<?php foreach ($poslist as $v) {  ?>
													<tr>
														<td class="center">
															<label>
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</td>
														
															<td>
															<?= $v['html'] ?>
															<span><?=  $v['position_name']; ?></span>
														</td>
														<td><?= $v['parent_id']; ?></td>
														<?php if($v['is_hot']==0){
															echo '<td class="hidden-480">否</td>';
															}else{
																echo '<td class="hidden-480">是</td>';
																} ?>
														<?php if( $v['is_new']==0){
															echo '<td class="hidden-480">否</td>';
															}else{
																echo '<td>是</td>';
																} ?>
														 <?php if( $v['is_show']==0){
															echo '<td class="hidden-480">否</td>';
															}else{
																echo '<td>是</td>';
																} ?>
														<td>
															<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
																<a href="index.php?r=position/add ?>">
																<button class="btn btn-xs btn-success">
																	<i class="icon-ok bigger-120"></i>
																</button>

																<a href="index.php?r=position/update&id=<?= $v['id'] ?>">
																<button class="btn btn-xs btn-info">
																	<i class="icon-edit bigger-120"></i>
																</button></a>

																<a href="index.php?r=position/del&id=<?= $v['id'] ?>">
																<button class="btn btn-xs btn-danger">
																	<i class="icon-trash bigger-120"></i>
																</button></a>

																<!-- <button class="btn btn-xs btn-warning">
																	<i class="icon-flag bigger-120"></i>
																</button> -->
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
													<?php } ?>
												</tbody>
											</table>
											<a href="index.php?r=position/list&page=1">首页</a>
											<a href="index.php?r=position/list&page=<?=$prev ?>">上一页</a>
											<a href="index.php?r=position/list&page=<?=$next ?>">下一页</a>
											<a href="index.php?r=position/list&page=<?=$allPage ?>">末页</a>
										</div>
									</div>
								</div>
</body>
</html>
