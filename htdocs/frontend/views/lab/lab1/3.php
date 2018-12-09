<h3>3. Определение эквивалентного сопротивления.</h3>

<ul>
    <!--3.1-->
    <li class="mt-5">
        <p><b>3.1</b>
            &nbsp;&nbsp;В схеме рис. 1.4 рассчитать с помощью законов Кирхгофа эквивалентное сопротивление
            относительно реального источника (активного двухполюсника) и<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            определить его, используя омметр. (При этом реальный источник
            отключить от схемы).
        </p>
        <div class="row">
            <div class="col-4 ml-5">
                <?php if (1 % 2): ?>
                    <img src="/data/uploads/lab1/1.4b.png">
                <?php else: ?>
                    <img src="/data/uploads/lab1/1.4a.png">
                <?php endif; ?>
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
        <h6 class="ml-5">Рис. 1.4 – Расчетные схема </h6>
    </li>
    <!--3.2-->
    <li class="mt-5">
        <p>
            <b>3.2</b>
            &nbsp;&nbsp;Определить эквивалентное сопротивление R<sub>экв</sub> относительно реального
            источника с помощью вольтметра. Измерить напряжение U и
            напряжение на<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; резисторе
            R<?php if (!(1 % 2)) echo '<sub>4</sub>'; ?>
        </p>
        <table class="table table-bordered ml-5 table-p3-2">
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
                <?php for ($i = 1; $i <= 3; $i++): ?>
                    <td class="input volts"><input type="text" class="form-control" id="lab1-p3.2-<?= $i ?>"></td>
                <?php endfor; ?>
            </tr>
            </tbody>
        </table>
    </li>
    <!--3.3-->
    <li class="mt-5">
        <p>
            <b>3.3</b>
            &nbsp;&nbsp;Записать законы Кирхгофа для данной схемы, обозначив на схеме
            направление токов в ветвях.
        </p>
    </li>
</ul>

<hr>
<div class="col text-center">
    <button class="prev-to-task-2 btn btn-primary">Назад</button>
    <button class="lab-end btn btn-primary">Завершить</button>
</div>
<hr>

