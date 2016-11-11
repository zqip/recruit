<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Common controller
 */
class CommonController extends Controller
{
	/**
	* 构造方法
	* 接值:$request 数据库:$db 添加cookie:$cookies_add 获取cookie:$cookies_sel 设置session:$session
	* 公共
	*/
	public $request;
	public $db;
	public $cookies_ad;
	public $cookies_co;
	public $session;
    public function init()
    {
        parent::init();
		$this->request = \Yii::$app->request;
		$this->db = \Yii::$app->db;
		$this->cookies_ad = Yii::$app->response->cookies;
		$this->cookies_co = Yii::$app->request->cookies;
		$this->session = \Yii::$app->session;
		$this->session->open();
		if(!empty($this->cookies_co->get('ad_uname'))&&empty($this->session->get('ad_uname'))){
    		//给session赋值=cookie
    		$name = $this->cookies_co->get('ad_uname');
    		$this->session->set('ad_uname',$name);
    	}
        if(empty($this->session->get('ad_uname'))){
        	echo"<script>alert('请先登录');location.href='index.php?r=adminlog/index'</script>";die();
        }
    }
}
