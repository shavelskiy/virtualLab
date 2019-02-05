<?php

use yii\helpers\Html;

/**
 * @var $lab \common\models\Lab
 */

$this->title = 'ЛР №' . $lab->id . '. ' . $lab->name;
$this->params['breadcrumbs'][] = ['label' => 'Лабораторные работы', 'url' => ['lab/index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['lab/update', 'id' => $lab->id]];
$this->params['breadcrumbs'][] = 'Изменение схем для лабораторной работы';

?>

<?php foreach ($lab->schemes as $scheme): ?>
    <?php echo '<pre>';
    var_dump($scheme);
    echo '</pre>';
    ?>
<?php endforeach; ?>
