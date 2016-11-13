<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "job_originator".
 *
 * @property string $id
 * @property string $originator
 * @property string $ori_pos
 * @property string $ori_sina
 * @property string $ori_self
 * @property integer $company_id
 * @property string $ori_pic
 */
class JobOriginator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_originator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['originator', 'ori_pos', 'ori_sina', 'ori_self', 'company_id'], 'required'],
            [['company_id'], 'integer'],
            [['originator', 'ori_pos', 'ori_sina'], 'string', 'max' => 10],
            [['ori_self'], 'string', 'max' => 50],
            [['ori_pic'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'originator' => 'Originator',
            'ori_pos' => 'Ori Pos',
            'ori_sina' => 'Ori Sina',
            'ori_self' => 'Ori Self',
            'company_id' => 'Company ID',
            'ori_pic' => 'Ori Pic',
        ];
    }
}
