<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\User;

class LabController extends Controller
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
                        'actions' => ['index', 'lab'],
                        'allow' => true,
                        'roles' => ['student'],
                    ],
                    [
                        'actions' => ['description'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $activeLabs = User::findOne(Yii::$app->user->id)->student->group->labs->activeLabs;

        return $this->render('index', [
            'activeLabs' => $activeLabs
        ]);
    }

    public function actionLab($number)
    {
        $variant = User::findOne(Yii::$app->user->id)->student->variant;
        return $this->render('lab', [
                'number' => $number,
                'variant' => $variant
            ]
        );
    }

    public function actionDescription()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $result = [
            '1' => [
                'name' => 'Измерение внешней вольт-амперной характеристики (ВАХ)<br>реального источника постоянного напряжения',
                'task' => [
                    '1' => [
                        'name' => 'Подключите вольтметр для измерения напряжения на резисторе',
                        'content' => '<div class="row">
            <div class="col-12 ml-5">
                <img src="/data/uploads/lab1/1.1.png">
            </div>
        <h6 class="ml-5">Рис 1.3−Схема резистивного делителя токов</h6>',
                        'component' => ''
                    ],
                    '2' => [
                        'name' => 'С помощью вольтметра измерить напряжение на зажимах источника, устанавливая величину сопротивления нагрузки от 50 до 900 Ом, а также напряжение на разомкнутых зажимах источника (режим холостого хода, R →∞ ). По данным измерений рассчитать ток. Результаты измерений и расчетов свести в таблицу 1.1.',
                        'content' => '<h6 class="text-right">Таблица 1.1</h6>',
                        'component' => 'graphTable'
                    ],
                    '3' => [
                        'name' => 'Построить измеренную внешнюю вольт-амперную характеристику реального источника. По полученной характеристике определить внутреннее<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; сопротивление источника r<sub>вн</sub>',
                        'content' => '',
                        'component' => 'graph'
                    ],
                    '4' => [
                        'name' => 'Нарисовать последовательную и параллельную схемы замещения реального источника, рассчитать их параметры U<sub>р</sub> I<sub>к</sub> r<sub>вн</sub> g<sub>вн</sub>',
                        'content' => '<form class="form-horizontal ml-5">
            <div class="form-row">
                <div class="form-group col-3">
                    <label for="lab1-p1.4-1" class="col-sm-3 control-label px-3">U<sub>р</sub> =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p1.4-1">
                    </div>
                    <label class="col-sm-2 control-label pl-0">В</label>
                </div>
                <div class="form-group col-3">
                    <label for="lab1-p1.4-2" class="col-sm-3 control-label px-3">I<sub>к</sub> =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p1.4-2">
                    </div>
                    <label class="col-sm-2 control-label pl-1">мА</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-3">
                    <label for="lab1-p1.4-3" class="col-sm-3 control-label px-3">r<sub>вн</sub> =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p1.4-3">
                    </div>
                    <label class="col-sm-2 control-label pl-1">Ом</label>
                </div>
                <div class="form-group col-3">
                    <label for="lab1-p1.4-4" class="col-sm-3 control-label px-3">g<sub>вн</sub> =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p1.4-4">
                    </div>
                    <label class="col-sm-2 control-label pl-1">См</label>
                </div>
            </div>
        </form>',
                        'component' => ''
                    ]
                ]
            ],
            '2' => [
                'name' => 'Измерение тока и напряжения в схемах',
                'task' => [
                    '1' => [
                        'name' => 'Согласно варианту аналитически рассчитать коэффициент деления резистивного делителя напряжения – рис. 1.2 (K<sup>V</sup> = U<sub>2</sub> / U<sub>1</sub>)',
                        'content' => '<div class="row">
            <div class="col-4 ml-5">
                <img src="/data/uploads/lab1/1.2.png">
            </div>
            <div class="col-2 mt-3">
                R<sub>1</sub> = 1 кОм
                <br>
                R<sub>2</sub> =
                    800
                Ом
                <form class="form-horizontal bottom-align-text">
                    <div class="form-group mb-0">
                        <label for="lab1-p2.1" class="col-sm-3 control-label px-3">K<sup>V</sup> =</label>
                        <div class="col-sm-5 px-0">
                            <input type="text" class="form-control" id="lab1-p2.1">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <h6 class="ml-5">Рис. 1.2 – Схема резистивного делителя напряжения </h6>',
                        'component' => ''
                    ],
                    '2' => [
                        'name' => ' Нарисовать схему рис.1.2 с источником постоянного напряжения и необходимыми приборами, для измерения напряжений U1 и U2',
                        'content' => '',
                        'component' => ''
                    ],
                    '3' => [
                        'name' => 'Выберете схему рис.1.2. На входе схемы должне быть включён источник постоянного напряжения. Измерить напряжения U<sub>1</sub> и U<sub>2</sub> .<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Рассчитать коэффициент деления напряжения – K<sup>V</sup> = U<sub>2</sub> / U<sub>1</sub> и сравнить с аналитически вычисленным значением в п. 2.1.',
                        'content' => ' <form class="form-horizontal ml-4">
            <div class="form-group col-3">
                <label for="help1" class="col-sm-3 control-label px-3">U<sub>1</sub> =</label>
                <div class="col-sm-5 px-0">
                    <input type="text" class="form-control" id="help1">
                </div>
                <label class="col-sm-2 control-label pl-0">В</label>
            </div>
            <div class="form-group col-3">
                <label for="help2" class="col-sm-3 control-label px-3">U<sub>2</sub> =</label>
                <div class="col-sm-5 px-0">
                    <input type="text" class="form-control" id="help2">
                </div>
                <label class="col-sm-2 control-label pl-1">В</label>
            </div>
            <div class="form-group col-3">
                <label for="lab1-p2.3" class="col-sm-3 control-label px-3">K<sup>V</sup> =</label>
                <div class="col-sm-5 px-0">
                    <input type="text" class="form-control" id="lab1-p2.3">
                </div>
            </div>
        </form>',
                        'component' => ''
                    ],
                    '4' => [
                        'name' => 'Выберите схему рис 1.3 с источник постоянного напряжения на входе',
                        'content' => '<div class="row">
            <div class="col-4 ml-5">
                <img src="/data/uploads/lab1/1.3.png">
            </div>
            <div class="col-2 mt-5">
                R<sub>1</sub> = 1 кОм
                <br>
                R<sub>2</sub> = 2 кОм
                <br>
                R = <?= $R ?> Ом
            </div>
        </div>
        <h6 class="ml-5">Рис 1.3−Схема резистивного делителя токов</h6>',
                        'component' => ''
                    ],
                    '5' => [
                        'name' => 'Измерить напряжения U<sub>1</sub>, U<sub>2</sub>, U. По показаниям вольтметров определить токи I<sub>1</sub>, I<sub>2</sub>, I.',
                        'content' => ' <form class="form-horizontal ml-5">
            <div class="form-row">
                <div class="form-group col-3">
                    <label for="lab1-p2.5-1" class="col-sm-3 control-label px-3">U<sub>1</sub> =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p2.5-1">
                    </div>
                    <label class="col-sm-2 control-label pl-0">В</label>
                </div>
                <div class="form-group col-3">
                    <label for="lab1-p2.5-4" class="col-sm-3 control-label px-3">I<sub>1</sub> =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p2.5-4">
                    </div>
                    <label class="col-sm-2 control-label pl-0">мА</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-3">
                    <label for="lab1-p2.5-2" class="col-sm-3 control-label px-3">U<sub>2</sub> =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p2.5-2">
                    </div>
                    <label class="col-sm-2 control-label pl-0">В</label>
                </div>
                <div class="form-group col-3">
                    <label for="lab1-p2.5-5" class="col-sm-3 control-label px-3">I<sub>2</sub> =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p2.5-5">
                    </div>
                    <label class="col-sm-2 control-label pl-0">мА</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-3">
                    <label for="lab1-p2.5-3" class="col-sm-3 control-label px-3">U =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p2.5-3">
                    </div>
                    <label class="col-sm-2 control-label pl-0">В</label>
                </div>
                <div class="form-group col-3">
                    <label for="lab1-p2.5-6" class="col-sm-3 control-label px-3">I =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p2.5-6">
                    </div>
                    <label class="col-sm-2 control-label pl-0">мА</label>
                </div>
            </div>
        </form>',
                        'component' => ''
                    ],
                    '6' => [
                        'name' => 'Используя вторую формулу разброса, проверить полученный результат.',
                        'content' => '',
                        'component' => ''
                    ]
                ]
            ],
            '3' => [
                'name' => 'Определение эквивалентного сопротивления.',
                'task' => [
                    '1' => [
                        'name' => 'В схеме рис. 1.4 рассчитать с помощью законов Кирхгофа эквивалентное сопротивление относительно реального источника (активного двухполюсника) и<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; определить его, используя омметр. (При этом реальный источник отключить от схемы).',
                        'content' => '<div class="row">
            <div class="col-4 ml-5">
                    <img src="/data/uploads/lab1/1.4b.png">
            </div>
            <div class="col-5 mt-3 ml-5">
                E= 10 В<br>
                r<sub>вн</sub> = 60 Ом<br>
                R<sub>1</sub> = 1 кОм<br>
                R<sub>2</sub> = 2 кОм<br>
                R<sub>3</sub> = 10 кОм<br>
                R<sub>4</sub> = 100 Ом<br>
                R = <?= $R ?> Ом
            </div>
        </div>
        <h6 class="ml-5">Рис. 1.4 – Расчетные схема </h6>',
                        'component' => ''
                    ],
                    '2' => [
                        'name' => 'Определить эквивалентное сопротивление R<sub>экв</sub> относительно реального источника с помощью вольтметра. Измерить напряжение U и напряжение на<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; резисторе R<sub>4</sub>',
                        'content' => '<table class="table table-bordered ml-5 table-p3-2">
            <thead>
            <tr>
                <td></td>
                <td>Расчитанное R<sub>экв</sub></td>
                <td>Измеренное R<sub>экв</sub> (п. 3.2)</td>
                <td>Измеренное R<sub>экв</sub>В (п.3.1)</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>R<sub>экв</sub></td>
                    <td class="input volts"><input type="text" class="form-control" id="lab1-p3.2-1"></td>
                    <td class="input volts"><input type="text" class="form-control" id="lab1-p3.2-2"></td>
                    <td class="input volts"><input type="text" class="form-control" id="lab1-p3.2-3"></td>
            </tr>
            </tbody>
        </table>',
                        'component' => ''
                    ],
                    '3' => [
                        'name' => 'Записать законы Кирхгофа для данной схемы, обозначив на схеме направление токов в ветвях.',
                        'content' => '',
                        'component' => ''
                    ]
                ]
            ]
        ];

        $result = json_encode($result);
        return $result;
    }
}