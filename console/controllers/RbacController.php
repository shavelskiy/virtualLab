<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // создаём роль для преподавателя и студента
        $teacher = $auth->createRole('teacher');
        $student = $auth->createRole('student');

        $auth->add($teacher);
        $auth->add($student);

        // Создаем разрешения
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $makeLabs = $auth->createPermission('makeLabs');
        $makeLabs->description = 'Выполнение лаб';

        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);
        $auth->add($makeLabs);

        $auth->addChild($teacher,$viewAdminPage);
        $auth->addChild($student, $makeLabs);

        $auth->addChild($teacher, $student);

        $auth->assign($teacher, 1);
    }
}