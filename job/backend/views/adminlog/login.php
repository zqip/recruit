<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>登录页面 - Bootstrap后台管理系统</title>
<meta name="keywords" content="Bootstrap模版,Bootstrap模版下载,Bootstrap教程,Bootstrap中文" />
<meta name="description" content="站长素材提供Bootstrap模版,Bootstrap教程,Bootstrap中文翻译等相关Bootstrap插件下载" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- basic styles -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />
<!-- ace styles -->
<link rel="stylesheet" href="assets/css/ace.min.css" />
<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
</head>
<body class="login-layout" style="background-image:url(images/1.jpg);  background-size:100%;">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <i class="icon-leaf green"></i>
                            <span class="red">Ace</span>
                            <span class="white">Application</span>
                        </h1>
                        <h4 class="blue">&copy; Company Name</h4>
                    </div>
                    <div class="space-6"></div>
                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h5 class="header blue lighter bigger">
                                        <i class="icon-coffee green"></i>
                                            Welcome to the four
                                    </h5>
                                    <div class="space-6"></div>
                                    <form method="post" action="index.php?r=<?=\yii\helpers\Url::to('adminlog/index') ?>">
                                    <input name="_csrf" value="<?php echo \yii::$app->request->csrfToken;?>"  type="hidden"/>
                                        <fieldset>
                                            <label class="block clearfix">
                                                <span class="block input-icon input-icon-right">
                                                    <input type="text" class="form-control" placeholder="Username" name="u_name" />
                                                    <i class="icon-user"></i>
                                                </span>
                                            </label>

                                            <label class="block clearfix">
                                                <span class="block input-icon input-icon-right">
                                                    <input type="password" class="form-control" placeholder="Password" name='u_pwd'/>
                                                    <i class="icon-lock"></i>
                                                </span>
                                            </label>

                                            <div class="space"></div>

                                            <div class="clearfix">
                                                <label class="inline">
                                                    <input type="checkbox" class="ace" name="remember" />
                                                    <span class="lbl"> Remember Me</span>
                                                </label>

                                                <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                    <i class="icon-key"></i>
                                                    Login
                                                </button>
                                            </div>

                                            <div class="space-4"></div>
                                        </fieldset>
                                    </form> 
                         </div><!-- /position-relative -->
                     </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
</div><!-- /.main-container -->
<script src="assets/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>
<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    function show_box(id) {
     jQuery('.widget-box.visible').removeClass('visible');
     jQuery('#'+id).addClass('visible');
    }
</script>
</body>
</html>