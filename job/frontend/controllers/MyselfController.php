<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use frontend\models\JobEssInfo;

/**
 * Myself controller
 * 拉勾个人用户
 */
class MyselfController extends CommonController
{
	/**
	*	构造方法
	*	加载一些方法
	*/
	public function init()
	{
		parent::init();
	}
	/**
	*	我的简历展示页面
	*/
	public function actionResume()
	{
		$uid  = $this->session->get('userid');
		$sql  = "SELECT * FROM job_ess_info WHERE uid = $uid";
		$arr['BasicList'] = $this->db->createCommand($sql)->queryOne();
		$sql  = "SELECT * FROM job_experience WHERE u_id =$uid";
		$arr['WorkList'] = $this->db->createCommand($sql)->queryAll();
		$sql  = "SELECT * FROM job_education WHERE u_id =$uid";
		$arr['education'] = $this->db->createCommand($sql)->queryOne();
		return $this->render('resume',$arr);
	}
	/**
	*	我的简历基本信息
	*/
	public function actionBasic()
	{
		if($this->request->ispost)
		{
			$BasicList = $this->request->post();
			unset($BasicList['_csrf']);
			$BasicList['uid'] = $this->session->get('userid');
			$uid  =  $BasicList['uid'];
			$sql  =  "SELECT * FROM job_ess_info WHERE uid = '$uid'";
			$res  =  $this->db->createCommand($sql)->queryOne();
			
			//有关文件操作
			$filename    = $this->upload->getInstanceByName('headPic'); 
	    	$img         = $_FILES['headPic'];
	    	$path_img    = pathinfo($filename);
	    	
	    	if(isset($path_img['extension']))
	    	{
	    		$this->upload->tempName = $img['tmp_name'];					 
		    	$img_path    = 'headerFile/'.time().rand(1000,9999).'.'.$path_img['extension'];			 
		    	$BasicList['img_path'] = $img_path;
	    	}
		    	
	    
	    	
			if ($res) 
			{
				if(!isset($path_img['extension']))
				{
					$BasicList['img_path'] = $res['img_path'];
				}
				// $sql = "DELETE FROM job_ess_info WHERE uid = '$uid'";
				// $del = $this->db->createCommand($sql)->query();
				
				$res  = $this->db->createCommand()->update('job_ess_info',$BasicList,['uid'=>$uid])->execute();
    			if ($res) 
    			{
    				if(!is_dir('headerFile'))
    				{
    					mkdir('headerFile');
    				}
    				if(isset($path_img['extension']))
	    			{
    					$res = $this->upload->saveAs($img_path);		//保存文件
    				}
    				if ($res) 
    				{
    			  		echo "<script>alert('保存成功');location.href='?r=myself/resume'</script>";
    				}
    				else
    				{
    			  		echo "<script>alert('头像上传失败');location.href='?r=myself/resume'</script>";
    				}	
    			}
    			else
    			{
    				die("<script>alert('保存失败');location.href='?r=myself/resume'</script>");
    			}
				
			}
			else
			{
				if(!isset($BasicList['img_path']))
				{
					$BasicList['img_path'] = '.';
				}


				$res  = $this->db->createCommand()->insert('job_ess_info',$BasicList)->execute();
	    		if ($res) 
	    		{
	    			if(isset($path_img['extension']))
	    			{
	    				$res = $this->upload->saveAs($img_path);		//保存文件
	    			}
	    			if ($res) 
	    			{
	    			  echo "<script>alert('保存成功');location.href='?r=myself/resume'</script>";
	    			}
	    			else
	    			{
	    			  echo "<script>alert('头像上传失败');location.href='?r=myself/resume'</script>";
	    			}
	    		}
	    		else
	    		{
	    			die("<script>alert('保存失败');location.href='?r=myself/resume'</script>");
	    		}
			}
	    	
		}
		else
		{
			die("<script>alert('没有接受到数据');location.href='?r=myself/resume'</script>");
		}
	}
	/**
	*	我的简历工作经历
	*/	
	public function actionWork()
	{
		if($this->request->ispost)
		{
			$WorkList = [
				'company'      => $this->request->post('company'),
				'position'     => $this->request->post('position'),
				'start_time'   => $this->request->post('companyYearStart').'-'.$this->request->post('companyMonthStart'),
				'end_time'     => $this->request->post('companyYearEnd').'-'.$this->request->post('companyMonthEnd'),
				'u_id'         => $this->session->get('userid')
			];
			$uid  =  $WorkList['u_id'];
			$rel  =  $this->db->createCommand()->insert('job_experience',$WorkList)->execute();
			if ($rel) 
			{
				echo "<script>alert('保存成功');location.href='?r=myself/resume'</script>";
			}
		    else
		    {
			    echo "<script>alert('保存失败');location.href='?r=myself/resume'</script>";
		    }
				
		}
		else
		{
			die("<script>alert('没有接受到数据');location.href='?r=myself/resume'</script>");
		}
	}
	/**
	*	我的简历教育背景
	*/		
	public function actionEducation()
	{
		if ($this->request->ispost) {
			$EducationList  = [
				'school'    =>   $this->request->post('schoolName'),
				'major'     =>   $this->request->post('professionalName'),
				'degree'    =>   $this->request->post('degree'),
				'starttime' =>   $this->request->post('schoolYearStart'),
				'endtime'   =>   $this->request->post('schoolYearEnd'),
				'u_id'      =>	 $this->session->get('userid')
			];
			$uid  =  $EducationList['u_id'];
			$sql  =  "SELECT * FROM job_education WHERE u_id = '$uid'";
			$res  =  $this->db->createCommand($sql)->queryOne();
				if ($res) 
				{
					$sql = "DELETE FROM job_education WHERE u_id = '$uid'";
					$del = $this->db->createCommand($sql)->query();
					if ($del) 
					{
						$rel  =  $this->db->createCommand()->insert('job_education',$EducationList)->execute();
						if ($rel) 
						{
							echo "<script>alert('保存成功');location.href='?r=myself/resume'</script>";
						}
						else
						{
							echo "<script>alert('保存失败');location.href='?r=myself/resume'</script>";
						}
					}
					else
					{
						echo "<script>alert('保存失败');location.href='?r=myself/resume'</script>";
					}
				}
				else
				{
					$rel  =  $this->db->createCommand()->insert('job_education',$EducationList)->execute();
						if ($rel) 
						{
							echo "<script>alert('保存成功');location.href='?r=myself/resume'</script>";
						}
					    else
					    {
						    echo "<script>alert('保存失败');location.href='?r=myself/resume'</script>";
					    }
				} 
		}
		else
		{
			die("<script>alert('没有接受到数据');location.href='?r=myself/resume'</script>");
		}
	}
	/**
	*	我的简历自我介绍
	*/		
	public function actionMyinfo()
	{
		if ($this->request->ispost) 
		{
			$MyinfoList  =  $this->request->post('selfDescription');
			$uid         =  $this->session->get('userid');
			$res = $this->db->createCommand()->update('job_ess_info',['my_info'=>"$MyinfoList"],['uid' => "$uid"])->execute();
			if ($res) 
			{
				echo "<script>alert('保存成功');location.href='?r=myself/resume'</script>";
			}
			else
			{
				echo "<script>alert('保存失败');location.href='?r=myself/resume'</script>";
			}
		}
		else
		{
			die("<script>alert('没有接受到数据');location.href='?r=myself/resume'</script>");
		}
	}
}
