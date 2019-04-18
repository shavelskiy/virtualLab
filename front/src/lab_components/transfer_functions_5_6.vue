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
        <div class="col-6 ml-5">
            <div class="col-8 ml-4">
                <label>Функция для АЧХ</label>
                <input type="text" class="form-control" v-model="afrFunction">
                <button type="button" class="btn btn-primary mt-4" v-on:click="drawAfr">Построить</button>
            </div>
            <canvas id="afr" width="700" height="400" class="mt-3"></canvas>
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
                afrCanvas: null,
                afrContext: null,
                afrFunction: null
            }
        },

        methods: {
            /**
             * Русиуем разметку
             */
            drawGrid: function (canvas, context, xText, xValue, yText, yValute) {
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

                //русуем оси
                context.strokeStyle = "rgb(0, 0, 0)";
                context.fillStyle = "rgb(0, 0, 0)";
                context.lineWidth = 2.0;

                context.beginPath();
                context.moveTo(50, canvas.height - 50);
                context.lineTo(canvas.width - 70, canvas.height - 50);
                context.stroke();

                context.moveTo(50, canvas.height - 50);
                context.lineTo(50, 70);
                context.stroke();

                context.moveTo(canvas.width - 50, canvas.height - 50);
                context.lineTo(canvas.width - 70, canvas.height - 55);
                context.lineTo(canvas.width - 70, canvas.height - 45);
                context.fill();

                context.moveTo(50, 50);
                context.lineTo(45, 70);
                context.lineTo(55, 70);
                context.fill();

                var i = 100;
                while (i < canvas.width - 50) {
                    context.moveTo(i, canvas.height - 55);
                    context.lineTo(i, canvas.height - 45);
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
                context.fillText("0", 38, canvas.height - 34);
                context.fillText(yText, 20, 65);
                context.fillText(
                    xText,
                    canvas.width - 80,
                    canvas.height - 30
                );
                context.fillText(
                    xValue,
                    canvas.width - 150,
                    canvas.height - 28
                );
                context.fillText(yValute, 20, 100);

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

            drawAfr: function () {
                this.drawGrid(this.afrCanvas, this.afrContext, "f, кГц", "100", "A", "1");
                var f, a, func;
                this.afrContext.lineWidth = 2;
                this.afrContext.strokeStyle = 'rgb(255, 0, 0)';

                this.afrContext.beginPath();
                this.afrContext.moveTo(50, this.afrCanvas.height - 50);

                func = this.afrFunction ? this.afrFunction : '0';

                for (f = 0; f <= 110; f++) {
                    a = eval(func.replace(/sqrt/g, 'Math.sqrt'));
                    console.log(f, a)
                    this.afrContext.lineTo(
                        50 + f * 5,
                        this.afrCanvas.height - 50 - a * 250
                    );
                }

                this.afrContext.stroke();
                this.afrContext.closePath();

                this.afrContext.strokeStyle = 'rgb(36, 93, 210)';

                this.afrContext.beginPath();
                this.afrContext.moveTo(50, this.afrCanvas.height - 50);

                for (var i = 0; i < 11; i++) {
                    this.afrContext.lineTo(
                        this.freq[i] * 5 + 50,
                        this.afrCanvas.height - this.amplitude[i] * 250 - 50
                    );
                }

                this.afrContext.stroke();
                this.afrContext.closePath();
            }
        },

        mounted() {
            this.afrCanvas = document.getElementById("afr");
            if (this.afrCanvas.getContext) {
                this.afrContext = this.afrCanvas.getContext("2d");
                this.drawGrid(this.afrCanvas, this.afrContext, "f, кГц", "100", "A", "1");
            }
        }
    }
</script>

<style scoped>

</style>