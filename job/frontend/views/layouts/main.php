<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$session = YII::$app->session;
$session->open();
$utype   = empty($session->get('utype')) ? 0 : $session->get('utype');
$comp_url= $utype == 0 ? "?r=company/companylist" : "?r=company/companyself";
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
</head>
<body>
        <div id="header">
        <div class="wrapper">
            <a href="?r=index/index" class="logo">
                <img src="style/images/logo.png" width="229" height="43" alt="拉勾招聘-专注互联网招聘" />
            </a>
            <ul class="reset" id="navheader">
                <li ><a href="?r=index/index">首页</a></li>
                <li ><a href="?r=company/companylist" >公司</a></li>
                <li ><a href="#" target="_blank">论坛</a></li>
                <?php if( $utype == 0 ){ ?>

                                    <li ><a href="?r=myself/resume" rel="nofollow">我的简历</a></li>
                <?php  }else{  ?>

                                    <li ><a href="?r=company/companyself" rel="nofollow">我的公司</a></li>
                                                    <li ><a href="?r=company/positionadd" rel="nofollow">发布职位</a></li>
                 <?php } ?>
                            </ul>
                        <?php if (empty($session->get("user"))) { ?> 
                          <ul class="loginTop">
                <li><a href="?r=login/login" rel="nofollow">登录</a></li> 
                <li>|</li>
                <li><a href="?r=login/register" rel="nofollow">注册</a></li>
                        </ul>
                  <?php } else { ?>
                <dl class="collapsible_menu">
                <dt>
                    <span><?php
                     $essInfo = new \frontend\models\JobEssInfo;
                     $userid  = $session->get("userid");
                     $name    = $essInfo->find()->select('name')->where(['uid'=>$userid])->asArray()->One();
                     echo empty($name) ? $session->get("user") : $name['name']; 
                     ?>&nbsp;</span> 
                    <span class="red dn" id="noticeDot-0"></span>
                    <i></i>
                </dt>
                   <?php if( $utype == 0 ){ ?>
                                    <dd><a rel="nofollow" href="?r=myself/resume">我的简历</a></dd>
                       <?php  }else{  ?>
                                    <dd><a rel="nofollow" href="?r=company/companyself">我的公司</a></dd>
                    <dd><a href="?r=company/positionadd">我要招人</a></dd>
                        <?php } ?>
                                        <dd><a href="collections.html">我收藏的职位</a></dd>
                                                            <dd class="btm"><a href="subscribe.html">我的订阅</a></dd>
                                                <dd><a href="?r=personal/accountbind">帐号设置</a></dd>
                                <dd class="logout"><a rel="nofollow" href="?r=login/go">退出</a></dd>
            </dl>
                                    <div class="dn" id="noticeTip">
                                    </div>
                 <?php } ?>
                                </div>
    </div>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>


    <div id="footer">
    <div class="wrapper">
        <a href="h/about.html" target="_blank" rel="nofollow">联系我们</a>
        <a href="h/af/zhaopin.html" target="_blank">互联网公司导航</a>
        <a href="http://e.weibo.com/lagou720" target="_blank" rel="nofollow">拉勾微博</a>
        <a class="footer_qr" href="javascript:void(0)" rel="nofollow">拉勾微信<i></i></a>
        <div class="copyright">&copy;2013-2014 Lagou <a target="_blank" href="http://www.miitbeian.gov.cn/state/outPortal/loginPortal.action">京ICP备14023790号-2</a></div>
    </div>
</div>
</body>
</html>
