<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * common controller
 * 前台公共控制器
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
	public $upload;
    public function init()
    {
        parent::init();
		$this->request = \Yii::$app->request;
		$this->db = \Yii::$app->db;
		$this->cookies_ad = Yii::$app->response->cookies;
		$this->cookies_co = Yii::$app->request->cookies;
		$this->session = \Yii::$app->session;
		$this->upload  = new UploadedFile();
		$this->session->open();
		if(!empty($this->cookies_co->get('ad_uname'))&&empty($this->session->get('user'))){
    		//给session赋值=cookie
    		$name = $this->cookies_co->get('ad_uname');
    		$this->session->set('user',$name);
    	}
        if(empty($this->session->get('user'))){
        	echo"<script>alert('请先登录');location.href='index.php?r=login/login'</script>";die();
        }
    }
}
