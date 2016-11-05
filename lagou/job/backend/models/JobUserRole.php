<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "job_user_role".
 *
 * @property integer $uid
 * @property integer $rid
 */
class JobUserRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_user_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'rid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'rid' => 'Rid',
        ];
    }
}
