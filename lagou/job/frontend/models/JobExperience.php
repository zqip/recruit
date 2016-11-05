<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "job_experience".
 *
 * @property string $id
 * @property string $company
 * @property string $company_log
 * @property string $position
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $u_id
 */
class JobExperience extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_experience';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company', 'company_log', 'position', 'start_time', 'end_time', 'u_id'], 'required'],
            [['start_time', 'end_time', 'u_id'], 'integer'],
            [['company', 'company_log'], 'string', 'max' => 32],
            [['position'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company' => 'Company',
            'company_log' => 'Company Log',
            'position' => 'Position',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'u_id' => 'U ID',
        ];
    }
}
