<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Teacher;
use common\models\Group;
use common\models\GroupLabs;

/**
 * GroupController implements the CRUD actions for Group model.
 */
class GroupController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Group::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionView($id)
    {
        return $this->redirect(['student/index', 'groupId' => $id]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws \Exception
     */
    public function actionCreate()
    {
        $group = new Group();

        if ($group->load(Yii::$app->request->post())) {
            if ($group->validate()) {
                $labs = new GroupLabs();
                $labs->save();
                $group->labs_id = $labs->id;
                $group->save();
                return $this->redirect(['index']);
            }
        }

        $teachers = Teacher::find()->all();
        $teacherList = [];
        foreach ($teachers as $teacher) {
            $teacherList[$teacher->id] = $teacher->getFullName();
        }

        return $this->render('create', [
            'group' => $group,
            'teacherList' => $teacherList
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $group = $this->findGroup($id);
        $labs = $group->labs;

        if ($group->load(Yii::$app->request->post())) {
            if ($group->validate()) {
                $labs->load(Yii::$app->request->post());
                $labs->save();
                $group->save();
                return $this->redirect(['index']);
            }
        }

        $teachers = Teacher::find()->all();
        $teacherList = [];
        foreach ($teachers as $teacher) {
            $teacherList[$teacher->id] = $teacher->getFullName();
        }

        return $this->render('update', [
            'group' => $group,
            'labs' => $labs,
            'teacherList' => $teacherList
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
        $this->findGroup($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return Group|null
     * @throws NotFoundHttpException
     */
    protected function findGroup($id)
    {
        if (($model = Group::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
