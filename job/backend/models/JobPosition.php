<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "job_admin_privilege".
 *
 * @property integer $id
 * @property string $p_name
 * @property string $p_controller
 * @property string $p_action
 * @property integer $parent_id
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
   /** public function rules()
    {
        return [
            [['p_name', 'p_controller', 'p_action', 'parent_id'], 'required'],
            [['parent_id'], 'integer'],
            [['p_name', 'p_controller', 'p_action'], 'string', 'max' => 50],
        ];
    }

    
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
            'is_show' => 'Is Show'
        ];
    }
    public function addData($data){ 
        $this->setAttributes($data);
        $this->isNewRecord=true;
        return $this->save();
    }
    public function updateData($data){ 
        return $this->updateAll($data,['id'=>$data['id']]);
    }
    public function getTopData()
    {
        return $this->find("id,position_name")->asArray()->all();
    }
    public function getwhere($id)
    {
        return $this->find()->where(['parent_id'=>$id])->asArray()->all();
    }
    public function getone($id)
    {
        return $this->find()->where(['id'=>$id])->asArray()->one();
    }
    public function getAll()
    {
        return $this->find()->asArray()->all();
    }
    public function deldate($id){
        $result=$this->find()->where(['id'=>$id])->one();
        return $result->delete();
    }
    public function getCount()
    {
        return $this->find()->count();
    }
    public function getLimit($offset,$len)
    {
        return $this->find()->offset($offset)->limit($len)->asArray()->all();
    }
    //传递一个父级id 返回所有子分类
      Public function levellist ($cate, $parent_id = 0, $level = 0) {
         Static $arr = array();
            foreach ($cate as $k => $v) {
                if ($v['parent_id'] == $parent_id) {
                    $v['level'] = $level;
                    $v['html']  =str_repeat('--',$level*2);
                    $arr[] = $v;
                    $arr =self::levellist($cate,$v['id'], $level + 1);
                }
            }
            return $arr;
        }
}
