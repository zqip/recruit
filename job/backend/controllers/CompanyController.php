<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;

/**
 * Admin controller
 */
class CompanyController extends CommonController
{
    /**
     * @biref  公司入驻
     * @author [chang] <[email address]>
     * @return null [description]
     */
     public function actionCompanyadd()
     {
          return $this->render('companyAdd');
     }

     /**
      * @brief 公司管理
      * @author [name] <[email address]>
      * @return [type] [description]
      */
     public function actionList()
     {
          return $this->render('list');     
     }
}