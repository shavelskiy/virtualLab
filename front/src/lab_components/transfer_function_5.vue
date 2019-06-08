<template>
    <div>
        <table class="table table-bordered ml-5">
            <thead>
            <tr>
                <td class="col-md-1 text-center"><b>k * f</b></td>
                <td class="col-md-1 text-center"><b>1</b></td>
                <td class="col-md-1 text-center"><b>0.3 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>0.5 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>0.8 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>1.2 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>1.5 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>1.8 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>2.0 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>2.5 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>3.0 f<sub>0</sub></b></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="col-md-1 text-center">
                    <b>f, кГц</b>
                </td>
                <td class="input" v-for="i in 11">
                    <input type="text" class="form-control value-input" v-model="freq[i -1]">
                </td>
            </tr>
            <tr>
                <td class="col-md-1 text-center">
                    <b>U<sub>1</sub>, В</b>
                </td>
                <td class="input" v-for="i in 11">
                    <input type="text" class="form-control value-input">
                </td>
            </tr>
            <tr>
                <td class="col-md-1 text-center">
                    <b>U<sub>2</sub>, В</b>
                </td>
                <td class="input" v-for="i in 11">
                    <input type="text" class="form-control value-input">
                </td>
            </tr>
            <tr>
                <td class="col-md-1 text-center"><b>&Delta;t, мкс</b></td>
                <td class="input" v-for="i in 11">
                    <input type="text" class="form-control value-input">
                </td>
            </tr>
            <tr>
                <td class="col-md-1 text-center">
                    <b>H(f)</b>
                </td>
                <td class="input" v-for="i in 11">
                    <input type="text" class="form-control value-input" v-model="amplitude[i -1]">
                </td>
            </tr>
            <tr>
                <td class="col-md-1 text-center">
                    <b>&psi;(f)</b>
                </td>
                <td class="input" v-for="i in 11">
                    <input type="text" class="form-control value-input" v-model="phase[i - 1]">
                </td>
            </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-5 ml-5">
                <div class="col-8 ml-4">
                    <label>Функция для АЧХ</label>
                    <input type="text" class="form-control" v-model="afrFunction">
                    <button type="button" class="btn btn-primary mt-4" v-on:click="drawAfr">Построить</button>
                </div>
                <canvas v-bind:id="afrId"  width="400" height="400" class="mt-3"></canvas>
            </div>
            <div class="col-5 ml-5">
                <div class="col-8 ml-4">
                    <label>Функция для Фчх</label>
                    <input type="text" class="form-control" v-model="pfrFunction">
                    <button type="button" class="btn btn-primary mt-4" v-on:click="drawPfr">Построить</button>
                </div>
                <canvas v-bind:id="pfrId" width="400" height="400" class="mt-3"></canvas>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "transfer_functions",

        data() {
            return {
                freq: [],
                amplitude: [],
                phase: [],

                afrId: null,
                pfrId: null,

                afrCanvas: null,
                afrContext: null,
                afrFunction: null,

                pfrCanvas: null,
                pfrContext: null,
                pfrFunction: null,
            }
        },

        methods: {
            drawAfr: function () {
                this.drawGrid(this.afrCanvas, this.afrContext);
                this.drawArrows(this.afrCanvas, this.afrContext, 50);
                this.drawGraph(this.afrCanvas, this.afrContext, this.afrFunction ? this.afrFunction : '0', 50, 250, this.amplitude);
            },

            drawPfr: function () {
                this.drawGrid(this.pfrCanvas, this.pfrContext);
                this.drawArrows(this.pfrCanvas, this.pfrContext, 200);
                this.drawGraph(this.pfrCanvas, this.pfrContext, this.pfrFunction ? this.pfrFunction : '0', 200, 200 / Math.PI, this.phase);
            },

            drawGraph(canvas, context, func, offset, k, tableData) {
                let f, w, isStart, x, y;

                func = func.replace(/sqrt/g, 'Math.sqrt').replace(/pow/g, 'Math.pow').replace(/atan/g, 'Math.atan').replace(/pi/g, 'Math.PI');

                isStart = true;

                context.lineWidth = 2;
                context.strokeStyle = 'rgb(255, 0, 0)';
                context.beginPath();

                for (f = 0; f <= 1200; f++) {
                    x = 50 + f / 4;
                    w = 2 * Math.PI * f;
                    y = canvas.height - offset - eval(func) * k;
                    if (isStart) {
                        context.moveTo(x, y);
                        isStart = false;
                    } else {
                        context.lineTo(x, y);
                    }
                }
                context.stroke();
                context.closePath();

                isStart = true;

                context.strokeStyle = 'rgb(36, 93, 210)';
                context.beginPath();

                for (var i = 0; i < 11; i++) {
                    x = this.freq[i] * 2 + 50;
                    y = canvas.height - offset - tableData[i] * k;
                    if (isStart) {
                        context.moveTo(x, y);
                        isStart = false;
                    } else {
                        context.lineTo(x, y);
                    }
                }

                context.stroke();
                context.closePath();
            },

            /**
             * Русиуем разметку
             */
            drawGrid: function (canvas, context) {
                context.clearRect(0, 0, canvas.width, canvas.height);

                // основной прямоугольник
                context.fillStyle = "rgb(255, 254, 242)";
                context.fillRect(0, 0, canvas.width, canvas.height);

                // основная сетка
                context.strokeStyle = "rgb(191, 191, 191)";
                context.lineWidth = 2.0;
                context.beginPath();
                drawVerticalLines(context, canvas, 50);
                drawHorizontalLines(context, canvas, 50);
                context.stroke();
                context.closePath();

                // вспомогательная сетка
                context.strokeStyle = "rgb(192, 192, 192)";
                context.lineWidth = 1.0;
                context.beginPath();
                drawVerticalLines(context, canvas, 10);
                drawHorizontalLines(context, canvas, 10);
                context.stroke();
                context.closePath();

                // внешняя рамка
                context.strokeStyle = "rgb(0, 0, 0)";
                context.lineWidth = 1.0;
                context.strokeRect(0, 0, canvas.width, canvas.height);

                function drawVerticalLines(context, canvas, gridSpacing) {
                    var i = gridSpacing;
                    while (i < canvas.width) {
                        context.moveTo(i, 0);
                        context.lineTo(i, canvas.height);
                        i = i + gridSpacing;
                    }
                }

                function drawHorizontalLines(context, canvas, gridSpacing) {
                    var i = gridSpacing;
                    while (i < canvas.height) {
                        context.moveTo(0, i);
                        context.lineTo(canvas.width, i);
                        i = i + gridSpacing;
                    }
                }
            },

            drawArrows(canvas, context, offset) {
                context.strokeStyle = "rgb(0, 0, 0)";
                context.fillStyle = "rgb(0, 0, 0)";
                context.lineWidth = 2.0;

                context.beginPath();
                context.moveTo(50, canvas.height - offset);
                context.lineTo(canvas.width - 70, canvas.height - offset);
                context.stroke();

                context.moveTo(50, canvas.height - 50);
                context.lineTo(50, 70);
                context.stroke();

                context.moveTo(canvas.width - 50, canvas.height - offset);
                context.lineTo(canvas.width - 70, canvas.height - offset - 5);
                context.lineTo(canvas.width - 70, canvas.height - offset + 5);
                context.fill();

                context.moveTo(50, 50);
                context.lineTo(45, 70);
                context.lineTo(55, 70);
                context.fill();

                var i = 100;
                while (i < canvas.width - 50) {
                    context.moveTo(i, canvas.height - offset + 5);
                    context.lineTo(i, canvas.height - offset - 5);
                    i = i + 50;
                }
                context.stroke();

                var i = 100;
                while (i < canvas.height - 50) {
                    context.moveTo(45, i);
                    context.lineTo(55, i);
                    i = i + 50;
                }
                context.stroke();
                context.closePath();

                // подписываем оси
                context.font = "bold 16px sans-serif";
                context.fillText("0", 38, canvas.height - offset + 16);
                context.fillText("f, кГц", canvas.width - 80, canvas.height - offset + 20);
                context.fillText("1", canvas.width - 150, canvas.height - offset + 22);

                if (offset > 100) {
                    context.fillText("P", 20, 65);
                    context.fillText("pi/2", 13, 100);
                    context.fillText("-pi/2", 10, 300);
                } else {
                    context.fillText("A", 20, 65);
                    context.fillText("1", 20, 100);
                }
            }
        },

        created() {
          this.afrId = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
          this.pfrId = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 5);
        },

        mounted() {
            this.afrCanvas = document.getElementById(this.afrId);
            if (this.afrCanvas.getContext) {
                this.afrContext = this.afrCanvas.getContext("2d");
                this.drawGrid(this.afrCanvas, this.afrContext);
                this.drawArrows(this.afrCanvas, this.afrContext, 50);
            }

            this.pfrCanvas = document.getElementById(this.pfrId);
            if (this.pfrCanvas.getContext) {
                this.pfrContext = this.pfrCanvas.getContext("2d");
                this.drawGrid(this.pfrCanvas, this.pfrContext);
                this.drawArrows(this.pfrCanvas, this.pfrContext, 200);
            }
        }
    }
</script>

<style scoped>

</style>
