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

    public function getPreviewPicture()
    {
        return self::PICTURES_DIR . $this->preview_picture;
    }
}