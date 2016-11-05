<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "job_education".
 *
 * @property string $id
 * @property string $school
 * @property string $major
 * @property string $degree
 * @property string $graduate
 * @property integer $u_id
 */
class JobEducation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_education';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school', 'major', 'degree', 'graduate', 'u_id'], 'required'],
            [['u_id'], 'integer'],
            [['school'], 'string', 'max' => 32],
            [['major', 'degree', 'graduate'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'school' => 'School',
            'major' => 'Major',
            'degree' => 'Degree',
            'graduate' => 'Graduate',
            'u_id' => 'U ID',
        ];
    }
}
