<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "job_admin_privilege".
 *
 * @property integer $id
 * @property string $p_name
 * @property string $p_controller
 * @property string $p_action
 * @property integer $parent_id
 */
class JobAdminPrivilege extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_admin_privilege';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_name', 'p_controller', 'p_action', 'parent_id'], 'required'],
            [['parent_id'], 'integer'],
            [['p_name', 'p_controller', 'p_action'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'p_name' => 'P Name',
            'p_controller' => 'P Controller',
            'p_action' => 'P Action',
            'parent_id' => 'Parent ID',
        ];
    }

    public function addData($data)
    { 
        $this->setAttributes($data);
        $this->isNewRecord=true;
        return $this->save();
    }
    public function updateData($data)
    { 
        return $this->updateAll($data,['id'=>$data['id']]);
    }
    public function getTopData()
    {
        return $this->find("id,p_name")->asArray()->all();
    }
    public function getAll()
    {
        return $this->find()->asArray()->all();
    }
}
