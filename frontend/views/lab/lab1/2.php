<h3>2. Измерение тока и напряжения в схемах</h3>

<ul>
    <!--2.1-->
    <li class="mt-5">
        <p><b>2.1</b>
            &nbsp;&nbsp;Согласно варианту аналитически рассчитать коэффициент деления
            резистивного делителя напряжения – рис. 1.2 (K<sup>V</sup> = U<sub>2</sub> / U<sub>1</sub>)
        </p>
        <div class="row">
            <div class="col-4 ml-5">
                <img src="/uploads/lab1/1.2.png">
            </div>
            <div class="col-2 mt-3">
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
        <h6 class="ml-5">Рис. 1.2 – Схема резистивного делителя напряжения </h6>
    </li>
    <!--2.2-->
    <li class="mt-5">
        <p><b>2.2</b>
            &nbsp;&nbsp;Нарисовать схему рис.1.2 с источником постоянного напряжения и
            необходимыми приборами, для измерения напряжений U<sub>1</sub> и U<sub>2</sub>
        </p>
    </li>
    <!--2.3-->
    <li class="mt-5">
        <p><b>2.3</b>
            &nbsp;&nbsp;Выберете схему рис.1.2. На входе схемы должне быть включён источник
            постоянного напряжения. Измерить напряжения U<sub>1</sub> и U<sub>2</sub> .<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Рассчитать коэффициент деления напряжения – K<sup>V</sup> = U<sub>2</sub> / U<sub>1</sub> и сравнить с
            аналитически вычисленным значением в п. 2.1.
        </p>
        <form class="form-horizontal ml-4">
            <div class="form-group col-3">
                <label for="help1" class="col-sm-3 control-label px-3">U<sub>1</sub> =</label>
                <div class="col-sm-5 px-0">
                    <input type="text" class="form-control" id="help1">
                </div>
                <label class="col-sm-2 control-label pl-0">В</label>
            </div>
            <div class="form-group col-3">
                <label for="help2" class="col-sm-3 control-label px-3">U<sub>2</sub> =</label>
                <div class="col-sm-5 px-0">
                    <input type="text" class="form-control" id="help2">
                </div>
                <label class="col-sm-2 control-label pl-1">В</label>
            </div>
            <div class="form-group col-3">
                <label for="lab1-p2.3" class="col-sm-3 control-label px-3">K<sup>V</sup> =</label>
                <div class="col-sm-5 px-0">
                    <input type="text" class="form-control" id="lab1-p2.3">
                </div>
            </div>
        </form>
    </li>
    <!--2.4-->
    <li class="mt-5">
        <p><b>2.4</b>
            &nbsp;&nbsp;Выберите схему рис 1.3 с источник постоянного напряжения на входе
        </p>
        <div class="row">
            <div class="col-4 ml-5">
                <img src="/uploads/lab1/1.3.png">
            </div>
            <div class="col-2 mt-5">
                R<sub>1</sub> = 1 кОм
                <br>
                R<sub>2</sub> = 2 кОм
                <br>
                R =
                <?php switch (10 % 10) {
                    case 0:
                        echo '100';
                        break;
                    case 1:
                        echo '200';
                        break;
                    case 2:
                        echo '250';
                        break;
                    case 3:
                        echo '300';
                        break;
                    case 4:
                        echo '400';
                        break;
                    case 5:
                        echo '500';
                        break;
                    case 6:
                        echo '600';
                        break;
                    case 7:
                        echo '700';
                        break;
                    case 8:
                        echo '800';
                        break;
                    case 9:
                        echo '900';
                        break;
                }
                ?>
                Ом
            </div>
        </div>
        <h6 class="ml-5">Рис 1.3−Схема резистивного делителя токов</h6>
    </li>
    <!--2.5-->
    <li class="mt-5">
        <p><b>2.5</b>
            &nbsp;&nbsp;Измерить напряжения U<sub>1</sub>, U<sub>2</sub>, U. По показаниям вольтметров
            определить токи I<sub>1</sub>, I<sub>2</sub>, I.
        </p>
        <form class="form-horizontal ml-5">
            <div class="form-row">
                <div class="form-group col-3">
                    <label for="lab1-p2.5-1" class="col-sm-3 control-label px-3">U<sub>1</sub> =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p2.5-1">
                    </div>
                    <label class="col-sm-2 control-label pl-0">В</label>
                </div>
                <div class="form-group col-3">
                    <label for="lab1-p2.5-4" class="col-sm-3 control-label px-3">I<sub>1</sub> =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p2.5-4">
                    </div>
                    <label class="col-sm-2 control-label pl-0">мА</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-3">
                    <label for="lab1-p2.5-2" class="col-sm-3 control-label px-3">U<sub>2</sub> =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p2.5-2">
                    </div>
                    <label class="col-sm-2 control-label pl-0">В</label>
                </div>
                <div class="form-group col-3">
                    <label for="lab1-p2.5-5" class="col-sm-3 control-label px-3">I<sub>2</sub> =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p2.5-5">
                    </div>
                    <label class="col-sm-2 control-label pl-0">мА</label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-3">
                    <label for="lab1-p2.5-3" class="col-sm-3 control-label px-3">U =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p2.5-3">
                    </div>
                    <label class="col-sm-2 control-label pl-0">В</label>
                </div>
                <div class="form-group col-3">
                    <label for="lab1-p2.5-6" class="col-sm-3 control-label px-3">I =</label>
                    <div class="col-sm-5 px-0">
                        <input type="text" class="form-control" id="lab1-p2.5-6">
                    </div>
                    <label class="col-sm-2 control-label pl-0">мА</label>
                </div>
            </div>
        </form>
    </li>
    <!--2.6-->
    <li class="mt-5">
        <p><b>2.6</b>
            &nbsp;&nbsp;Используя вторую формулу разброса, проверить полученный
            результат.
        </p>
    </li>
</ul>

<hr>
<div class="col text-center">
    <button class="prev-to-task-1 btn btn-primary">Назад</button>
    <button class="next-to-task-3 btn btn-primary">Далее</button>
</div>
<hr>

<style>
    ul {
        list-style: none;
    }

    .bottom-align-text {
        position: absolute;
        bottom: 20px;
        right: 0;
    }
</style>
