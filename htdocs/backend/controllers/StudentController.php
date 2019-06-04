<?php

namespace backend\controllers;

use common\models\Lab;
use common\models\LabResults;
use common\models\StudentLabs;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Student;
use common\models\Group;
use common\models\Teacher;
use backend\models\SignupForm;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['teacher']
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['admin']
                    ]
                ],
            ],
        ];
    }

    /**
     * @param $groupId
     * @return string
     */
    public function actionIndex($groupId)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Student::find()
                ->andWhere(['group_id' => $groupId])
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'group' => Group::findOne($groupId)
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findStudent($id);

        $studentLabs = [];

        foreach (Lab::find()->all() as $lab) {
            $finish = false;

            /** @var LabResults $studentLab */
            if ($studentLab = $model->labs->{'lab' . $lab->id}) {
                $attempts = $studentLab->attempts;
                if ($studentLab->success) {
                    $finish = true;
                    $status = 'Выполнено';
                } else {
                    $status = 'В процессе';
                }
            } else {
                $status = 'Не начато';
                $attempts = 0;
            }

            $studentLabs[] = [
                'lab_id' => $lab->id,
                'status' => $status,
                'date_create' => $finish ? date('d.m.Y H:i', $studentLab->created_at) : null,
                'href' => $finish ? $studentLab->file_path : null,
                'attempts' => $attempts
            ];
        }

        return $this->render('view', [
            'model' => $model,
            'group' => $model->group,
            'studentLabs' => $studentLabs
        ]);
    }

    /**
     * @param $groupId
     * @return string|\yii\web\Response
     * @throws \Exception
     */
    public function actionCreate($groupId)
    {
        $signUpForm = new SignupForm();
        $student = new Student();

        if (($signUpForm->load(Yii::$app->request->post())) && ($student->load(Yii::$app->request->post()))) {
            if ($signUpForm->validate() && $student->validate()) {
                $user = $signUpForm->signup();

                $student->user_id = $user->id;
                $student->group_id = $groupId;

                // Создаём лабораторные работы перед сохранение студента
                $labs = new StudentLabs();
                $labs->save();
                $student->labs_id = $labs->id;

                $student->save();

                // После сохранения присваиваем роль студента
                $auth = Yii::$app->authManager;
                $studentRole = $auth->getRole('student');
                $auth->assign($studentRole, $student->user_id);

                return $this->redirect(['index', 'groupId' => $groupId]);
            }
        }

        $group = Group::findOne($groupId);
        $teachers = Teacher::findAll([$group->teacher1_id, $group->teacher2_id]);

        $teacherList = [];
        foreach ($teachers as $teacher) {
            $teacherList[$teacher->id] = $teacher->getFullName();
        }

        return $this->render('create', [
            'signUpForm' => $signUpForm,
            'student' => $student,
            'teacherList' => $teacherList,
            'group' => $group
        ]);
    }

    public function actionUpdate($id)
    {
        $student = $this->findStudent($id);
        $user = $student->user;

        if (($user->load(Yii::$app->request->post())) && ($student->load(Yii::$app->request->post()))) {
            $user->save();
            $student->save();
            return $this->redirect(['view', 'id' => $student->id]);
        }

        $group = $student->group;
        $teachers = Teacher::findAll([$group->teacher1_id, $group->teacher2_id]);

        $teacherList = [];
        foreach ($teachers as $teacher) {
            $teacherList[$teacher->id] = $teacher->getFullName();
        }

        return $this->render('update', [
            'user' => $user,
            'student' => $student,
            'teacherList' => $teacherList,
            'group' => $group
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $student = $this->findStudent($id);
        $student->delete();
        return $this->redirect(['index', 'groupId' => $student->group_id]);
    }

    /**
     * @param $id
     * @return Student|null
     * @throws NotFoundHttpException
     */
    protected function findStudent($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
