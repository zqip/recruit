<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Compeny controller
 * 公司
 */
class CompanyController extends CommonController
{
	// public $layout = false;
	public function init()
	{
		parent::init();
	}


	public function actionAddcompanyone()
	{
		return $this->render("addcompanyone");
	}


	public function actionAddone()
	{
		$com = new \frontend\models\JobCompany;
		$filename    = $this->upload->getInstanceByName('myfile');
		$img         = $_FILES['myfile'];
		$path_img    = pathinfo($filename);
		$this->upload->tempName = $img['tmp_name'];
		if($path_img['extension'])
		{
			$img_path    = 'company_logo/'.time().rand(1000,9999).'.'.$path_img['extension'];
		}
		else
		{
			echo"<script>alert('请添加照片');location.href='?r=company/addcompanyone'</script>";die();
		}
		$img_path    = time().rand(1000,9999).'.'.$path_img['extension'];
		$uid=$this->session->get("userid");
		$data=[
			"comp_name"=>$this->request->post("comp_name"),
			"comp_abb"=>$this->request->post("comp_abb"),
			"comp_url"=>$this->request->post("comp_url"),
			"comp_city"=>$this->request->post("comp_city"),
			"comp_stage"=>$this->request->post("comp_stage"),
			"comp_self"=>$this->request->post("comp_self"),
			"comp_scale"=>$this->request->post("select_scale_hidden"),
			"industry_sector"=>$this->request->post("select_industry_hidden"),
			"comp_logo"=>$img_path,
			"u_id"=>$uid,
		];
		// print_r($data);die;
		$res = $com->insertid($data);
		if($res)
		{
			$this->session->set('comp_id',$res);
			$this->upload->saveAs('company_logo/'.$img_path);//保存文件
			return $this->redirect("?r=company/addcompanytwo");
		}
		else
		{
			echo"<script>alert('添加失败');location.href='?r=company/addcompanyone'</script>";die();
		}
	}


	public function actionAddcompanytwo()
	{
		return $this->render("addcompanytwo");
	}


