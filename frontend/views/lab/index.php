<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-8">
                    <canvas id="oscilloscope" width="700" height="400"></canvas>
                </div>
                <div class="col-4 p-5">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="timeDiv">Время на деление:</label>
                                <select class="form-control" id="timeDiv">
                                    <option value="0.05">50 us</option>
                                    <option value="0.1">100 us</option>
                                    <option value="0.2">200 us</option>
                                    <option value="0.5">500 us</option>
                                    <option value="1" selected>1 ms</option>
                                    <option value="2">2 ms</option>
                                    <option value="5">5 ms</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="voltsDiv">Вольт на деление:</label>
                                <select class="form-control" id="voltsDiv">
                                    <option value="1">1 V</option>
                                    <option value="2">2 V</option>
                                    <option value="5" selected>5 V</option>
                                    <option value="10">10 V</option>
                                    <option value="25">25 V</option>
                                </select>
                            </div>

                            <label for="offsetX">Сдвиг по горизонтали</label>
                            <input type="range" id="offsetX" min="-500" max="500"/>

                            <label for="offsetY">Сдвиг по вертикали</label>
                            <input type="range" id="offsetY" min="-300" max="300"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-2">
                    <canvas id="data" width="180" height="400"></canvas>
                </div>
                <div class="col-7">
                    <canvas id="scheme" width="640" height="400"></canvas>
                </div>
                <div class="col-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Выберете сигналы</h4>
                        </div>
                        <div class="panel-body p-0">
                            <div class="container-fluid p-0">
                                <div class="row m-0 p-0">
                                    <div class="col m-0 pl-2 pr-1 pt-2">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label for="osci_1_1"></label>
                                                    <select class="form-control" id="osci_1_1">
                                                        <?php for ($i = 0; $i < 15; $i++): ?>
                                                            <option value="<?= $i ?>" selected><?= $i ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                    <label for="osci_1_2"></label>
                                                    <select class="form-control" id="osci_1_2">
                                                        <?php for ($i = 0; $i < 15; $i++): ?>
                                                            <option value="<?= $i ?>" selected><?= $i ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                    <!--                                                    <button type="button" class="btn btn-success">Success</button>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col m-0 pl-1 pr-2 pt-2">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label for="osci_1_1"></label>
                                                    <select class="form-control" id="osci_1_1">
                                                        <?php for ($i = 0; $i < 15; $i++): ?>
                                                            <option value="<?= $i ?>" selected><?= $i ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                    <label for="osci_1_2"></label>
                                                    <select class="form-control" id="osci_1_2">
                                                        <?php for ($i = 0; $i < 15; $i++): ?>
                                                            <option value="<?= $i ?>" selected><?= $i ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>