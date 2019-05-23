<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lab_results".
 *
 * @property int $id
 * @property int $attempts
 * @property int $created_at
 * @property string $file_path
 * @property int $success
 *
 * @property string $result
 */
class LabResults extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lab_results';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attempts', 'success'], 'required'],
            [['attempts', 'created_at'], 'integer'],
            [['success'], 'boolean'],
            [['file_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attempts' => 'Attempts',
            'created_at' => 'Created At',
            'file_path' => 'File Path',
            'success' => 'Success',
        ];
    }

    public function getResult()
    {
        if ($this->success) {
            $result = "Пройдено,<br>" . date('d.m.Y H:i', $this->created_at) . ',';
        } else {
            $result = "Не пройдено,<br>";
        }

        $result .= "<br>количество попыток - " . $this->attempts;

        return $result;
    }
}