	public function actionAddtwo()
	{
		$filename    = $this->upload->getInstanceByName('myfile');
		$img         = $_FILES['myfile'];
		$path_img    = pathinfo($filename);
		$this->upload->tempName = $img['tmp_name'];
		if(isset($path_img['extension'])){
			$img_path    = 'ori_pic/'.time().rand(1000,9999).'.'.$path_img['extension'];
		}
		else{
			$img_path    = '';
		}
		$comp_id=$this->session->get("comp_id");
		$data=[
			"originator"=>$this->request->post("originator"),
			"ori_pos"=>$this->request->post("ori_pos"),
			"ori_sina"=>$this->request->post("ori_sina"),
			"ori_self"=>$this->request->post("ori_self"),
			"company_id"=>$comp_id,
			"ori_pic"=>$img_path
		];
		$res=$this->db->createCommand()->insert("job_originator",$data)->execute();
		if($res)
		{
			if(isset($path_img['extension'])) {
				$this->upload->saveAs($img_path);//保存文件
			}
		 	echo"<script>location.href='?r=company/companyself'</script>";die();
		}
		else
		{
			echo"<script>alert('添加失败 重新编辑');location.href='?r=company/addcompanytwo'</script>";die();
		}
	}
	public function actionCompanyself()
	{
		$usually = new \frontend\controllers\Usually;
		if($usually->compInfo()){
			$uid=$this->session->get("userid");
			$arr=$this->db->createCommand("select  * from job_company jc left join job_originator jo on jc.id=jo.company_id where jc.u_id=$uid")->queryOne();
			return $this->render("companyself",["arr"=>$arr]);
		}
	}
		/*
	*发布职位展示
	 */
	public function actionPositionadd(){
		$usually = new \frontend\controllers\Usually;
		if($usually->compInfo()){
			$invite     = new \frontend\models\JobInvite;
			$company_id = $this->session->get('comp_id');
			$inviteList = $invite->find()->where(['company_id'=>$company_id])->asArray()->All();
			return $this->render('positions',['inviteList'=>$inviteList]);
		}
	}
	/*
	*发布新的职位
	 */
	public function actionCreate(){
		$request=\yii::$app->request;
		if($request->isPost){
			
			$post = $request->post();
			//print_r($post);die;
			unset($post['_csrf']);
			unset($post['resubmitToken']);
			
			$con=\yii::$app->db;
			$res=$con->createCommand()->insert('job_invite',[
	            'company_id' => $post['company_id'],
	            'position_type' => $post['position_type'],
	            'position_name' =>$post['position_name'],
	            'office' => $post['office'],
	            'money_start' => $post['money_start'],
	            'money_end' => $post['money_end'],
	            'region' => $post['region'],
	            'jobnature' => $post['jobnature'],
	            'jobexp' => $post['jobexp'],
	            'jobedu' => $post['jobedu'],
	            'jobtempt' => $post['jobtempt'],
	            'jobself' => $post['jobself'],
	            'jobaddress' => $post['jobaddress'],
	            'resume_email' =>$post['resume_email'],

				])->execute();
				/*$jobinvite = new \frontend\models\JobInvite;
                $res = $jobinvite->addData($post);*/
			if($res)
			{
				echo "<script> alert('发布成功');location.href='?r=company/positionadd'</script>";die();
			}else
			{
				die("<script>alert('发布失败');window.history.go(-1);</script>");
			}
		}else{
			//查询公司id
			$uid        = $this->session->get('userid');
			$company_id = $this->session->get('comp_id');
			//传值到职位数组
			$com  = new \frontend\controllers\Usually;
			$list = $com->Positionarray();
			//print_r($list);die;
			return $this->render('create',['position'=>$list,'company_id'=>$company_id]);
		}
	}

	
	/*
	 修改公司的介绍
	  */
	public function actionUpdatecompanyself()
	{
		if($this->request->isPost)
		{
			$id=$this->request->post("id");
			$comp_self=$this->request->post("text");
			$res=$this->db->createCommand()->update("job_company",['comp_self'=>$comp_self],['id'=>$id])->execute();
			if($res)
			{
				echo "1";
			}
			else
			{
				echo "2";
			}
		}
		else
		{
			echo "3";
		}
	}
	/*
	 * 修改公司的阶段
	 * */
	public function actionUpdatecompanystage()
	{
		if($this->request->isPost)
		{
			$id=$this->request->post("id");
			$comp_stage=$this->request->post("stage");
			$res=$this->db->createCommand()->update("job_company",['comp_stage'=>$comp_stage],['id'=>$id])->execute();
			if($res)
			{
				echo "1";
			}
			else
			{
				echo "2";
			}
		}
		else
		{
			echo "3";
		}
	}
	/*
	 * 修改公司的细节问题
	 * */
	public function actionUpdatecompanycsu()
	{
		if($this->request->isPost)
		{
			$id=$this->request->post("id");
			$scale=$this->request->post("scale");
			$url=$this->request->post("url");
			$city=$this->request->post("city");
			$res1=$this->db->createCommand()->update("job_company",['comp_city'=>$city],['id'=>$id])->execute();
			$res2=$this->db->createCommand()->update("job_company",['comp_url'=>$url],['id'=>$id])->execute();
			$res3=$this->db->createCommand()->update("job_company",['comp_scale'=>$scale],['id'=>$id])->execute();
			if($res1||$res2||$res3)
			{
				echo "1";
			}
			else
			{
				echo "2";
			}
		}
		else
		{
			echo "3";
		}
	}
	/*
	 * 修改创始人资料
	 * */
	public function actionUpdateori()
	{
		if($this->request->isPost)
		{
			$id=$this->request->post("id");
			$originator=$this->request->post("originator");
			$ori_pos=$this->request->post("ori_pos");
			$ori_sina=$this->request->post("ori_sina");
			$ori_self=$this->request->post("ori_self");
			$res1=$this->db->createCommand()->update("job_originator",['originator'=>$originator],['id'=>$id])->execute();
			$res2=$this->db->createCommand()->update("job_originator",['ori_pos'=>$ori_pos],['id'=>$id])->execute();
			$res3=$this->db->createCommand()->update("job_originator",['ori_sina'=>$ori_sina],['id'=>$id])->execute();
			$res4=$this->db->createCommand()->update("job_originator",['ori_self'=>$ori_self],['id'=>$id])->execute();
			if($res1||$res2||$res3||$res4)
			{
				echo "1";
			}
			else
			{
				echo "2";
			}
		}
		else
		{
			echo "3";
		}
	}
	/**
	 * 展示全部公司
	 */
	public function actionCompanylist()
	{
		$data    = array();
		$company = new \frontend\models\JobCompany;
		$invite  = new \frontend\models\JobInvite;
		$comList = $company->getAll();
		foreach ($comList as $key => $value) {
			$company_id = $value['id'];
			$comList[$key]['invite'] = $invite->getOneWhere(['company_id'=>$company_id]);
		}

		 // print_r($comList);die;
		$data['comList'] = $comList;
		return $this->render('companylist',$data);
	}
}