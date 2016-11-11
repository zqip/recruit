<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\controllers\CommonController;
use backend\models\JobAdminUser;
use backend\models\JobAdminRole;


/**
 * 权限
 * Rbac controller
 */
class RbacController extends CommonController
{
	/**
	 * 用户信息展示可更改角色
	 * @return [type] [description]
	 */
    public function actionUsershow()
    {

		$roleList = JobAdminRole::find()->asArray()->all();	//获取角色数据
		$db=\YII::$app->db;
		$userList=$db->createCommand("select u.id,u.u_name,r.r_name,u.u_login_time from job_admin_user u left join job_user_role ur on u.id=ur.uid left join job_admin_role r on ur.rid=r.id ")->queryAll();
		unset($userList["0"]);
		return $this->render('index',['userList'=>$userList,'roleList'=>$roleList]);
    }
    /**
     * 权限递归处理
     * @return [type] [description]
     */
    public function recursion ($privilegeList,$pid=0,$level=0)
    {
        static $arr;
        foreach ($privilegeList as $k => $v) 
        {
            if ($v['parent_id']==$pid) 
            {
                $v['level']=$level;
                $v['html']=str_repeat("--",$level*2);
                $arr[]=$v;           //获取顶级分类
                $this->recursion ($privilegeList,$v['id'],$level+1);
            }
        }
        return $arr;
    }

    /**
     * 给角色配置权限
     * @return [type] [description]
     */
    public function actionSetprivilege()
    {

    	$role          = new \backend\models\JobAdminRole;
    	$privilege     = new \backend\models\JobAdminPrivilege;
    	$roleList      = $role->getAll();
    	$privilegeList = $privilege->getAll();          
        $privilegeList = $this->recursion($privilegeList);
        $db            = \Yii::$app->db;      
        $sql           = "SELECT * FROM job_role_privilege";
        $r_p_list      = $db->createCommand($sql)->queryAll();
        return $this->render('setprivilege',['roleList'=>$roleList,'privilege'=>$privilegeList,'r_p_list'=>$r_p_list]);
    }
    /**
     * 修改权限
     * @return [type] [description]
     */
    public function actionAddp_a()
    {
        $request =  \Yii::$app->request;  //调用请求组件
        $db      =  \Yii::$app->db;      //链接数据库组件
        if ($request->ispost) 
        {
            $sql = "DELETE FROM job_role_privilege";
            $db->createCommand($sql)->query();
            $arr['1'] = $request->post('1');
            $arr['2'] = $request->post('2');
            $data = [];
            foreach ($arr['1'] as $key => $value) 
            {
                $sql = "INSERT INTO job_role_privilege (rid,pid) VALUES ('1','$value')";
                $re  = $db->createCommand($sql)->query();
            }
            foreach ($arr['2'] as $key => $value) 
            {
                $sql = "INSERT INTO job_role_privilege (rid,pid) VALUES ('2','$value')";
                $res = $db->createCommand($sql)->query();
            }
            if ($re||$res) 
            {
                return  $this->redirect("?r=rbac/setprivilege");           
            }
            else
            {
                die("sorry！！有错误");
            }

        }else{
            die("并没有任何修改！！");
        }
    }
    /**peee
     * 添加权限
     * @return [type] [description]
     */
    public function actionAddprivilege()
    {
    	$request = $this->request;
    	$privilege = new \backend\models\JobAdminPrivilege;
    	if($request->isPost)
    	{
    		$post      = $request->post();
    		unset($post['_csrf']);
    		$result    = $privilege->addData($post);
    		$hint      = $result ? "添加成功" : "添加失败";
    		die("<script>alert('$hint');window.history.go(-1);</script>");
    	}
    	else{
    		$topList = $privilege->getTopData(); //获取顶级权限
    		return $this->render('add_privilege',['topList'=>$topList]);
    	}
    }
    /**
     * 用户赋权
     * @return [type] [description]
     */
	public function actionRoleadd()
	{
		$request=\YII::$app->request;
		$uid=$request->post("uid");
		$rid=$request->post("rid");
		$arr=array();
		$arr["uid"]=$uid;
		$arr["rid"]=$rid;
		$db=\YII::$app->db;
		$ar=$db->createCommand("select * from job_user_role where uid='$uid'")->queryOne();
		if($ar)
		{
			$db->createCommand()->delete("job_user_role",["uid"=>$uid])->execute();
		}
		$res=$db->createCommand()->insert("job_user_role",$arr)->execute();
		if($res)
		{
			echo "1";
		}
		else
		{
			echo "2";
		}

	}
     /**
     * 修改用户名  即点即改
     * @return [type] [description]
     */
	public function actionUpdateuser()
	{
		$request=\YII::$app->request;
		$new_name=$request->post("new_name");
		$id=$request->post("id");
		$db=\YII::$app->db;
		$ar=$db->createCommand("select * from job_admin_user where u_name='$new_name'")->queryOne();
		if($ar)
		{
			echo "3";
		}
		else
		{
			$res=$db->createCommand()->update("job_admin_user",["u_name"=>$new_name],["id"=>$id])->execute();
			if($res)
			{
				echo "1";
			}
			else
			{
				echo "2";
			}
		}
	}
}
