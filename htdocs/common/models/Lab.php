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
 * @property string $signal
 *
 * @property string $previewPicture
 * @property Scheme[] $schemes
 */
class Lab extends \yii\db\ActiveRecord
{
    const PICTURES_DIR = '/data/uploads/labs/';

    const SIGNAL_LINEAR = 1;
    const SIGNAL_SINUSOIDAL = 2;
    const SIGNAL_RECTANGLE = 3;

    const SIGNAL_NAMES = [
        self::SIGNAL_LINEAR => 'linear',
        self::SIGNAL_SINUSOIDAL => 'sinusoidal',
        self::SIGNAL_RECTANGLE => 'rectangular'
    ];

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

    public function getSchemes()
    {
        return Scheme::find()->andWhere(['lab_id' => $this->id])->all();
    }
}