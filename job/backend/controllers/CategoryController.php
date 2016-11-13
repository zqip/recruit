<?php
namespace backend\controllers;

use backend\models\JobPosition;
use Yii;
use yii\web\Controller;
use yii\data\Pagination;

/**
 * Admin controller
 */
class CategoryController extends CommonController
{
    /**
     * @brief 分类添加
     * @return void
     * */
    public function actionCategoryadd(){
        $model = new JobPosition();
        if(Yii::$app->request->post()){
            //add
            $data = Yii::$app->request->post();
            unset($data['_csrf']);
            /*防止相同岗位分类的添加*/
            $position_name = $data['position_name'];

            $res = $model->find()->where(['position_name'=>$position_name])->all();
            if(count($res)==0){
                $db = Yii::$app->db;
                $res = $db->createCommand()->insert('job_position',$data)->execute();
                if($res){
                    echo "<script>alert('添加成功！');location.href='?r=category/list'</script>";
                }else{
                    echo "<script>alert('添加失败！');location.href='?r=category/categoryadd'</script>";
                }
            }else{
                echo "<script>alert('分类名重复！');location.href='?r=category/categoryadd'</script>";
            }

        }else{
            $cate = $model->getAll();
            $form_cate = $model->levellist($cate);
            return $this->render('categoryAdd',['form_cate'=>$form_cate]);
        }

    }
    /**
     * @brief 分类管理list
     * @return void
     * */
    public function actionList(){
        $model = new JobPosition();
        $request = Yii::$app->request;
        $page = $request->get('page') ? $request->get('page'):1;//当前页
        $count=$model->getCount();
        $len=8;
        $offset=($page-1)*$len;
        //递归查询
        $data =$model->getAll();
        $allPage=ceil($count/$len);
        $date=$model->levellist($data, $parent_id = 0, $level = 0);
        $len = $offset+$len< $count ? $offset+$len: $count;
        $everList=$this->everPage($date,$offset,$len);
        $prev=$page-1 <= 1 ?  1:$page-1 ;
        $next=$page+1 >= $allPage ? $allPage :$page+1 ;
        return $this->render('categoryList',[
            'models'=>$everList,
            'prev'    => $prev,
            'next'    => $next,
            'allPage' => $allPage,
            'page'    =>$page
        ]);
    }
    /**
     * 分页
     *@brief
     *@parem
     *@return
     */
    public function everPage($list,$offset,$len)
    {
        $arr = array();
        for ($i=$offset; $i < $len; $i++)
        {
            $arr[]=$list[$i];
        }
        return $arr;
    }
    /**
     * @brief  分类删除
     * @param
     * @return int
     * */
    public function actionDel(){
        $model = new JobPosition();
        $id = Yii::$app->request->get('id');
        $page = Yii::$app->request->get('page');
        $arr = $model->getwhere($id);
        //页面驻留
        if(count($arr)!=0){
            echo "<script>alert('该分类下存在子级分类！');location.href='?r=category/list&page=".$page."'</script>";
        }else{
            //删除
            echo "<script>if(confirm('确定删除？')==false);history.go(-1);break;</script>";
            $res = $model->deldate($id);
            if($res){
                echo "<script>alert('删除成功！');location.href='?r=category/list&page=".$page."'</script>";
            }else{
                echo "<script>alert('删除失败！');location.href='?r=category/list&page=".$page."'</script>";
            }
        }
    }

    /**
     * @brief 删除多个
     * */
    public function actionSomedel(){
        $model = new JobPosition();
        $request = Yii::$app->request;
        $str = $request->get('str');
        $page = $request->get('page');
        //防止bug
        $sql2 = "select id from job_position where parent_id in ($str) and id NOT IN ($str)";
        $aa = Yii::$app->db->createCommand($sql2)->execute();
        if($aa==0){
            $sql = "delete from job_position where id in ($str)";
            $res = Yii::$app->db->createCommand($sql)->execute();
            $success_data = array('status'=>1);
            echo json_encode($success_data);
        }else{
            $success_data = array('status'=>0);
            echo json_encode($success_data); 
        }

    }
    /**
     * @brief 分类修改
     * @param
     * @return int
     * */
    public function actionUpdate(){
        $request = Yii::$app->request;
        $model = new JobPosition();
        if($request->get('id')){
            //视图层
            $save_data = $model->getone(['id'=>$request->get('id')]);
            $cate = $model->getAll();
            $form_cate = $model->levellist($cate);
            return $this->render('update',['save_data'=>$save_data,'form_cate'=>$form_cate]);
        }else{
            //修改 sql
            $data = $request->post();
            unset($data['_csrf']);
            $res = $model->updateAll($data,['id'=>$data['id']]);
            if($res){
                echo "<script>alert('修改成功！');location.href='?r=category/list'</script>";
            }else{
                echo "<script>alert('修改失败！');location.href='?r=category/list'</script>";
            }
        }




    }
}