<?php
namespace frontend\controllers;

use Yii;
use frontend\models\JobPosition;
use yii\db\Query; 

class Usually
{
	public $db;
	public $dase;
	public function __construct()
	{
		$this->db = new \yii\db\Query();
		$this->dase = \Yii::$app->db;	
	}
	public function Positionarray()
	{
		//传值到首页的职位数组
		$list = array();	
		$res = $this->db->select('*')->from('job_position')->all();
		//无限极添加(顶级)
		foreach($res as $k => $v)
		{
			if($v['parent_id'] == 0)
			{
				$list[] = $v;
			}
		}
		//无限极添加(二级)
		foreach($list as $k => $v)
		{
			$id = $v['id'];
			$res_two = array();
			foreach($res as $ke => $va)
			{
				if($va['parent_id'] == $id)
				{
					$res_two[] = $va;
				}
			}
			$list[$k]['son'] = $res_two;
		}
		//无限极添加(三级)
		foreach($list as $key => $val)
		{
			foreach($val['son'] as $k => $v)
			{
				$id = $v['id'];
				$res_three = array();
				foreach($res as $ke => $va)
				{
					if($va['parent_id'] == $id)
					{
						$res_three[] = $va;
					}
				}
				$list[$key]['son'][$k]['grandson'] = $res_three;
			}
		}
		//无限极添加(isshow)左侧职位展示数组
		foreach($list as $key => $val)
		{
			foreach($val['son'] as $k => $v)
			{
				$id = $v['id'];
				$left_position = array();
				foreach($res as $ke => $va)
				{
					if($va['parent_id'] == $id && $va['is_show'] == 1)
					{
						$left_position[] = $va;
					}
				}
				$list[$key]['son'][$k]['isshow'] = $left_position;
			}
		}
		return $list;
	}
	/**
	 * 职位名数组
	*@brief
	*@parem
	*@return
	*/
	public function positionarray2()
	{
		//网站根目录
      	$job = \Yii::$app->basePath.'/../';
      	$position = file_get_contents($job.'/common/config/position.php');
      	$position = explode(',',$position);
      	return $position;
	}
	/*
	 * 热词
	 */
	public function hotarray()
	{
		$sql = 'select position_name from job_position order by hot_num desc limit 10';
		$arr = $this->dase->createCommand($sql)->queryAll();
		return $arr;
	}
	/**
	 * 验证公司信息填写完整度
	 */
	public function compInfo()
	{
		$user    = new \frontend\models\JobUser;
		$company    = new \frontend\models\JobCompany;
		$session = \Yii::$app->session;
		$session->open();
		$uid     = $session->get('userid');
		$utype   = $user->find()->select('utype')->where(['id'=>$uid])->asArray()->One();
		if($utype['utype'] == 0)
		{
			die("<script>alert('非法操作');window.history.go(-1);</script>");
		}
		else{
			$info = $company->find()->select('id')->where(['u_id'=>$uid])->asArray()->One();
			// return empty($info) ? false : true;
			if(empty($info)){
				echo "<script>alert('请填写完整公司信息');location.href='?r=company/addcompanyone'</script>";
			}
			else{
				return true;
			}
		}
	}
}
?>