<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>管理首页</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- basic styles -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" />

    <!--[if IE 7]>
    <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
    <![endif]-->

    <!-- page specific plugin styles -->
        <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="assets/css/chosen.css" />
        <link rel="stylesheet" href="assets/css/datepicker.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="assets/css/daterangepicker.css" />
        <link rel="stylesheet" href="assets/css/colorpicker.css" />

    <!-- fonts -->

    <!-- fonts -->

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

    <!-- ace styles -->

    <link rel="stylesheet" href="assets/css/ace.min.css" />
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="assets/css/ace-skins.min.css" />

    <!-- [if lte IE 8]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif] -->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->

    <script src="assets/js/ace-extra.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <script src="assets/js/jquery.autosize.min.js"></script>
    <![endif]-->
    <!--[if IE 7]>
    <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
    <![endif]-->

    <!-- page specific plugin styles -->

    <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
    <link rel="stylesheet" href="assets/css/chosen.css" />
    <link rel="stylesheet" href="assets/css/datepicker.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
    <link rel="stylesheet" href="assets/css/daterangepicker.css" />
    <link rel="stylesheet" href="assets/css/colorpicker.css" />

    <!-- fonts -->

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

    <!-- ace styles -->

    <link rel="stylesheet" href="assets/css/ace.min.css" />
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
</head>

<body>
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>
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
                    入驻公司
                    <small>
                        <i class="icon-double-angle-right"></i>
                        公司添加
                    </small>
                </h1>
            </div>
            <!--form-->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <form class="form-horizontal"  id="comForm" action="?r=company/companyadd" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_csrf" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                        <input type="hidden" name="utype"  value="1" />
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公司名称： </label>

                            <div class="col-sm-5">
                                <input type="text"  name="comp_name" placeholder="公司名称" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="space-4"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公司简称： </label>

                            <div class="col-sm-5">
                                <input type="text" id="comp_abb" name="comp_abb" placeholder="公司简称" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="space-4"></div>
                       <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 邮箱： </label>

                            <div class="col-sm-5">
                                <input type="email" id="username" name="username" placeholder="******@sina.cn" class="col-xs-10 col-sm-5" /><span style="color:red">用于登录,不支持QQ邮箱</span>
                            </div>
                        </div>

                        <div class="space-4"></div>
                         <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 密码： </label>

                            <div class="col-sm-5">
                                <input type="password" id="password" name="password" placeholder="" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="space-4"></div>

                         <div class="space-4"></div>
                         <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 确认密码： </label>

                            <div class="col-sm-5">
                                <input type="password" id="c_password" name="c_password" placeholder="" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="space-4"></div>


                         <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公司LOGO： </label>

                            <div class="col-sm-5">
                                <input type="file" id="comp_logo" name="comp_logo" placeholder="" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="space-4"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公司网址： </label>

                            <div class="col-sm-5">
                                <input type="text" id="comp_url" name="comp_url" placeholder="http://www.baidu.com" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>



                        <div class="space-4"></div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 公司所在城市： </label>

                            <div class="col-sm-5">
                                <input type="text" id="comp_city" name="comp_city" placeholder="北京市" class="col-xs-10 col-sm-5" />
                            </div>
                        </div>

                        <div class="space-4"></div>


                        <div class="form-group">

                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 行业：</label>

                            <div class="col-sm-2">
                                <select class="form-control" id="industry_sector" name="industry_sector">
                                    <option value="移动互联网">移动互联网</option>
                                    <option value="教育">教育</option>
                                    <option value="云计算大数据">云计算大数据</option>
                                    <option value="电子商务">电子商务</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-4"></div>


                        <div class="form-group">

                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 融资：</label>

                            <div class="col-sm-2">
                                <select class="form-control" id="comp_stage" name="comp_stage">
                                    <option value="未融资">未融资</option>
                                    <option value="移动互联网">A轮</option>
                                    <option value="移动互联网">B轮</option>
                                    <option value="移动互联网">C轮</option>
                                    <option value="移动互联网">D轮及以上</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 公司规模：</label>

                            <div class="col-sm-2">
                                <select class="form-control" id="comp_scale" name="comp_scale">
                                    <option value="少于15人">少于15人</option>
                                    <option value="100人">100人</option>
                                    <option value="100--1000人">100--1000人</option>
                                    <option value="1000人以上">1000人以上</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">

                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 公司介绍：</label>

                            <div class="col-sm-2">
                                <textarea id="comp_self" name="comp_self" id="comp_self" class="autosize-transition form-control"></textarea>
                            </div>
                        </div>

                        <div class="space-4"></div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">

                                <input type="submit" value="Submit" class="btn btn-info"/>
                                &nbsp; &nbsp; &nbsp;
                                <input type="reset" value="Reset" class="btn"/>
                            </div>
                        </div>
                    </form>

                </div><!-- /.col -->
            </div><!-- /.row -->
            <!--end form-->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->

        </div><!-- /.page-content -->
    </div><!-- /.main-content -->

    <div class="ace-settings-container" id="ace-settings-container">
        <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
            <i class="icon-cog bigger-150"></i>
        </div>

        <div class="ace-settings-box" id="ace-settings-box">
            <div>
                <div class="pull-left">
                    <select id="skin-colorpicker" class="hide">
                        <option data-skin="default" value="#438EB9">#438EB9</option>
                        <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                        <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                        <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                    </select>
                </div>
                <span>&nbsp; 选择皮肤</span>
            </div>

            <div>
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                <label class="lbl" for="ace-settings-navbar"> 固定导航条</label>
            </div>

            <div>
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                <label class="lbl" for="ace-settings-sidebar"> 固定滑动条</label>
            </div>

            <div>
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                <label class="lbl" for="ace-settings-breadcrumbs">固定面包屑</label>
            </div>

            <div>
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                <label class="lbl" for="ace-settings-rtl">切换到左边</label>
            </div>

            <div>
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                <label class="lbl" for="ace-settings-add-container">
                    切换窄屏
                    <b></b>
                </label>
            </div>
        </div>
    </div><!-- /#ace-settings-container -->
