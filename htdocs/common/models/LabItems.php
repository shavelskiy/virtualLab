<?php

namespace common\models;

use Yii;
use backend\widgets\nested\behaviors\NestedSetQuery;
use backend\widgets\nested\behaviors\NestedSetBehavior;

/**
 * This is the model class for table "lab_items".
 *
 * @property int $id
 * @property int $lab_id
 * @property int $root
 * @property int $lft
 * @property int $rgt
 * @property int $level
 * @property string $name
 * @property string $content
 * @property string $component_id
 *
 * @property Lab $lab
 * @property Component $component
 */
class LabItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lab_items';
    }

    public function behaviors()
    {
        return [
            [
                'class' => NestedSetBehavior::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lab_id', 'root', 'lft', 'rgt', 'level', 'component_id'], 'integer'],
            [['name', 'content'], 'string'],
            [['lab_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lab::className(), 'targetAttribute' => ['lab_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lab_id' => 'Lab ID',
            'root' => 'Root',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'level' => 'Level',
            'name' => 'Name',
            'content' => 'Content',
            'component_id' => 'Component',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLab()
    {
        return $this->hasOne(Lab::className(), ['id' => 'lab_id']);
    }

    public function getComponent()
    {
        return $this->hasOne(Component::className(), ['id' => 'component_id']);
    }

    public static function find()
    {
        return new NestedSetQuery(get_called_class());
    }
}
