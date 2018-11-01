<h3>2. Измерение тока и напряжения в схемах</h3>

<ul>
    <!--2.1-->
    <li class="mt-5">
        <p>
            Согласно варианту аналитически рассчитать коэффициент деления
            резистивного делителя напряжения – рис. 1.2 (K<sup>V</sup> = U<sub>2</sub> / U<sub>1</sub>)
        </p>
        <div class="row">
            <div class="col-5">
                <img src="/uploads/lab1/1.2.png">
            </div>
            <div class="col-5 mt-3">
                R<sub>1</sub> = 1 кОм
                <br>
                R<sub>2</sub> =
                <?php if (1 % 2): ?>
                    800
                <?php else: ?>
                    500
                <?php endif; ?>
                Ом
                <form class="form-horizontal bottom-align-text">
                    <div class="form-group mb-0">
                        <label for="lab1-p2.1" class="col-sm-3 control-label px-3">K<sup>V</sup> =</label>
                        <div class="col-sm-5 px-0">
                            <input type="text" class="form-control" id="lab1-p2.1">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <h6>Рис. 1.2 – Схема резистивного делителя напряжения </h6>
    </li>
</ul>

<hr>
<div class="col text-center">
    <button class="prev-to-task-1 btn btn-primary">Назад</button>
    <button class="next-to-task-3 btn btn-primary">Далее</button>
</div>
<hr>

<style>
    .bottom-align-text {
        position: absolute;
        bottom: 0;
        right: 0;
    }
</style>
