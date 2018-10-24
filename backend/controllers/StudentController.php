<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\Student;
use backend\models\Groups;
use backend\models\StudentForm;

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
            'group' => Groups::findOne($groupId)
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
        $model = new StudentForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save($groupId);
                return $this->redirect(['index', 'groupId' => $groupId]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'group' => Groups::findOne($groupId)
        ]);
    }

    public function actionUpdate($id)
    {
//        $model = StudentFull::getStudentById($id);
//        if ($model->load(Yii::$app->request->post())) {
//            $model->update();
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//            'group' => Groups::findOne($model->groupId)
//        ]);
    }

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
