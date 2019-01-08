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
 *
 * @property LabItems[] $labItems
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

    public function getPreviewPicture()
    {
        return self::PICTURES_DIR . $this->preview_picture;
    }

    public function getLabItems()
    {
        return LabItems::find()->where(['lab_id' => $this->id])->all();
    }

    public function getSchemes()
    {
        return Scheme::find()->where(['lab_id' => $this->id])->all();
    }
}