<!--<!--Нижний блок-->
<!--<div class="panel panel-default">-->
<!--    <div class="panel-body p-4">-->
<!--        <div class="row">-->
<!--            <div class="col-2">-->
<!--                <div class="panel panel-default" style="margin-bottom: 0px !important; height: 100%;">-->
<!--                    <div class="panel-body">-->
<!--                        <canvas id="data" width="180" height="400"></canvas>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-7 px-0">-->
<!--                <div class="panel panel-default" style="margin-bottom: 0px !important;">-->
<!--                    <div class="panel-body">-->
<!--                        <div class="col">-->
<!--                            <form class="form-horizontal">-->
<!--                                <div class="form-group">-->
<!--                                    <label for="lab1-p1.3" class="col-sm-3 control-label px-3">Выбрать схему</label>-->
<!--                                    <div class="col-sm-5 px-0">-->
<!--                                        <select class="form-control choose-scheme">-->
<!--                                            <option value="1">1</option>-->
<!--                                            <option value="2">2</option>-->
<!--                                            <option value="3">3</option>-->
<!--                                            <option value="4">4</option>-->
<!--                                            <option value="5">5</option>-->
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                        <canvas id="scheme" width="640" height="360"></canvas>-->
<!--                        <div class="col">-->
<!--                            <form class="form-horizontal select-value">-->
<!--                                <div class="form-group">-->
<!--                                    <label for="lab1-p1.3" class="col-sm-3 control-label px-3">Изменить R</label>-->
<!--                                    <div class="col-sm-5 px-0">-->
<!--                                        <select class="form-control choose-resistor">-->
<!--                                            <option value="50">50 Ом</option>-->
<!--                                            <option value="100">100 Ом</option>-->
<!--                                            <option value="150">150 Ом</option>-->
<!--                                            <option value="200">200 Ом</option>-->
<!--                                            <option value="250">250 Ом</option>-->
<!--                                            <option value="300">300 Ом</option>-->
<!--                                            <option value="400">400 Ом</option>-->
<!--                                            <option value="500">500 Ом</option>-->
<!--                                            <option value="600">600 Ом</option>-->
<!--                                            <option value="700">700 Ом</option>-->
<!--                                            <option value="800">800 Ом</option>-->
<!--                                            <option value="900">900 Ом</option>-->
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-3">-->
<!--                <div class="panel panel-default" style="margin-bottom: 0px !important; height: 100%;">-->
<!--                    --><?php //if ($number != 1): ?>
<!--                        <div class="panel-heading">-->
<!--                            <h4>Выберете сигналы</h4>-->
<!--                        </div>-->
<!--                        <div class="panel-body p-3" id="choose">-->
<!--                            --><?php //for ($i = 1; $i <= 2; $i++): ?>
<!--                                <div class="panel panel-default">-->
<!--                                    <div class="panel-heading">-->
<!--                                        <label>Канал --><?// //= $i ?><!--</label>-->
<!--                                    </div>-->
<!--                                    <div class="panel-body p-0">-->
<!--                                        <div class="container-fluid p-0">-->
<!--                                            <div class="row p-0 m-0" id="points">-->
<!--                                                <div class="col m-0 pl-2 pr-1 pt-2 pb-2">-->
<!--                                                    <select class="form-control" channel="--><?//= $i ?><!--"></select>-->
<!--                                                </div>-->
<!--                                                <div class="col m-0 pl-1 pr-2 pt-2 pb-2">-->
<!--                                                    <select class="form-control" channel="--><?//= $i ?><!--"></select>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <div class="row p-0 m-0">-->
<!--                                                <div class="col p-2 text-center">-->
<!--                                                    <button type="button" class="btn btn-default"-->
<!--                                                            id="draw_osci" channel="--><?//= $i ?><!--">-->
<!--                                                        Построить-->
<!--                                                    </button>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            --><?php //endfor; ?>
<!--                        </div>-->
<!--                    --><?php //endif; ?>
<!--                    <div class="panel-heading">-->
<!--                        <h4>Выберете сигналы</h4>-->
<!--                    </div>-->
<!--                    <div class="panel-body p-3" id="choose">-->
<!--                        <div class="panel panel-default">-->
<!---->
<!--                            <div class="panel-body p-0">-->
<!--                                <div class="container-fluid p-0">-->
<!--                                    <div class="row p-0 m-0" id="points">-->
<!--                                        <div class="col m-0 pl-2 pr-1 pt-2 pb-2">-->
<!--                                            <select class="form-control point-1"></select>-->
<!--                                        </div>-->
<!--                                        <div class="col m-0 pl-1 pr-2 pt-2 pb-2">-->
<!--                                            <select class="form-control point-2"></select>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!---->
<!---->

<div id="app"></div>
<script src="/dist/build.js"></script>
