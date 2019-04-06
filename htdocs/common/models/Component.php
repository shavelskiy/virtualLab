<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "components".
 *
 * @property int $id
 * @property string $name
 *
 * @property LabItems[] $labItems
 */
class Component extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'components';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLabItems()
    {
        return $this->hasMany(LabItems::class, ['component_id' => 'id']);
    }
}
