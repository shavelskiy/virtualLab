<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Student;
use common\models\Group;
use common\models\Teacher;
use backend\models\SignupForm;
use common\models\StudentLabs;

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
                        'actions' => ['index' , 'view', 'create', 'update'],
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
        return $this->render('view', [
            'model' => $model,
            'group' => $model->group
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
                $student->save();

                $auth = Yii::$app->authManager;
                $studentRole = $auth->getRole('student');
                $auth->assign($studentRole, $user->id);

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
//        $student = $this->findStudent($id);
//        $model = new StudentForm();
//        $model->loadStudent($student);
//
//        $group = Group::findOne($student->group_id);
//        $teachers = Teacher::findAll([$group->teacher1_id, $group->teacher2_id]);
//
//        $teacherList = [];
//        foreach ($teachers as $teacher) {
//            $teacherList[$teacher->id] = $teacher->getFullName();
//        }
//
//        if ($model->load(Yii::$app->request->post())) {
//            $model->update();
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//            'group' => Group::findOne($model->groupId),
//            'teacherList' => $teacherList,
//        ]);
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