</div><!-- /.main-container-inner -->

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->

<script src="assets/js/jquery-2.0.3.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.10.2.min.js"></script>
<![endif]-->

<!--[if !IE]> -->

<script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"script>");
</script>
<![endif]-->

<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/typeahead-bs2.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
<script src="assets/js/excanvas.min.js"></script>
<![endif]-->

<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
<script src="assets/js/jquery.sparkline.min.js"></script>
<script src="assets/js/flot/jquery.flot.min.js"></script>
<script src="assets/js/flot/jquery.flot.pie.min.js"></script>
<script src="assets/js/flot/jquery.flot.resize.min.js"></script>

<!-- ace scripts -->

<script src="assets/js/ace-elements.min.js"></script>


<!-- inline scripts related to this page -->


<script src="style/js/jquery.1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="style/js/jquery.lib.min.js"></script>
<script>
    $("#comForm").validate({
        rules: {
            comp_name:{
                required: true
            },
            username:{
                required:true,
                email:true
            },
            password:{
                required:true,
                rangelength:[3,10]
            },
            c_password:{
                equalTo:"#password"
            }

        },
        messages: {
            comp_name:{
                required:"<font color = 'red'>请输入公司名称 </font>"
            },
            username:{
                email:"<font color = 'red'>正确的邮箱地址 </font>",
                required:"<font color = 'red'>正确的邮箱地址 </font>"
            },
            password:{
                required: "<font color = 'red'>不能为空</font>",
                rangelength: $.format("密码最小长度:{0}, 最大长度:{1}。")
            },
            c_password:{
                equalTo:"<font color = 'red'>两次密码输入不一致</font>"
            }


        }


    });
</script>

</body>
</html>

