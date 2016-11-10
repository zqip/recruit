<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\models\JobAdminPrivilege;

AppAsset::register($this);
$session  = \Yii::$app->session;
$session->open();
$db       = \Yii::$app->db;
$name     = $session->get('ad_uname');
$admin_id = $session->get('admin_id');

if($admin_id == "1"){
    $res = $db->createCommand('select * from job_admin_privilege')->queryAll();
}
else{
    $sql = "select u.id,p.*from job_admin_user u INNER JOIN job_user_role ur on u.id=ur.uid INNER JOIN job_admin_role r on ur.rid=r.id INNER JOIN job_role_privilege rp on r.id=rp.rid INNER JOIN job_admin_privilege p on rp.pid=p.id where u.id=$admin_id";
    $res = $db->createCommand($sql)->queryAll();
}
//echo $sql;die;
// print_r($res);die;
$list = array();
foreach ($res as $key => $value) {
    if($value['parent_id'] == 0)
    {
        $list[] = $value;
    }
}
foreach ($list as $key => $value) {
    $id   = $value['id'];
    $data = array();
    foreach ($res as $k => $v) {
        if($v['parent_id']==$id)
        {
            $data[]=$v;
        }
    }
    $list[$key]['son'] = $data;
}
// print_r($list);die;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="assets/js/jquery-2.0.3.min.js"></script>
    <script src="assets/js/ace.min.js"></script>

</head>
<body>
<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>
    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <small>
                    <i class="icon-leaf"></i>
                    job网站后台管理系统
                </small>
            </a>
            <span style="padding-left:900px; color:white;">管理员<?php echo $name; ?>登录<a href="#" style="color:white;padding-left:10px;">设置</a><a href="?r=adminlog/go" style="color:white;padding-left:10px;">退出</a></span>

        </div>
    </div>

</div>
<!--    断点   -->
<div class="main-container-inner">
    <a class="menu-toggler" id="menu-toggler" href="#">
        <span class="menu-text"></span>
    </a>

    <div class="sidebar" id="sidebar">
        <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success">
                    <i class="icon-signal"></i>
                </button>

                <button class="btn btn-info">
                    <i class="icon-pencil"></i>
                </button>

                <button class="btn btn-warning">
                    <i class="icon-group"></i>
                </button>

                <button class="btn btn-danger">
                    <i class="icon-cogs"></i>
                </button>
            </div>

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>

                <span class="btn btn-info"></span>

                <span class="btn btn-warning"></span>

                <span class="btn btn-danger"></span>
            </div>
        </div>

        <ul class="nav nav-list">
            <li class="active">
                <a href="?r=admin/index">
                    <i class="icon-dashboard"></i>
                    <span class="menu-text"> 控制台 </span>
                </a>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-desktop"></i>
                    <span class="menu-text"> 管理员中心 </span>

                    <b class="arrow icon-angle-down"></b>
                </a>

                <ul class="submenu">
                    <li>
                        <a href="?r=manager/manager-add">
                            <i class="icon-double-angle-right"></i>
                            管理员添加
                        </a>
                    </li>

                    <li>
                        <a href="?r=manager/manager-list">
                            <i class="icon-double-angle-right"></i>
                            管理员列表
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-desktop"></i>
                    <span class="menu-text"> 职位管理 </span>

                    <b class="arrow icon-angle-down"></b>
                </a>

                <ul class="submenu">
                    <li>
                        <a href="?r=position/add">
                            <i class="icon-double-angle-right"></i>
                            职位添加
                        </a>
                    </li>

                    <li>
                        <a href="?r=position/list">
                            <i class="icon-double-angle-right"></i>
                            职位列表
                        </a>
                    </li>
                    </ul>

            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-desktop"></i>
                    <span class="menu-text"> 分类管理 </span>

                    <b class="arrow icon-angle-down"></b>
                </a>

                <ul class="submenu">
                    <li>
                        <a href="elements.html">
                            <i class="icon-double-angle-right"></i>
                            添加分类
                        </a>
                    </li>

                    <li>
                        <a href="buttons.html">
                            <i class="icon-double-angle-right"></i>
                            分类管理中心
                        </a>
                    </li>
                    </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-desktop"></i>
                    <span class="menu-text"> 热搜词 </span>

                    <b class="arrow icon-angle-down"></b>
                </a>

                <ul class="submenu">
                    <li>
                        <a href="elements.html">
                            <i class="icon-double-angle-right"></i>
                            添加热搜词
                        </a>
                    </li>

                    <li>
                        <a href="buttons.html">
                            <i class="icon-double-angle-right"></i>
                            热搜管理中心
                        </a>
                    </li>
                    </li>
                </ul>
        <li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> 入驻公司 </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
                <li>
                    <a href="elements.html">
                        <i class="icon-double-angle-right"></i>
                        添加公司
                    </a>
                </li>

                <li>
                    <a href="buttons.html">
                        <i class="icon-double-angle-right"></i>
                        公司管理
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> 权限中心 </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
                <li>
                    <a href="elements.html">
                        <i class="icon-double-angle-right"></i>
                        角色管理
                    </a>
                </li>
                <li>
                    <a href="elements.html">
                        <i class="icon-double-angle-right"></i>
                        角色添加
                    </a>
                </li>
                <li>
                    <a href="elements.html">
                        <i class="icon-double-angle-right"></i>
                        权限管理
                    </a>
                </li>
                <li>
                    <a href="elements.html">
                        <i class="icon-double-angle-right"></i>
                        权限添加
                    </a>
                </li>
            </ul>
        </li>
        </ul>

        <div class="sidebar-collapse" id="sidebar-collapse">
            <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
        </div>

        <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
        </script>
    </div>
    <?php $this->beginBody() ?>

    <!-- <div class="wrap">
    <?php
    /*NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();*/
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
 </div>
  -->

    <?php /*$this->endBody()*/ ?>
</body>
</html>
<?php /*$this->endPage()*/ ?>
