<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job_position".
 *
 * @property string $id
 * @property string $position_name
 * @property integer $parent_id
 * @property integer $is_hot
 * @property integer $is_new
 * @property integer $is_show
 */
class JobPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_name', 'parent_id'], 'required'],
            [['parent_id', 'is_hot', 'is_new', 'is_show'], 'integer'],
            [['position_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position_name' => 'Position Name',
            'parent_id' => 'Parent ID',
            'is_hot' => 'Is Hot',
            'is_new' => 'Is New',
            'is_show' => 'Is Show',
        ];
    }
}
