<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "job_admin_role".
 *
 * @property integer $id
 * @property string $r_name
 */
class JobAdminRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_admin_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['r_name'], 'required'],
            [['r_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'r_name' => 'R Name',
        ];
    }
    public function getAll()
    {
        return $this->find()->asArray()->all();
    }
}
