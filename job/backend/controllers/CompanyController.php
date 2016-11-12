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
    public $enableCsrfValidation = false;

    /**
     * @biref  公司入驻
     * @author [chang] <[email address]>
     * @return null [description]
     */
    public function actionCompanyadd()
    {
        $com_model = new JobCompany();
        $user_model = new JobUser();
        $request = Yii::$app->request;
        if ($request->post()) {
            $data = $request->post();//post数据
            $str = $com_model->upload('comp_logo');
            if ($str) {
                $data['comp_logo'] = $str;
                $data['password'] = md5($data['password']);
                unset($data['_csrf']);
                unset($data['c_password']);

                //添加数据到User
                $user_model->username = $data['username'];
                $user_model->password = $data['password'];
                $user_model->utype = $data['utype'];
                $user_model->u_reg_time = time();
                $user_model->isNewRecord = true;
                $user_model->save();
                $user_id = $user_model->id;
                if ($user_id) {
                    //添加company信息
                    $com_model->comp_name = $data['comp_name'];
                    $com_model->comp_abb = $data['comp_abb'];
                    $com_model->comp_url = $data['comp_url'];
                    $com_model->comp_city = $data['comp_city'];
                    $com_model->industry_sector = $data['industry_sector'];
                    $com_model->comp_stage = $data['comp_stage'];
                    $com_model->comp_scale = $data['comp_scale'];
                    $com_model->comp_self = $data['comp_self'];
                    $com_model->comp_logo = $data['comp_logo'];
                    $com_model->u_id = $user_id;
                    $com_model->is_success = 0;
                    $com_model->isNewRecord = true;
                    $res = $com_model->save();
                    if ($res) {
                        echo "<script>alert('添加成功！');location.href='?r=company/list'</script>";
                    } else {
                        echo "<script>alert('添加失败！');location.href='?r=company/companyadd'</script>";
                    }
                }
            }


        } else {
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
        $request = Yii::$app->request;

        $columns = array('job_user.username', 'comp_name', 'comp_abb', 'comp_logo', 'comp_city', 'industry_sector', 'is_success', 'job_company.id', 'u_id');
        $info = $companyModel->find()->innerJoin('job_user', 'job_company.u_id=job_user.id')->select($columns);
        $pages = new Pagination([
            'totalCount' => $info->count(),
            'pageSize' => 5,   //每页显示条数
        ]);
       echo $nowPage = $pages->getPage()+1;
        $models = $info->offset($pages->offset)
            ->limit($pages->limit)->asArray()
            ->all();
        return $this->render('list', ['models' => $models, 'pages' => $pages,'nowPage'=>$nowPage]);
    }

    /**
     * [公司管理]
     * @brief 修改状态[审核]
     * @param int @aa 修改结果
     * */
    public function actionDosave()
    {
        $id = Yii::$app->request->post('id');
        $data = Yii::$app->request->post('data');
        $model = new JobCompany();
        $res = $model->find()->where(['id' => $id])->one();
        $res->is_success = $data;
        $aa = $res->save();
        echo json_encode(['status' => $aa]);
    }

    /**
     * [公司管理]
     * @brief 删除数据
     * */
    public function actionSomedel()
    {
        $u_id_str = Yii::$app->request->get('str');
       // $page = Yii::$app->request->get('page');
        //删除company表 同时删除user表中的数据
        $comp_model = new JobCompany();
        $user_model = new JobUser();
        $res = $comp_model->delIn($u_id_str);
        if ($res) {
            $res2 = $user_model->delIn($u_id_str);
            if ($res2) {
                echo json_encode(array('status' => 1));
            }
        }
    }

    /**
     * 删除
     *
     * */
    public function actionDel()
    {
        $u_id = Yii::$app->request->get('id');
        $page = Yii::$app->request->get('page');
        $comp_model = new JobCompany();
        $user_model = new JobUser();
        $result = $comp_model->delOne($u_id);
        if ($result) {
            $res = $user_model->delOne($u_id);
            if ($res) {
                echo "<script>alert('删除成功！');location.href='?r=company/list&page=".$page."'</script>";
            } else {
                echo "<script>alert('删除失败！');location.href='?r=company/list&page=".$page."'</script>";
            }
        }
    }

    /**
     * [公司管理]
     * @brief 修改
     * */
    public function actionUpdate()
    {
        $comp_model = new JobCompany();
        $user_model = new JobUser();
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();

            $str = $comp_model->upload('comp_logo');
            $data['comp_logo'] = $str;
            $data['password'] = md5($data['password']);
            unset($data['_csrf']);
            unset($data['c_password']);
            //echo $str;die;
            $comp_result = $comp_model->find()->where(['u_id' => $data['u_id']])->one();
            $user_result = $user_model->find()->where(['id' => $data['u_id']])->one();

            //user save
            $user_result->username = $data['username'];
            $user_result->password = $data['password'];
            $user_result->save();

            //company save
            $comp_result->comp_name = $data['comp_name'];
            $comp_result->comp_abb = $data['comp_abb'];
            $comp_result->comp_url = $data['comp_url'];
            $comp_result->comp_city = $data['comp_city'];
            $comp_result->industry_sector = $data['industry_sector'];
            $comp_result->comp_stage = $data['comp_stage'];
            $comp_result->comp_scale = $data['comp_scale'];
            $comp_result->comp_self = $data['comp_self'];
            $comp_result->comp_logo = $data['comp_logo'];
            $res  = $comp_result->save();
            if ($res) {
                echo "<script>alert('修改成功！');location.href='?r=company/list'</script>";
            } else {
                echo "<script>alert('修改失败！');location.href='?r=company/list'</script>";
            }
            } else {
                $id = Yii::$app->request->get('id');
                $comp_data = $comp_model->find()->where(['u_id' => $id])->asArray()->one();
                $user_data = $user_model->find()->where(['id' => $id])->asArray()->one();
                return $this->render('update', ['comp_data' => $comp_data, 'user_data' => $user_data]);
            }
        }





}





