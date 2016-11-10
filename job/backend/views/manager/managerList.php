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
                    管理员列表
                </small>
            </h1>
        </div><!-- /.page-header -->

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
																<input type="checkbox" class="ace"
																id='all' />
																<span class="lbl"></span>
															</label>
														</th>
														<th>管理员名称</th>
														<th>最近一次登录</th>
														

														<th>操作</th>
													</tr>
												</thead>

												<tbody>
												<?php foreach ($info as $v) {  ?>
													<tr>
														<td class="center">
															<label>
																<input type="checkbox" class="ace"
																 />
																<span class="lbl"></span>
															</label>
														</td>
														
															<td>
															<?= $v['u_name'] ?>
															
														</td>
														<?php if($v['u_login_time']==0):?>
															<td>暂未登录</td>
														<?php else:?>
														<td>
															<?= date('Y-m-d',$v['u_login_time']); ?>
															
														</td>
													<?php endif;?>

														<td>
															<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
																

																<a href="index.php?r=manager/update&id=<?= $v['id'] ?>"><button class="btn btn-xs btn-info">
																	<i class="icon-edit bigger-120"></i>
																</button></a>

																<a href="javascript:void(0)" class='del' id="<?= $v['id']?>"><button class="btn btn-xs btn-danger">
																	<i class="icon-trash bigger-120"></i>
																</button></a>

																
															</div>
															
															
													</tr>

													<?php } ?>
														
												
												</tbody>
											</table>
											
										</div><!-- /.table-responsive -->
									</div><!-- /span -->
								</div><!-- /row -->

				
		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script src="assets/js/jquery-2.0.3.min.js"></script>

		

		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

</body>
</html>
<script>
	$(function(){
		$('#all').bind('click',function(){
			_this=$(this);
			console.log(_this.is(':checked'));
			
			if(_this.is(':checked')){
				$("[class = ace]:checkbox").attr("checked", true);
			}else{
				$("[class = ace]:checkbox").attr("checked", false);
			}
		})
		$('.del').click(function(){
			var id=$(this).attr('id');
			var _this=$(this);
			$.get('?r=manager/del',{id:id},function(msg){
				if(msg['state']=='success'){
					_this.parent().parent().parent().remove();
				}else{
					alert('删除失败');
				}
			},'json');
			
		})
	})
</script>
