<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\controllers\CommonController;
use backend\models\JobPosition;
use yii\data\Pagination;
use yii\db\Query;
/**
 * Position controller
 */
class PositionController extends CommonController
{
    /**
     * 职位
    *@brief
    *@parem
    *@return
    */
    public function actionAdd(){
      $request=\Yii::$app->request;
      if($request->isPost)
      {
        $model=$request->post();
        unset($model['_csrf']);
            $connection= \Yii::$app->db;
             $res=$connection->createCommand()->insert('job_position',[
                    'position_name'=>$model['position_name'],
                    'parent_id'=>$model['parent_id'],
                    'is_hot'=>$model['is_hot'],
                    'is_new'=>$model['is_new'],
                    'is_show'=>$model['is_show'],
                ])->execute();
             if($res)
             {
                echo "<script>alert('添加成功');location.href='?r=position/list'</script>";
             }
             else
             {
                echo "<script>alert('添加失败');location.href='?r=position/add'</script>";
             }
      }
      else
      {
        $res=JobPosition::find()->asArray()->all();
        $arr=$this->levellist($res,$parent_id=0,$level=0);
        return $this->render('add',['data'=>$arr]);
      }     
    }
    /**
     * 递归
    *@brief
    *@parem
    *@return
    */
    Public function levellist($arr,$pid=0,$level=0)
    {
      $data=array();
      foreach ($arr as $key => $value) {
        if($value['parent_id']==$pid)
        {
          $value['html']=str_repeat('--',$level);
          $value['level'] = $level;
          $data[]=$value;
          $data=array_merge($data,$this->levellist($arr,$value['id'],$level+1));
        }      
      }
      return $data;
    }
    /**
     * 修改职位
    *@brief
    *@parem
    *@return
    */
    public function actionUpdate(){
        $request= \Yii::$app->request;
        $id = empty($request->get('id','')) ? $request->post('id','') : $request->get('id','');
        if($request->isPost){
          $post=$request->post();
          unset($post['_csrf']);
          if(JobPosition::updateAll($post,['id'=>$id])){
            echo "<script>alert('修改成功');location.href='?r=position/list'</script>";
          }
          else
          {
            echo "<script>alert('修改失败');location.href='?r=position/upda'</script>";
          }
        }
        else
        {
          $re=JobPosition::find()->where(['id'=>$id])->asArray()->one();
          $res=JobPosition::find()->where("id!=$id")->asArray()->all();
          $arr=$this->levellist($res,$parent_id=0,$level=0);
          return $this->render('upda',['data'=>$arr,'date'=>$re]);
        }
    }        
    /**
     * 展示
    *@brief
    *@parem
    *@return
    */
    public function actionList()
    {
    	$request = \yii::$app->request;
    	$position = new \backend\models\JobPosition;
      $page=$request->get('page') ? $request->get('page') : 1;
      $count=$position->getCount();
      $len=8;
      $offset=($page-1)*$len;
      //因为要用到递归所以每次都要全查询
      $data =$position->getAll();      
      $allPage=ceil($count/$len);
      $date=$this->levellist($data, $parent_id = 0, $level = 0);
      $len = $offset+$len< $count ? $offset+$len: $count;
      $everList=$this->everPage($date,$offset,$len);
      $prev=$page-1 <= 1 ?  1:$page-1 ;
      $next=$page+1 >= $allPage ? $allPage :$page+1 ;
      return $this->render('list', [
           'poslist' => $everList,
           'prev'    => $prev,
           'next'    => $next,
           'allPage' => $allPage,
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
     * 删除
    *@brief
    *@parem
    *@return
    */
    public function actionDel($id = 0)
    {
    	$request = \yii::$app->request;  	
    	$position = new \backend\models\JobPosition;
      $arr = $position->getwhere($id);
  		if($arr)
  		{
  			die("<script>alert('当前分类下有子分类');window.history.go(-1);</script>");
  		}
      else
      {
  			$result = $position->deldate($id);
  		  echo "<script> alert('删除成功');location.href='index.php?r=position/list'</script>";die();
  		}
    }
    /**
     * 配置文件生成
    *@brief
    *@parem
    *@return
    */
   public function actionPeizhi()
   {
      return $this->render('peizhi');
   }
   /**
     * 配置文件生成
    *@brief
    *@parem
    *@return
    */
   public function actionPos()
   {
      $lists = $this->db->createCommand('select position_name from job_position')->queryAll();
      $arr = array();
      foreach($lists as $v)
      {
        $arr[] = $v['position_name'];
      }
      //网站根目录
      $job = \Yii::$app->basePath.'/../';
      $con = implode(',',$arr);
      file_put_contents($job.'/common/config/position.php',$con);
   }
}
