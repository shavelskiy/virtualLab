<h3>
    1. Измерение внешней вольт-амперной характеристики (ВАХ)<br>
    реального источника постоянного напряжения
</h3>

<ul>
    <li>
        
    </li>
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
                    <td></td>
                <?php endfor; ?>
            </tr>
            <tr>
                <td>I, мА</td>
                <?php for ($i = 0; $i < 13; $i++): ?>
                    <td></td>
                <?php endfor; ?>
            </tr>
            </tbody>
        </table>
    </li>
</ul>

<button class="next-to-task-2">Next</button>
