<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\JobAdminUser;

/**
 * Adminlog controller
 */
class AdminlogController extends Controller
{
	//关闭layout的使用
	public $layout = false; 
	
	/**
	 * 后台登录方法
	 * @return [type] [description]
	 */
    public function actionIndex()
    {
    	 $request = \yii::$app->request;
    	 if($request->isPost)
    	 {
    	 	$where = array();
    	 	$post  = $request->post();

    	 	$where['u_pwd']  = md5($post['u_pwd']);
    	 	$where['u_name'] = $post['u_name'];
    	 	$userInfo        = JobAdminUser::find()->select("id,u_name")->where($where)->asArray()->one();
    	 	if(empty($userInfo))
    	 	{
        		die("<script>alert('用户名或密码输入有误！请重新输入');location.href='index.php?r=adminlog/index';</script>");
    	 	}
            JobAdminUser::updateAll(['u_login_time'=>time()],$where);
            $ad_uname = $userInfo['u_name'];
    	 	$admin_id = $userInfo['id'];
    	 	$session  = \Yii::$app->session;
			$session->open();
            $session->set('ad_uname',$ad_uname);
    	 	$session->set('admin_id',$admin_id);
    	 	return $this->redirect("index.php?r=admin/index");
    	 }
    	 else{
       		return $this->render('login');
    	 }
    }

    /**
     * 管理员退出
    *@brief
    *@parem
    *@return
    */
    public function actionGo()
    {
        $session  = \Yii::$app->session;
        $session->open();
        $session->remove("user");
        $session->remove("admin_id");
        return $this->redirect("?r=adminlog/index");
    }
}
