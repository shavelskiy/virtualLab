<h3>
    1. Измерение внешней вольт-амперной характеристики (ВАХ)<br>
    реального источника постоянного напряжения
</h3>

<ul>
    <!--1.1-->
    <li>
        <p>
            Подключите вольтметр для измерения напряжения на резисторе
        </p>
    </li>
    <!--1.2-->
    <li>
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
    <li>
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
                            <label for="lab1-p3.1" class="col-sm-3 control-label px-3">r<sub>вн</sub> =</label>
                            <div class="col-sm-5 px-0">
                                <input type="text" class="form-control" id="lab1-p3.1">
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
    <li>
        <p>Нарисовать последовательную и параллельную схемы замещения
            реального источника, рассчитать их параметры U<sub>р</sub> I<sub>к</sub> r<sub>вн</sub> g<sub>вн.</sub>
        </p>
        <div class="row">
            <div class="col-3">
                <label for="lab1-p3.1">Rвн:</label>
                <input type="text" class="form-control col-4 ml-3" id="lab1-p3.1 ">
            </div>
            <div class="col-3">
                <label for="lab1-p3.1">Rвн:</label>
                <input type="text" class="form-control col-4 ml-3" id="lab1-p3.1 ">
            </div>
            <div class="col-3">
                <label for="lab1-p3.1">Rвн:</label>
                <input type="text" class="form-control col-4 ml-3" id="lab1-p3.1 ">
            </div>
            <div class="col-3">
                <label for="lab1-p3.1">Rвн:</label>
                <input type="text" class="form-control col-4 ml-3" id="lab1-p3.1 ">
            </div>
        </div>
    </li>
</ul>
<hr>
<button class="next-to-task-2 text-center btn btn-primary">Далее</button>
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
