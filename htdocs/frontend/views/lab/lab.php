<?php
/**
 * @var \common\models\Lab $lab
 */
$this->title = 'ЛР №' . $lab->id . '. ' . $lab->name;
?>

<div id="app"></div>

<?php require_once '../../dist/scripts.php'; ?>

<script src="<?= $scripts['lab'] ?>"></script>
