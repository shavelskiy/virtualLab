<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "scheme_texts".
 *
 * @property int $id
 * @property int $scheme_id
 * @property string $text
 * @property int $x
 * @property int $y
 *
 * @property Schemes $scheme
 */
class SchemeText extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scheme_texts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scheme_id', 'text', 'x', 'y'], 'required'],
            [['scheme_id', 'x', 'y'], 'integer'],
            [['text'], 'string', 'max' => 255],
            [['scheme_id'], 'exist', 'skipOnError' => true, 'targetClass' => Scheme::className(), 'targetAttribute' => ['scheme_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scheme_id' => 'Scheme ID',
            'text' => 'Text',
            'x' => 'X',
            'y' => 'Y',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScheme()
    {
        return $this->hasOne(Scheme::className(), ['id' => 'scheme_id']);
    }

    public static function saveData($data, $schemeId)
    {
        foreach ($data['save'] as $element) {
            $schemeText = new SchemeText();
            $schemeText->scheme_id = $schemeId;
            $schemeText->text = $element['text'];
            $schemeText->x = $element['x'];
            $schemeText->y = $element['y'];

            if ($schemeText->validate()) {
                $schemeText->save();
            }
        }

        foreach ($data['delete'] as $itemId) {
            $schemeText = SchemeText::findOne($itemId);
            $schemeText->delete();
        }
    }
}
