<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\JobPosition;
use frontend\models\JobRegion;
use frontend\models\JobCompany;
use frontend\models\JobInvite;
use frontend\models\JobOriginator;
use yii\db\Query; 
use frontend\lib\Open;

/**
 * Index controller
 * 拉勾首页
 */
class IndexController extends Controller
{
	/**
	*	构造方法
	*	加载一些方法
	*/
	public $request;
	public $db;
	public $session;
	public $base;
	public function init()
	{
		parent::init();
		$this->session = \Yii::$app->session;
		$this->request = \Yii::$app->request;
		$this->db = new \yii\db\Query();	
		$this->base = \Yii::$app->db;	
	}
	/**
	*	前台首页展示
	*/
	public function actionIndex()
	{
		$open = new \frontend\controllers\Open51094;
		//第三方登录
		if(isset($_GET['code']))
		{
			$code     = $_GET['code'];
			$logInfo = $open->me($code);
			if(isset($logInfo['uniq'])){
				
				// 用户信息存在直接登录否则 录入信息
				$user     = new \frontend\models\JobUser;
				$userInfo = $user->find()->where(['username'=>$logInfo['uniq']])->asArray()->One();
				if(!empty($userInfo))
				{
						$this->session->open();						
						$this->session->set('user',$userInfo['username']);
						$this->session->set('userid',$userInfo['id']);
						$this->session->set('utype',$userInfo['utype']);
				}
				else{
				
					$data =	array(
					'username'     => $logInfo['uniq'],
					'password'     => md5($logInfo['uniq']),
					'u_reg_time'   => time(),								//注册时间
					'u_login_time' => time(),								//登录时间
					'resume_open'  => '1',								    //简历默认公开
					'utype'        => '0'
					);
					$res    = $user->insertid($data);
					$sex    = $logInfo['sex']==1 ? '男' : '女' ;
					//写入个人信息 essInfo表 
					$infoData = array(
						'name'      => $logInfo['name'],
						'sex'       => $sex,
						'img_path'  => $logInfo['img'],
						'uid'       => $res ,
					);
					$essRes = $this->base->createCommand()->insert('job_ess_info',$infoData)->execute();
				
					if($res&&$essRes)
					{
						$this->session->set('user',$data['username']);
						$this->session->set('userid',$res);
						$this->session->set('utype',$data['utype']);
					}
				}
			}
			
		}
		$usually = new \frontend\controllers\Usually;
		$list = $usually->Positionarray();
		$hot = $usually->hotarray();
		return $this->render('index',['position' => $list,'hot' => $hot]);
	}

	/**
	*	公司展示页面
	*/
	public function actionCompanylist()
	{
		return $this->render('companylist');
	}	

	/**
	*	搜索职位
	*/
	public function actionSelpos()
	{
		//职位搜索信息
		$posname = $this->request->get('kd');
		if(!isset($posname))
		{
			$posname = $this->request->post('kd');
		}	
		//网站根目录
      	$job = \Yii::$app->basePath.'/../';
		$pos_str = file_get_contents($job.'/common/config/position.php');
		$pos_array = explode(',',$pos_str);
		//城市
		$data['city'] = JobRegion::find()->where(['agency_id' => 1])->asArray()->all();
		if(in_array($posname,$pos_array))
		{
			//热词字段+1
			$hot_sou = JobPosition::find()->where(['position_name' => $posname])->asArray()->one();				
			$res['hot_num'] = $hot_sou['hot_num']+1;
			JobPosition::updateAll($res,['id'=>$hot_sou['id']]);
			
			//职位
			$sql = "SELECT * FROM job_company AS jc LEFT JOIN job_invite AS ji ON jc.id = ji.company_id LEFT JOIN job_originator AS jo ON ji.company_id = jo.company_id WHERE ji.position_type = '$posname'";
			$data['pos'] = $this->base->createCommand($sql)->queryAll();
		}
		else
		{
			$data['msg'] = "您搜索的内容不存在"; 
		}
		$usually = new \frontend\controllers\Usually;
		$data['hot'] = $usually->hotarray();
		return $this->render('list',$data);	
	}	
}
?>