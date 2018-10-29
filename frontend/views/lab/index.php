<h2 class="text-center mb-5 mt-2">Доступные работы</h2>

<?php if (!empty($activeLabs)): ?>
    <?php foreach ($activeLabs as $lab): ?>
        <div class="card mb-4">
            <div class="card-header">
                <h4><?= 'Лабораторная работа №' . $lab->id . '. ' . $lab->name ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <img src="<?= '/uploads/labs/' . $lab->preview_picture ?>" height="100px">
                    </div>
                    <div class="col-8">
                        <p><?= $lab->description ?></p>
                        <a href="<?= Yii::$app->urlManager->createUrl(['lab/lab', 'number' => $lab->id]) ?>"
                           class="btn btn-primary">Начать выполнение</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center"> Нет доступных работ</p>
<?php endif; ?>
