<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "job_role_privilege".
 *
 * @property integer $rid
 * @property integer $pid
 */
class JobRolePrivilege extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_role_privilege';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rid', 'pid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rid' => 'Rid',
            'pid' => 'Pid',
        ];
    }
}
