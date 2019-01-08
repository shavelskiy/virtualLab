<?php

namespace frontend\controllers;

use yii\web\Controller;
use Yii;
use yii\web\Response;

class SchemeController extends Controller
{
    public function actionGet()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $result = [
            '1' => [
                'circuits' => [
                    [
                        'start' => ['x' => 240, 'y' => 80],
                        'points' => [
                            ['x' => 300, 'y' => 80],
                            ['x' => 300, 'y' => 220],
                            ['x' => 240, 'y' => 220],
                        ]
                    ],
                    [
                        'start' => ['x' => 170, 'y' => 50],
                        'points' => [
                            ['x' => 240, 'y' => 50],
                            ['x' => 240, 'y' => 250],
                            ['x' => 170, 'y' => 250],
                            ['x' => 170, 'y' => 50],
                        ]
                    ]
                ],
                'resistors' => [
                    'R' => [
                        'x' => 300,
                        'y' => 150,
                        'vertical' => true
                    ],
                ],
                'capacitor' => [],
                'coils' => [],
                'data' => [
                  'R' => '100 Ом'
                ],
                'texts' => [
                    ['text' => 'A', 'x' => 200, 'y' => 150]
                ]

            ],
            '2' => [
                'circuits' => [
                    [
                        'start' => ['x' => 240, 'y' => 80],
                        'points' => [
                            ['x' => 300, 'y' => 80],
                            ['x' => 300, 'y' => 100],
                        ]
                    ],
                    [
                        'start' => ['x' => 240, 'y' => 220],
                        'points' => [
                            ['x' => 300, 'y' => 220],
                            ['x' => 300, 'y' => 200],
                        ]
                    ],
                    [
                        'start' => ['x' => 170, 'y' => 50],
                        'points' => [
                            ['x' => 240, 'y' => 50],
                            ['x' => 240, 'y' => 250],
                            ['x' => 170, 'y' => 250],
                            ['x' => 170, 'y' => 50],
                        ]
                    ]
                ],
                'resistors' => [],
                'capacitor' => [],
                'coils' => [],
                'data' => [],
                'texts' => [
                    ['text' => 'A', 'x' => 200, 'y' => 150]
                ]
            ],
            '3' => [
                'circuits' => [
                    [
                        'start' => ['x' => 150, 'y' => 50],
                        'points' => [
                            ['x' => 250, 'y' => 50],
                            ['x' => 250, 'y' => 270],
                            ['x' => 150, 'y' => 270],
                            ['x' => 150, 'y' => 50],
                        ]
                    ],
                ],
                'resistors' => [
                    'R1' => [
                        'x' => 250,
                        'y' => 115,
                        'vertical' => true
                    ],
                    'R2' => [
                        'x' => 250,
                        'y' => 205,
                        'vertical' => true
                    ],
                ],
                'capacitor' => [],
                'source' => [
                    'E' => [
                        'x' => 150,
                        'y' => 150,
                        'vertical' => true,
                        'direction' => true
                    ]
                ],
                'coils' => [],
                'data' => [
                    'R1' => '100 Ом',
                    'R2' => '200 Ом',
                    'E' => '25 В',
                ],
                'texts' => []
            ],
            '4' => [
                'circuits' => [
                    [
                        'start' => ['x' => 150, 'y' => 50],
                        'points' => [
                            ['x' => 250, 'y' => 50],
                            ['x' => 250, 'y' => 200],
                            ['x' => 150, 'y' => 200],
                            ['x' => 150, 'y' => 50],
                        ]
                    ],
                    [
                        'start' => ['x' => 250, 'y' => 50],
                        'points' => [
                            ['x' => 320, 'y' => 50],
                            ['x' => 320, 'y' => 200],
                            ['x' => 250, 'y' => 200],
                        ]
                    ]
                ],
                'resistors' => [
                    'R1' => [
                        'x' => 250,
                        'y' => 125,
                        'vertical' => true
                    ],
                    'R' => [
                        'x' => 320,
                        'y' => 125,
                        'vertical' => true
                    ],
                    'R2' => [
                        'x' => 200,
                        'y' => 50,
                        'vertical' => false
                    ],
                ],
                'capacitor' => [],
                'source' => [
                    'E' => [
                        'x' => 150,
                        'y' => 125,
                        'vertical' => true,
                        'direction' => true
                    ]
                ],
                'coils' => [],
                'data' => [
                    'R' => '500 Ом',
                    'R1' => '100 Ом',
                    'R2' => '200 Ом',
                    'E' => '25 В',
                ],
                'texts' => []
            ],
            '5' => [
                'circuits' => [
                    [
                        'start' => ['x' => 220, 'y' => 50],
                        'points' => [
                            ['x' => 500, 'y' => 50],
                            ['x' => 500, 'y' => 200],
                            ['x' => 220, 'y' => 200],
                        ]
                    ],
                    [
                        'start' => ['x' => 340, 'y' => 50],
                        'points' => [
                            ['x' => 340, 'y' => 200],
                        ]
                    ],
                    [
                        'start' => ['x' => 420, 'y' => 50],
                        'points' => [
                            ['x' => 420, 'y' => 200],
                        ]
                    ],
                    [
                        'start' => ['x' => 150, 'y' => 25],
                        'points' => [
                            ['x' => 220, 'y' => 25],
                            ['x' => 220, 'y' => 225],
                            ['x' => 150, 'y' => 225],
                            ['x' => 150, 'y' => 25],
                        ]
                    ],
                ],
                'resistors' => [
                    'R' => [
                        'x' => 280,
                        'y' => 50,
                        'vertical' => false
                    ],
                    'R1' => [
                        'x' => 380,
                        'y' => 50,
                        'vertical' => false
                    ],
                    'R2' => [
                        'x' => 340,
                        'y' => 125,
                        'vertical' => true
                    ],
                    'R3' => [
                        'x' => 420,
                        'y' => 125,
                        'vertical' => true
                    ],
                    'R4' => [
                        'x' => 500,
                        'y' => 125,
                        'vertical' => true
                    ],
                ],
                'capacitor' => [],
                'coils' => [],
                'data' => [
                    'R1' => '100 Ом',
                    'R2' => '200 Ом',
                    'R3' => '200 Ом',
                    'R4' => '200 Ом',
                ],
                'texts' => [
                    ['text' => 'A', 'x' => 180, 'y' => 130]
                ]
            ],
        ];

        $result = json_encode($result);
        return $result;
    }
}
