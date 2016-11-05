<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "job_invite".
 *
 * @property string $id
 * @property string $position_type
 * @property string $position_name
 * @property string $office
 * @property integer $jobnature
 * @property string $money_start
 * @property string $money_end
 * @property string $region
 * @property string $jobexp
 * @property string $jobedu
 * @property string $jobtempt
 * @property string $jobself
 * @property string $jobaddress
 * @property string $resume_email
 * @property integer $company_id
 * @property integer $u_id
 */
class JobInvite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_invite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_type', 'position_name', 'jobnature', 'money_start', 'money_end', 'region', 'jobexp', 'jobedu', 'jobtempt', 'jobself', 'jobaddress', 'resume_email', 'company_id', 'u_id'], 'required'],
            [['jobnature', 'company_id', 'u_id'], 'integer'],
            [['money_start', 'money_end'], 'number'],
            [['position_type', 'jobaddress', 'resume_email'], 'string', 'max' => 20],
            [['position_name', 'jobexp', 'jobedu'], 'string', 'max' => 10],
            [['office'], 'string', 'max' => 255],
            [['region'], 'string', 'max' => 25],
            [['jobtempt', 'jobself'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position_type' => 'Position Type',
            'position_name' => 'Position Name',
            'office' => 'Office',
            'jobnature' => 'Jobnature',
            'money_start' => 'Money Start',
            'money_end' => 'Money End',
            'region' => 'Region',
            'jobexp' => 'Jobexp',
            'jobedu' => 'Jobedu',
            'jobtempt' => 'Jobtempt',
            'jobself' => 'Jobself',
            'jobaddress' => 'Jobaddress',
            'resume_email' => 'Resume Email',
            'company_id' => 'Company ID',
            'u_id' => 'U ID',
        ];
    }
    /**
     * 查询少量字段带条件
     */
    public function getOneWhere($where)
    {
        return $this->find()->select("position_name,jobtempt")->where($where)->asArray()->All();
    }
  
}
