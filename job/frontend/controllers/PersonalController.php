<?php
namespace frontend\controllers;

use Yii;
use frontend\models\JobUser;
use frontend\models\JobEssInfo;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Index controller
 * 拉勾个人用户
 */

class PersonalController extends CommonController
{
	public $request;
	public $db;
	public $session;
	public $nickname;
	public $sex;
	public $img_path;
	public $pid;
	/**
	*	构造方法
	*	加载一些方法
	*/
	public function init()
	{	
		$this->session   = \Yii::$app->session;       //调用session组件
        $this->session->open();					       //开启session
		$uid=$this->session->get('userid');
        $res=JobEssInfo::find()->where(['uid'=>$uid])->asArray()->one();
		$this->nickname  = $res['name'];
		$this->sex       =$res['sex'];
		$this->img_path  =$res['img_path'];
		$this->pid        =$res['id'];
 		parent::init();
	}
	/**
	*	我的账号设置页面
	*/	
	//修改个人信息
	public function actionAccountbind()
	{
		$request   = \Yii::$app->request;
		$id        =$this->pid;
		$name      =$this->nickname;
		$sex       =$this->sex;
		$img_path  =$this->img_path;
		if($request->isPost){
			$post=$request->post();
			unset($post['_csrf']);
			$id=$request->post('id');
			if(isset($_FILES['img_path'])){
				$filename    = $this->upload->getInstanceByName('img_path'); 
		    	$img         = $_FILES['img_path'];
		    	$path_img    = pathinfo($filename);
			}else{
				echo '<script>alert("请选择上传文件");window.history.go(-1);</script>';
	            die;
			}
	    	
	    	if(isset($path_img['extension']))
	    	{
	    		$this->upload->tempName = $img['tmp_name'];					 
		    	$img_path    = 'headerFile/'.time().rand(1000,9999).'.'.$path_img['extension'];			 
		    	if(!is_dir('headerFile'))
	        	{
	        		mkdir('headerFile');
	        	}
	            $res = $this->upload->saveAs($img_path);
	            $data= array('name'=>$post['name'],'sex'=>$post['sex'],'img_path'=>$img_path);
	            //echo $res;die;
	        }
	        else{
	            $data= array('name'=>$post['name'],'sex'=>$post['sex']);
	        }
	            	$res=JobEssInfo::updateAll($data,['id'=>$id]);
					if($res)
					{
						echo '<script>alert("修改成功");window.history.go(-1);</script>';
					}
					else{
						echo '<script>alert("修改成功");window.history.go(-1);</script>';
					}
	    	
		
		}else{
			return $this->render('accountbind',['name'=>$name,'sex'=>$sex,'img_path'=>$img_path,'id'=>$id]);
		}
		
	}

	
	//修改密码
	public function actionUpdatepwd()
	{
		$email=$this->session->get('user');
		$name=$this->nickname;
		$request= \Yii::$app->request;
		if($request->isAjax)
		{
			$password =md5($request->post('password'));
			$userInfo = JobUser::find()->where(['username'=>$email])->asArray()->one();
			if($password!=$userInfo['password']){
				echo 0;die;
			}else{
				echo 1;die;
			}
		}
		if($request->isPost){
			
			$password =md5($request->post('password'));
			$userInfo = JobUser::find()->where(['username'=>$email])->asArray()->one();
			if($password!=$userInfo['password']){
				die("<script> alert('密码输入不对！！看不懂啊？？傻吊！');window.history.go(-1);</script>");
			}
			$newpassword=md5($request->post('newpassword'));
			if($password==$newpassword)
			{
				die("<script> alert('原密码不能和新密码一致！');window.history.go(-1);</script>");
			}
			if(JobUser::updateAll(['password'=>$newpassword],['username'=>$email])){
                $this->session->open();
				$this->session->remove("user");
                echo "<script> alert('修改成功');location.href='?r=login/login';</script>";
            }else{
            	
            	echo "<script> alert('修改失败');window.history.go(-1);</script>";
            }
		}else{
			return $this->render('updatepwd',['name'=>$name,'email'=>$email]);
		}
	}
}
