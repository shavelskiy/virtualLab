<template>
  <div class="row">
    <div class="col-8 ml-5">
      <canvas id="graph" width="700" height="400"></canvas>
    </div>
    <div class="col-3">
      <div class="row ml-5">
        <div class="ml-3">
          <button type="button" class="btn btn-primary" @click="getData">Построить</button>
        </div>
      </div>
      <div class="row" v-show="errorCount">
        <p class="text-danger my-3">Заполните полностью таблицу!</p>
      </div>
      <div class="row" v-show="errorType">
        <p class="text-danger my-3">Введите корректные значения!</p>
      </div>
      <div class="row mt-5">
        <form class="form-horizontal">
          <div class="form-group">
            <label for="lab1-p1.3" class="col-sm-3 control-label px-3">
              r
              <sub>вн</sub> =
            </label>
            <div class="col-sm-5 px-0">
              <input type="text" class="form-control" id="lab1-p1.3">
            </div>
            <label class="col-sm-2 control-label pl-1">Ом</label>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { bus } from "../bus.js";

export default {
  name: "graph",

  data() {
    return {
      canvas: null,
      context: null,
      errorCount: false,
      errorType: false
    };
  },

  methods: {
    /**
     * Русиуем разметку
     */
    drawGrid: function() {
      this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);

      // основной прямоугольник
      this.context.fillStyle = "rgb(255, 254, 242)";
      this.context.fillRect(0, 0, this.canvas.width, this.canvas.height);

      // основная сетка
      this.context.strokeStyle = "rgb(191, 191, 191)";
      this.context.lineWidth = 2.0;
      this.context.beginPath();
      drawVerticalLines(this.context, this.canvas, 50);
      drawHorizontalLines(this.context, this.canvas, 50);
      this.context.stroke();
      this.context.closePath();

      // вспомогательная сетка
      this.context.strokeStyle = "rgb(192, 192, 192)";
      this.context.lineWidth = 1.0;
      this.context.beginPath();
      drawVerticalLines(this.context, this.canvas, 10);
      drawHorizontalLines(this.context, this.canvas, 10);
      this.context.stroke();
      this.context.closePath();

      //русуем оси
      this.context.strokeStyle = "rgb(0, 0, 0)";
      this.context.fillStyle = "rgb(0, 0, 0)";
      this.context.lineWidth = 2.0;

      this.context.beginPath();
      this.context.moveTo(50, this.canvas.height - 50);
      this.context.lineTo(this.canvas.width - 70, this.canvas.height - 50);
      this.context.stroke();

      this.context.moveTo(50, this.canvas.height - 50);
      this.context.lineTo(50, 70);
      this.context.stroke();

      this.context.moveTo(this.canvas.width - 50, this.canvas.height - 50);
      this.context.lineTo(this.canvas.width - 70, this.canvas.height - 55);
      this.context.lineTo(this.canvas.width - 70, this.canvas.height - 45);
      this.context.fill();

      this.context.moveTo(50, 50);
      this.context.lineTo(45, 70);
      this.context.lineTo(55, 70);
      this.context.fill();

      var i = 100;
      while (i < this.canvas.width - 50) {
        this.context.moveTo(i, this.canvas.height - 55);
        this.context.lineTo(i, this.canvas.height - 45);
        i = i + 50;
      }
      this.context.stroke();

      var i = 100;
      while (i < this.canvas.height - 50) {
        this.context.moveTo(45, i);
        this.context.lineTo(55, i);
        i = i + 50;
      }
      this.context.stroke();
      this.context.closePath();

      // подписываем оси
      this.context.font = "bold 16px sans-serif";
      this.context.fillText("0", 38, this.canvas.height - 34);
      this.context.fillText("I, мА", 5, 65);
      this.context.fillText(
        "U, В",
        this.canvas.width - 80,
        this.canvas.height - 30
      );
      this.context.fillText(
        "5",
        this.canvas.width - 150,
        this.canvas.height - 28
      );
      this.context.fillText("50", 15, 100);

      // внешняя рамка
      this.context.strokeStyle = "rgb(0, 0, 0)";
      this.context.lineWidth = 1.0;
      this.context.strokeRect(0, 0, this.canvas.width, this.canvas.height);

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

    getData: function() {
      bus.$emit("get-table-data");
    },

    drawGraph: function(data) {
      this.errorCount = data.errors.data;
      this.errorType = data.errors.type;
      console.log(this.errorCount);

      this.drawGrid();
      if (!this.errorCount && !this.errorType) {
        this.context.lineWidth = 2;
        var x0 = 50;
        var y0 = this.canvas.height - 50;

        this.context.beginPath();
        this.context.moveTo(
          x0 + 100 * data.data.volts[0],
          y0 - 5 * data.data.ampers[0]
        );

        for (var i = 1; i < 13; i++) {
          this.context.lineTo(
            x0 + 100 * data.data.volts[i],
            y0 - 5 * data.data.ampers[i]
          );
        }

        this.context.stroke();
        this.context.closePath();
      }
    }
  },

  mounted() {
    this.canvas = document.getElementById("graph");
    if (this.canvas.getContext) {
      this.context = this.canvas.getContext("2d");
      this.drawGrid();
    }

    bus.$on("draw-graph", this.drawGraph);
  }
};
</script>

<style scoped>
</style>
