<?php
/**
 * Created by PhpStorm.
 * User: phoenix
 * Date: 13.02.18
 * Time: 15:56
 */

namespace backend\widgets;


use yii\grid\ActionColumn;
use yii\helpers\Html;

class CActionColumn extends ActionColumn
{
    public static function renderDeleteButton($url) {
        $title = \Yii::t('yii', 'Delete');
        $options = array_merge([
            'title' => $title,
            'aria-label' => $title,
            'data-pjax' => '0',
        ], [
            'data-confirm' => \Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
        ]);
        $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-trash"]);
        return Html::a($icon, $url, $options);
    }
}