<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\Lab;

class LabController extends Controller
{
    public function actionInit()
    {
        $lab = new Lab();
        $lab->name = 'Исследование простейших электрических цепей';
        $lab->description = 'Нарисовать схему для измерения напряжения холостого хода (разрыва), отобразив включение вольтметра. Провести измерения напряжения разрыва.';
        $lab->preview_picture = 'lab1_pre.png';
        $lab->save();

        $lab = new Lab();
        $lab->name = 'Установившиеся режимы в линейных цепях с источниками синусоидального напряжения';
        $lab->description = 'Измерение и расчет комплексных значений токов и напряжений в электрических цепях, содержащих элементы R, L и C при воздействии синусоидального источника ЭДС.';
        $lab->preview_picture = 'lab2_pre.png';
        $lab->save();

        $lab = new Lab();
        $lab->name = 'Частотные характеристики пассивных электрических цепей';
        $lab->description = 'Исследование комплексных передаточных функций четырехполюсников различного вида.';
        $lab->preview_picture = 'lab3_pre.png';
        $lab->save();

        $lab = new Lab();
        $lab->name = 'Исследование параметров индуктивно связанных катушек. Линейный трансформатор.';
        $lab->description = 'определение параметров индуктивно связанных катушек и исследование свойств линейного трансформатора.';
        $lab->preview_picture = 'lab4_pre.png';
        $lab->save();

        $lab = new Lab();
        $lab->name = 'Частотные характеристики пассивных электрических цепей второго порядка';
        $lab->description = 'Исследование комплексных передаточных функций четырехполюсников различного вида.';
        $lab->preview_picture = 'lab5_pre.png';
        $lab->save();

        $lab = new Lab();
        $lab->name = 'Переходные процессы в RC цепи';
        $lab->description = 'Исследование переходных процессов в RC цепи, определение переходной функции, анализ цепи при воздействии источника напряжения прямоугольной формы.';
        $lab->preview_picture = 'lab6_pre.png';
        $lab->save();
    }
}