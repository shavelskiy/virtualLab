<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "labs".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $preview_picture
 * @property string signal_view
 *
 * @property LabItemsOld[] $items
 * @property Scheme[] $schemes
 */
class Lab extends \yii\db\ActiveRecord
{
    const PICTURES_DIR = '/data/uploads/labs/';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'labs';
    }

    public function attributeLabels()
    {
        return [
          'name' => 'Название',
          'description' => 'Описание',
          'preview_picture' => 'Изображение'
        ];
    }

    public function getPreviewPicture()
    {
        return self::PICTURES_DIR . $this->preview_picture;
    }

    public function getItems()
    {
        return LabItemsOld::find()->where(['lab_id' => $this->id])->all();
    }

    public function getSchemes()
    {
        return Scheme::find()->where(['lab_id' => $this->id])->all();
    }
}