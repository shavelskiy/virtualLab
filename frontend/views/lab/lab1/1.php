<h3>
    1. Измерение внешней вольт-амперной характеристики (ВАХ)<br>
    реального источника постоянного напряжения
</h3>

<ul>
    <!--1.1-->
    <li class="mt-5">
        <p>
            Подключите вольтметр для измерения напряжения на резисторе
        </p>
    </li>
    <!--1.2-->
    <li class="mt-5">
        <p>
            С помощью вольтметра измерить напряжение на зажимах источника,
            устанавливая величину сопротивления нагрузки от 50 до 900 Ом, а
            также напряжение на разомкнутых зажимах источника (режим
            холостого хода,
            R &rarr;&infin;
            ). По данным измерений рассчитать ток.
            Результаты измерений и расчетов свести в таблицу 1.1.
        </p>
        <h6 class="text-right">Таблица 1.1</h6>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>R, Ом</td>
                <?php $resistors = ['50', '100', '150', '200', '250', '300', '400', '500', '600', '700', '800', '900']; ?>
                <?php foreach ($resistors as $resistor): ?>
                    <td><?= $resistor ?></td>
                <?php endforeach; ?>
                <td>&infin;</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>U, В</td>
                <?php for ($i = 0; $i < 13; $i++): ?>
                    <td class="input volts"><input type="text" class="value-input" volt-id="<?= $i ?>"></td>
                <?php endfor; ?>
            </tr>
            <tr>
                <td>I, мА</td>
                <?php for ($i = 0; $i < 13; $i++): ?>
                    <td class="input ampers"><input type="text" class="value-input" amper-id="<?= $i ?>"></td>
                <?php endfor; ?>
            </tr>
            </tbody>
        </table>
    </li>
    <!--1.3-->
    <li class="mt-5">
        <p>
            Построить измеренную внешнюю вольт-амперную характеристику
            реального источника. По полученной характеристике определить
            внутреннее сопротивление источника r<sub>вн</sub>
        </p>
        <div class="row">
            <div class="col-8">
                <canvas id="table-1.1" width="700" height="400"></canvas>
            </div>
            <div class="col-4">
                <div class="row">
                    <button type="button" class="btn btn-primary draw-graph">Построить</button>
                </div>
                <div class="row">
                    <p class="graph-error text-danger hidden my-3">Заполните полностью таблицу!</p>
                </div>
                <div class="row">
                    <p class="graph-error-type text-danger hidden my-3">Введите корректные значения!</p>
                </div>
                <div class="row mt-5">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="lab1-p1.3" class="col-sm-3 control-label px-3">r<sub>вн</sub> =</label>
                            <div class="col-sm-5 px-0">
                                <input type="text" class="form-control" id="lab1-p1.3">
                            </div>
                            <label class="col-sm-2 control-label pl-1">Ом</label>
                        </div>
                    </form>
                </div>
            </div>
            <script src="/js/labs/lab1/1/graph1.js"></script>
        </div>
    </li>
    <!--1.4-->
    <li class="mt-5">
        <p>Нарисовать последовательную и параллельную схемы замещения
            реального источника, рассчитать их параметры U<sub>р</sub> I<sub>к</sub> r<sub>вн</sub> g<sub>вн</sub>
        </p>
        <form class="form-horizontal">
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
        </form>
    </li>
</ul>
<hr>
<div class="col text-center">
    <button class="next-to-task-2 btn btn-primary">Далее</button>
</div>
<hr>

<style>
    .value-input {
        width: 100%;
        height: 100%;
    }

    .input {
        height: 0px;
        padding: 2px !important;
    }
</style>
