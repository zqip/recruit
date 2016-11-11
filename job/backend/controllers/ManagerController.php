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
            $res=$con->createCommand()
                     ->insert('job_admin_user',['u_name'=>$data['u_name'],'u_pwd'=>$u_pwd])
                     ->execute();
            if($res){
                echo "<script>alert('添加成功');location.href='?r=manager/manager-list'</script>";
            }else{
                echo "<script>alert('添加失败');location.href='?r=manager/manager-add'</script>";
            }
            print_r($data);
        }else{
           return $this->render('managerAdd'); 
        }
        
    }

    //列表展示
    public function actionManagerList(){
        $query=new \yii\db\Query();
        $info=$query->select(['id','u_name','u_login_time'])->from('job_admin_user')->all();
        return $this->render('managerList',['info'=>$info]);
       
    }


    //管理员删除
    public function actionDel(){
        $request=\yii::$app->request;
        $con=\yii::$app->db;
        $id=$request->get('id');
        $res=$con->createCommand()->delete('job_admin_user',['id'=>$id])->execute();
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
            $res=$con->createCommand()->update('job_admin_user',['u_name'=>$data['u_name'],'u_pwd'=>$data['u_pwd']],['id'=>$data['u_id']])->execute();
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
