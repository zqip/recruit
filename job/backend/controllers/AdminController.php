<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Admin controller
 */
class AdminController extends CommonController
{
	/**后台首页
	*@brief
	*@parem
	*@return
	*/
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * 管理员添加
     * @brief 管理员添加
     * */
    public function actionAdminadd(){
        return $this->render('adminAdd');
    }

}
