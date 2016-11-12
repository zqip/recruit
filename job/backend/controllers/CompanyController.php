<?php
namespace backend\controllers;

use backend\models\JobCompany;
use backend\models\JobUser;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\data\Pagination;
use yii\web\UploadedFile;

/**
 * Admin controller
 */
class CompanyController extends CommonController
{
   // public $enableCsrfValidation =false;
    /**
     * @biref  公司入驻
     * @author [chang] <[email address]>
     * @return null [description]
     */
     public function actionCompanyadd()
     {
         $com_model = new JobCompany();
         $user_model = new JobUser();
         $request =  Yii::$app->request;
         $request->post();
         if($request->post()){
             $data = $request->post();//post数据
             $upload=new UploadedFile(); //实例化上传类
             $name = $upload->getInstanceByName('comp_logo');//上传文件
             $file = $_FILES['comp_logo'];
             $upload->tempName=$file['tmp_name'];
             $path = '../public/company/logo/'.date('Y-m-d').'/';
             if(!is_dir($path)){
                echo  mkdir($path,0777,true);
             }
              $mic = microtime();
              $mic = substr($mic,strpos($mic,'.')+1);
              $mic =  substr($mic,strpos($mic,' ')+1);
              $info = pathinfo($file['name']);
              $filename = $mic.'.'.$info['extension'];

              $res = $upload->saveAs($path.$filename);
              $str = $path.$filename;//入库
                 if($res){
                     $data['comp_logo'] = $str;
                     $data['password'] =md5($data['password']);
                     unset($data['_csrf']);
                     unset($data['c_password']);
                     $userData = array(
                         'utype'=>$data['utype'],
                         'username'=>$data['username'],
                         'password'=>$data['password']
                     );
                     $companyData =array(
                         'comp_name'=>$data['comp_name'],
                         'comp_abb'=>$data['comp_abb'],
                         'comp_url'=>$data['comp_url'],
                         'comp_city'=>$data['comp_city'],
                         'industry_sector'=>$data['industry_sector'],
                         'comp_stage'=>$data['comp_stage'],
                         'comp_scale'=>$data['comp_scale'],
                         'comp_self'=>$data['comp_self'],
                         'comp_logo'=>$data['comp_logo']
                     );
                     $com_model->setAttributes($companyData);
                     //$com_model->setIsNewRecord($companyData);
                     $com_model->save();
                     //print_r($userData);die;
                    // $sql = "insert into job_user (username,password) VALUES (1,1)";
                    // Yii::$app->db->createCommand($sql)->execute();
                     //未结束
                    // $user_model->username='123';
                    // $user_model->password='123';
                    // $user_model->save();
                 }
           //  print_r($data);

         }else{
             return $this->render('companyAdd');
         }
     }


     /**
      * @brief 公司管理
      * @author [name] <[email address]>
      * @return [type] [description]
      */
     public function actionList()
     {
         $companyModel = new JobCompany();
         $columns = array('job_user.username','comp_name','comp_abb','comp_logo','comp_city','industry_sector');
         $info = $companyModel->find()->innerJoin('job_user','job_company.u_id=job_user.id')->select($columns);
         $pages = new Pagination([
             //'totalCount' => $countQuery->count(),
             'totalCount' => $info->count(),
             'pageSize'   => 5   //每页显示条数
         ]);
         $models = $info->offset($pages->offset)
             ->limit($pages->limit)->asArray()
             ->all();
          return $this->render('list',['models'=>$models,'pages'=>$pages]);
     }
}