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
            внутреннее сопротивление источника rвн.
        </p>
        <div class="row">
            <div class="col-8">
                <canvas id="table-1.1" width="700" height="400"></canvas>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-primary draw-graph">Построить</button>
                <p class="graph-error text-danger hidden my-3">Заполните полностью таблицу!</p>
                <p class="graph-error-type text-danger hidden my-3">Введите корректные значения!</p>
            </div>
        </div>
        <script src="/js/labs/lab1/1/graph1.js"></script>
    </li>
</ul>

<button class="next-to-task-2">Next</button>

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
