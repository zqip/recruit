<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\model\JobAdminUser;

/**
 * Admin controller
 */
class ManagerController extends CommonController
{
    

	public $enableCsrfValidation = false;
    /**
     * 管理员添加
     * @brief 管理员添加
     * */
    public function actionManagerAdd(){
        $request=\yii::$app->request;
        $con=\yii::$app->db;
        if($request->isPost){
            $data=$request->post();

            //验证非空
            if(!$data['u_name']){
                echo "<script>alert('管理员名称不能为空！');location.href='?r=manager/manager-add'</script>";die;
            }else{
                $query=new \yii\db\Query();
                $res=$query->select('id')->from('job_admin_user')->where("u_name=:u_name",[':u_name'=>$data['u_name']])->one();
                if($res){
                    echo "<script>alert('管理员名称重复！');location.href='?r=manager/manager-add'</script>";die;
                }
            }

            if(!$data['u_pwd']){
                echo "<script>alert('密码不能为空！');location.href='?r=manager/manager-add'</script>";die;
            }

            if(!$data['q_pwd']){
                echo "<script>alert('请确认密码！');location.href='?r=manager/manager-add'</script>";die;
            }

            //验证密码与确认密码是否相符
            if($data['u_pwd']!=$data['q_pwd']){
                
                echo "<script>alert('密码与确认密码不符！');location.href='?r=manager/manager-add'</script>";die;
            }

            $u_pwd=md5($data['u_pwd']);
            $res=$con->createCommand()->insert('job_admin_user',['u_name'=>$data['u_name'],'u_pwd'=>$u_pwd])->execute();

            $u_id=$con->getLastInsertID();

            $res1=$con->createCommand()->insert('job_user_role',['uid'=>$u_id,'rid'=>$data['role']])->execute();

            if($res && $res1){
                echo "<script>alert('添加成功');location.href='?r=manager/manager-list'</script>";
            }else{
                echo "<script>alert('添加失败');location.href='?r=manager/manager-add'</script>";
            }
            //print_r($data);
        }else{
            $query=new \yii\db\Query();
            $privilege=$query->select('*')->from('job_admin_role')->all();
            //print_r($privilege);die;
           return $this->render('managerAdd',['privilege'=>$privilege
            ]); 
        }
        
    }

    //列表展示
    public function actionManagerList(){
        
        $request = \yii::$app->request;
        $query=new \yii\db\Query();
        $con=\yii::$app->db;
        $user = new \backend\models\JobAdminUser;
        $page=$request->get('page') ? $request->get('page') : 1;
        $count=$user->getCount();
        $length=5;
        $limit=($page-1)*$length;
        
        $sql="select * from `job_admin_user` limit $limit,$length";
        $info=$con->createCommand($sql)->queryAll();

        foreach($info as $k=>$v){
            /*$roleInfo=$query->select('r_name')
            ->from('job_user_role ur')
            ->leftJoin('job_admin_role ar','ar.id=ur.rid')
            ->where('ur.uid='.$v['id'])
            ->all();*/
            //echo $v['id'];die;
            $sql="select * from job_admin_role as ar inner join job_user_role as ur on ar.id=ur.rid where ur.uid=".$v['id'];;
            $roleInfo=$con->createCommand($sql)->queryAll();
            //print_r($roleInfo);die;
            if($roleInfo){
                $info[$k]['role']=$roleInfo[0]['r_name'];
            }else{
                $info[$k]['role']='';
            }
            
        }
        

        //print_r($info);die;
        $total=ceil($count/$length);
        $prev=$page-1<1 ? 1 : $page-1;
        $next=$page+1>$total ? $total : $page+1;
        return $this->render('managerList', [
           'info' => $info,
           'prev'    => $prev,
           'next'    => $next,
           'allPage' => $total,
      ]);

       
    }




    //管理员删除
    public function actionDel(){
        $request=\yii::$app->request;
        $con=\yii::$app->db;
        $id=$request->get('id');
        $res=$con->createCommand()->delete('job_admin_user',['id'=>$id])->execute();
        $res=$con->createCommand()->delete('job_user_role',['uid'=>$id])->execute();
        if($res){
            echo json_encode(['state'=>'success']);
        }else{
            echo json_encode(['state'=>'fail']);
        }
    }

    //管理员编辑
    public function actionUpdate(){
        $request=\yii::$app->request;
        $con=\yii::$app->db;
        $query=new \yii\db\Query();
        if($request->isPost){
            $data=$request->post();

            //验证密码与确认密码是否相符
            if($data['u_pwd']!=$data['q_pwd']){
                
                echo "<script>alert('密码与确认密码不符！');location.href='?r=manager/manager-add'</script>";die;
            }

            //print_r($data);
            $res=$con->createCommand()->update('job_admin_user',['u_name'=>$data['u_name'],'u_pwd'=>md5($data['u_pwd'])],['id'=>$data['u_id']])->execute();
            if($res){
                echo "<script>alert('修改成功');location.href='?r=manager/manager-list'</script>";
            }else{
                echo "<script>alert('修改失败');location.href='?r=manager/manager-edit'</script>";
            }
        }else{
            $id=$request->get('id');
            $info=$query->select(['id','u_name'])->from('job_admin_user')->where('id='.$id)->one();
            //print_r($info);
            return $this->render('managerEdit',['info'=>$info]);
        }
        
    }

}
