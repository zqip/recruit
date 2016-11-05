<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "job_company".
 *
 * @property string $id
 * @property string $comp_name
 * @property string $comp_abb
 * @property string $comp_logo
 * @property string $comp_url
 * @property integer $comp_city
 * @property string $industry_sector
 * @property string $comp_stage
 * @property string $comp_scale
 * @property string $comp_self
 * @property integer $u_id
 */
class JobCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comp_name', 'comp_abb', 'comp_logo', 'comp_url', 'comp_city', 'industry_sector', 'comp_stage', 'comp_scale', 'comp_self', 'u_id'], 'required'],
            [['u_id'], 'integer'],
            [['comp_name', 'comp_logo', 'comp_scale'], 'string', 'max' => 50],
            [['comp_abb', 'comp_url', 'comp_stage'], 'string', 'max' => 20],
            [['comp_city', 'industry_sector'], 'string', 'max' => 10],
            [['comp_self'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comp_name' => 'Comp Name',
            'comp_abb' => 'Comp Abb',
            'comp_logo' => 'Comp Logo',
            'comp_url' => 'Comp Url',
            'comp_city' => 'Comp City',
            'industry_sector' => 'Industry Sector',
            'comp_stage' => 'Comp Stage',
            'comp_scale' => 'Comp Scale',
            'comp_self' => 'Comp Self',
            'u_id' => 'U ID',
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
    /**
     * 获取全部数据
     * @return [type] [description]
     */
    public function getAll()
    {
        return $this->find()->asArray()->all();
    }
}
