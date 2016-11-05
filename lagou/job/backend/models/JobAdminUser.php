<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "job_admin_user".
 *
 * @property string $id
 * @property string $u_name
 * @property string $u_pwd
 * @property integer $u_lock
 * @property integer $u_reg_time
 * @property integer $u_login_time
 */
class JobAdminUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_admin_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_name', 'u_pwd', 'u_reg_time', 'u_login_time'], 'required'],
            [['u_lock', 'u_reg_time', 'u_login_time'], 'integer'],
            [['u_name'], 'string', 'max' => 30],
            [['u_pwd'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'u_name' => 'U Name',
            'u_pwd' => 'U Pwd',
            'u_lock' => 'U Lock',
            'u_reg_time' => 'U Reg Time',
            'u_login_time' => 'U Login Time',
        ];
    }
}
