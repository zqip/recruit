<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "job_region".
 *
 * @property string $region_id
 * @property integer $parent_id
 * @property string $region_name
 * @property integer $region_type
 * @property integer $agency_id
 */
class JobRegion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'region_type', 'agency_id'], 'integer'],
            [['region_name'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'region_id' => 'Region ID',
            'parent_id' => 'Parent ID',
            'region_name' => 'Region Name',
            'region_type' => 'Region Type',
            'agency_id' => 'Agency ID',
        ];
    }
}
