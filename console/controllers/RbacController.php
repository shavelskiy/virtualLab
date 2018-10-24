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

        // создаём роль для преподавателя, студента и администратора
        $teacher = $auth->createRole('teacher');
        $student = $auth->createRole('student');
        $admin = $auth->createRole('admin');

        $auth->add($teacher);
        $auth->add($student);
        $auth->add($admin);

        // Создаем разрешения
        $updateTeacher = $auth->createPermission('updateTeacher');
        $updateTeacher->description = 'Работа с преподавателями';

        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $makeLabs = $auth->createPermission('makeLabs');
        $makeLabs->description = 'Выполнение лаб';

        // Запишем эти разрешения в БД
        $auth->add($updateTeacher);
        $auth->add($viewAdminPage);
        $auth->add($makeLabs);

        $auth->addChild($student, $makeLabs);

        $auth->addChild($teacher,$viewAdminPage);
        $auth->addChild($teacher, $student);

        $auth->addChild($admin, $updateTeacher);
        $auth->addChild($admin, $teacher);
    }
}