<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * login controller
 * 登陆页面
 */

class LoginController extends Controller
{	
	public $layout = false;
	public $request;
	public $db;
	public $session;
	/**
	*	构造方法
	*	加载一些方法
	*/
	public function init()
	{	
		$this->request   = \Yii::$app->request;         //调用请求组件
		$this->db        = \Yii::$app->db;		        //链接数据库组件
		$this->session   = \Yii::$app->session;         //调用session组件
        $this->session->open();					        //开启session
		parent::init();
	}

	/**
	*	登陆页面展示
	*/
	public function actionLogin()
	{
		return $this->render('login');
	}

	/**
	*	注册展示
	*/
	public function actionRegister()
	{
		$usermod = new \frontend\models\JobUser;
		if ($this->request->post()) 
		{
			$data =	array(
				'username'     => $this->request->post('email'),		//用户名
				'password'     => md5($this->request->post('password')),//密码
				'u_reg_time'   => time(),								//注册时间
				'u_login_time' => time(),								//登陆时间
				'resume_open'  => '1',								    //简历默认公开
				'utype'        => $this->request->post('utype')			//用户类型
			);
			$username = $data['username'];
			$user=$this->db->createCommand("select id from job_user where username='$username'")->queryOne();
			if(!empty($user))
			{
				echo "<script>alert('用户名已存在，请重新填写用户名');location.href='?r=login/register'</script>";die;
			}
			// print_r($data);die;
			$res = $usermod->insertid($data);
			if ($res) 
			{
				$this->session->set('user',$data['username']);
				$this->session->set('userid',$res);
				$this->session->set('utype',$data['utype']);
				if($data['utype']==1)
				{
					echo "<script>alert('注册成功,请填写完整公司信息');location.href='?r=company/addcompanyone'</script>";
				}
				else
				{
					echo "<script>alert('注册成功');location.href='?r=index/index'</script>";
				}

			}
			else
			{
				echo "<script>alert('注册失败');location.href='?r=login/register'</script>";
			}
		}
		else
		{
			return $this->render('register');
		}
	}

	public function actionLog()
	{
		if($this->request->isPost)
		{
			$username=$this->request->post("email");
			$password=md5($this->request->post("password"));
			$res=$this->db->createCommand("select * from job_user where username='$username'")->queryOne();
			if($username==$res["username"])
			{
				if($password==$res["password"])
				{
					$this->session->open();						
					$this->session->set('user',$username);
					$this->session->set('userid',$res['id']);
					$this->session->set('utype',$res['utype']);
					if($res['utype']==1)
					{
						$uid = $res['id'];
						$comp = $this->db->createCommand("select id from job_company where u_id = '$uid'")->queryOne();
						$this->session->set('comp_id',$comp['id']);
					}
					return $this->redirect("?r=index/index");
				}
				else
				{
					echo"<script>alert('密码错误');location.href='?r=login/login'</script>";die();
				}
			}
			else
			{
				echo"<script>alert('用户名错误');location.href='?r=login/login'</script>";die();
			}
		}
	}

	public function actionGo()
	{
		$this->session->open();
		$this->session->remove("user");
		$this->session->remove("userid");
		$this->session->remove("utype");
		return $this->redirect("?r=index/index");
	}
}
?>