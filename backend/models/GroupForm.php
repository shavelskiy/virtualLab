<?php

namespace backend\models;

use common\models\Group;
use yii\base\Model;
use common\models\GroupLabs;

class GroupForm extends Model
{
    public $id;
    public $name;
    public $labs_id;
    public $teacher1_id;
    public $teacher2_id;
    public $lab1;
    public $lab2;
    public $lab3;
    public $lab4;
    public $lab5;
    public $lab6;
    public $lab7;
    public $lab8;

    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Введите группу'],
            [['teacher1_id'], 'required', 'message' => 'Выберите преподавателя'],
            [['teacher1_id', 'teacher2_id', 'labs_id'], 'integer'],
            [['lab1', 'lab2', 'lab3', 'lab4', 'lab5', 'lab6', 'lab7', 'lab8'], 'boolean'],
            [['name'], 'unique', 'targetClass' => '\common\models\Group', 'message' => 'Такая группа уже существует'],
            [['name'], 'string', 'max' => 10, 'tooLong' => 'Введите корректную группу']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Группа'
        ];
    }

    /**
     * @param $groupId
     * @throws \Exception
     */
    public function save()
    {
        $labs = new GroupLabs();
        $labs->save();
        $this->labs_id = $labs->id;

        $group = new Group();
        $group->name = $this->name;
        $group->labs_id = $this->labs_id;
        $group->teacher1_id = $this->teacher1_id;
        $group->teacher2_id = $this->teacher2_id;
        $group->save();
    }

    public function update()
    {
        $group = Group::findOne($this->id);
        $group->setAttributes(
            [
                'name' => $this->name,
                'teacher1_id' => $this->teacher1_id,
                'teacher2_id' => $this->teacher2_id,
            ]
        );
        $group->save();

        $labs = GroupLabs::findOne($group->labs_id);
        $labs->setAttributes(
            [
                'lab1' => $this->lab1,
                'lab2' => $this->lab2,
                'lab3' => $this->lab3,
                'lab4' => $this->lab4,
                'lab5' => $this->lab5,
                'lab6' => $this->lab6,
                'lab7' => $this->lab7,
                'lab8' =>  $this->lab8,
            ]
        );

        $labs->save();
    }

    /**
     * @param Group $group
     */
    public function loadGroup($group)
    {
        $labs = GroupLabs::findOne($group->labs_id);

        $this->id = $group->id;
        $this->name = $group->name;
        $this->labs_id = $group->labs_id;
        $this->teacher1_id = $group->teacher1_id;
        $this->teacher2_id = $group->teacher2_id;
        $this->lab1 = $labs->lab1;
        $this->lab2 = $labs->lab2;
        $this->lab3 = $labs->lab3;
        $this->lab4 = $labs->lab4;
        $this->lab5 = $labs->lab5;
        $this->lab6 = $labs->lab6;
        $this->lab7 = $labs->lab7;
        $this->lab8 = $labs->lab8;
    }
}