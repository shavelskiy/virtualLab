<?php

namespace backend\controllers;

use Yii;
use common\models\Student;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Groups;
use common\models\StudentFull;

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
                        'allow' => true,
                        'roles' => ['teacher']
                    ],
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
        $model = StudentFull::getStudentById($id);
        return $this->render('view', [
            'model' => $model,
            'group' => Groups::findOne($model->groupId)
        ]);
    }

    /**
     * @param $groupId
     * @return string|\yii\web\Response
     */
    public function actionCreate($groupId)
    {
        $model = new StudentFull();

        if ($model->load(Yii::$app->request->post())) {
            $model->groupId = $groupId;
            $model->save($groupId);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'group' => Groups::findOne($groupId)
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = StudentFull::getStudentById($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->update();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'group' => Groups::findOne($model->groupId)
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $groupId = StudentFull::delete($id);
        return $this->redirect(['index', 'groupId' => $groupId]);
    }

    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
