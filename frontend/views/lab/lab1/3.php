<h3>3. Определение эквивалентного сопротивления.</h3>

<ul>
    <!--3.1-->
    <li class="mt-5">
        <p><b>3.1</b>
            &nbsp;&nbsp;В схеме рис. 1.4 рассчитать с помощью законов ирхгофа эквивалентное сопротивление
            относительно реального источника (активного двухполюсника) и<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            определить его, используя омметр. (При этом реальный источник
            отключить от схемы.)
        </p>
        <div class="row">
            <div class="col-4 ml-5">
                <?php if (1 % 2): ?>
                    <img src="/uploads/lab1/1.4b.png">
                <?php else: ?>
                    <img src="/uploads/lab1/1.4a.png">
                <?php endif; ?>
            </div>
            <div class="col-2 mt-3 ml-3 pr-0">
                E= 10 В<br>
                r<sub>вн</sub> = 60 Ом<br>
                R<sub>1</sub> = 1 кОм<br>
                R<sub>2</sub> = 2 кОм<br>
                R<sub>3</sub> = 10 кОм<br>
                R<sub>4</sub> = 100 Ом<br>
                R = <?= $R ?> Ом
            </div>
            <div class="col-3 pl-0 pt-2">
                <h5>Теоретический расчёт:</h5>
                <form class="form-horizontal">
                    <div class="form-group mb-0">
                        <label for="lab1-p3.1-1" class="col-sm-4 control-label px-3">R<sub>экв</sub> =</label>
                        <div class="col-sm-5 px-0">
                            <input type="text" class="form-control" id="lab1-p3.1">
                        </div>
                    </div>
                </form>
                <h5>Эксперемент:</h5>
                <form class="form-horizontal">
                    <div class="form-group mb-0">
                        <label for="lab1-p3.1-2" class="col-sm-4 control-label px-3">R<sub>экв</sub> =</label>
                        <div class="col-sm-5 px-0">
                            <input type="text" class="form-control" id="lab1-p3.1">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <h6 class="ml-5">Рис. 1.4 – Расчетные схема </h6>
    </li>
</ul>

<hr>
<div class="col text-center">
    <button class="prev-to-task-2 btn btn-primary">Назад</button>
    <button class="lab-end btn btn-primary">Завершить</button>
</div>
<hr>

<style>
    ul {
        list-style: none;
    }

    .value-input {
        width: 100%;
        height: 100%;
    }

    .input {
        height: 0px;
        padding: 2px !important;
    }
</style>
