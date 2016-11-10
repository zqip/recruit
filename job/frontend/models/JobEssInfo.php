<?php

namespace frontend\models;

use Yii;
/**
 * This is the model class for table "job_ess_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $img_path
 * @property string $my_info
 * @property string $telephone
 * @property string $email
 */
class JobEssInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_ess_info';
    }

    /**
     * @inheritdoc
     */ 
     public function rules()
    {
        return [
            [['name', 'sex', 'img_path', 'my_info', 'telephone', 'status', 'email', 'uid'], 'required'],
            [['uid'], 'integer'],
            [['name', 'email'], 'string', 'max' => 32],
            [['sex'], 'string', 'max' => 3],
            [['img_path'], 'string', 'max' => 150],
            [['my_info'], 'string', 'max' => 50],
            [['telephone'], 'string', 'max' => 11],
            [['status'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'sex' => 'Sex',
            'img_path' => 'Img Path',
            'my_info' => 'My Info',
            'telephone' => 'Telephone',
            'status' => 'Status',
            'email' => 'Email',
            'uid' => 'Uid',
        ];
    } 
    public function insertid($data)
    {
      // print_r($data);die;  
        $this->setAttributes($data);
        $this->isNewRecord = true;
        return $this->save();

        // return \Yii::$app->db->getRawSql();
    }
}
