<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "job_user".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property integer $u_reg_time
 * @property integer $u_login_time
 * @property integer $resume_open
 * @property string $qr_code
 */
class JobUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'u_reg_time', 'u_login_time'], 'required'],
            [['u_reg_time', 'u_login_time', 'resume_open', 'utype'], 'integer'],
            [['username', 'password'], 'string', 'max' => 32],
            [['qr_code'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'u_reg_time' => 'U Reg Time',
            'u_login_time' => 'U Login Time',
            'resume_open' => 'Resume Open',
            'qr_code' => 'Qr Code',
            'utype' => 'Utype',
        ];
    } 

    /*自增ID*/
    public function insertid($data)
    {
        $this->setAttributes($data);
        $this->isNewRecord = true;
        $this->save();
        return $this->id;
    }

}
