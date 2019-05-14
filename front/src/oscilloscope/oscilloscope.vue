<template>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-8">
          <canvas id="oscilloscope" width="700" height="400"></canvas>
        </div>
        <div class="col-4 my-auto">
          <settings :id="1" @changeSettings="changeSettings($event)"></settings>
          <settings :id="2" @changeSettings="changeSettings($event)"></settings>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Settings from "./settings.vue";
import { bus } from "../bus.js";

export default {
  name: "oscilloscope",

  components: {
    Settings: Settings
  },

  data() {
    return {
      values: null,
      canvas: null,
      context: null,
      isRec: true,
      generator: {
        amplitude: 5,
        freq: 1000
      },
      channel1: {
        points: {
          1: null,
          2: null
        },
        curVolt: 0,
        amplitude: 3,
        phase: 0
      },
      channel2: {
        points: {
          1: null,
          2: null
        },
        curVolt: 0,
        amplitude: 0,
        phase: 0
      },
      settings: {
        1: {
          active: true,
          voltDiv: 5,
          timeDiv: 1,
          offsetX: 0,
          offsetY: 0
        },
        2: {
          active: true,
          voltDiv: 5,
          timeDiv: 1,
          offsetX: 0,
          offsetY: 0
        }
      }
    };
  },

  mounted() {
    this.canvas = document.getElementById("oscilloscope");
    if (this.canvas.getContext) {
      this.context = this.canvas.getContext("2d");
      this.draw();
    }

    bus.$on("load-values", this.loadValues);
    bus.$on("send-generator-params", this.loadGeneratorParams);
    bus.$on("print-signal", this.acceptPoints);
  },

  methods: {
    loadValues: function(values) {
      this.values = values;
    },
    acceptPoints: function(channel1, channel2) {
      this.channel1.points[1] = channel1.point1;
      this.channel1.points[2] = channel1.point2;
      this.channel2.points[1] = channel2.point1;
      this.channel2.points[2] = channel2.point2;
      this.calculateSignals();
      this.draw();
    },
    loadGeneratorParams: function(data) {
      this.generator = data;
      this.calculateSignals();
      this.draw();
    },
    calculateSignals: function() {
      var re, im, tmp, k;

      var w = this.generator.freq / (2 * Math.PI),
        A = this.generator.amplitude;

      if (
        this.values[this.channel1.points[1] + "." + this.channel1.points[2]]
      ) {
        k = 1;
        tmp = this.values[
          this.channel1.points[1] + "." + this.channel1.points[2]
        ];
      } else if (
        this.values[this.channel1.points[2] + "." + this.channel1.points[1]]
      ) {
        k = -1;
        tmp = this.values[
          this.channel1.points[2] + "." + this.channel1.points[1]
        ];
      }

      if (tmp) {
        re = eval(tmp.re);
        im = eval(tmp.im);
        re = (re) ? re : 0;
        im = (im) ? im : 0;
        console.log(tmp, re, im)
        this.channel1.amplitude = Math.sqrt(re * re + im * im) * k;
        this.channel1.phase = (Math.atan(im / re) * 180) / Math.PI;
      } else {
        this.channel1.amplitude = 0;
        this.channel1.phase = 0;
      }

      tmp = undefined;
      if (
        this.values[this.channel2.points[1] + "." + this.channel2.points[2]]
      ) {
        k = 1;
        tmp = this.values[
          this.channel2.points[1] + "." + this.channel2.points[2]
        ];
      } else if (
        this.values[this.channel2.points[2] + "." + this.channel2.points[1]]
      ) {
        k = -1;
        tmp = this.values[
          this.channel2.points[2] + "." + this.channel2.points[1]
        ];
      }

      if (tmp) {
        re = eval(Number(tmp.re));
        im = eval(Number(tmp.im));
        this.channel2.amplitude = Math.sqrt(re * re + im * im) * k;
        this.channel2.phase = (Math.atan(im / re) * 180) / Math.PI;
      } else {
        this.channel2.amplitude = 0;
        this.channel2.phase = 0;
      }
    },
    draw: function() {
      this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
      drawMainGrid(this.canvas, this.context);

      if (this.settings["1"].active) {
        this.context.strokeStyle = "rgb(134, 222, 200)";
        if (!this.isRec) {
          drawSin(this.channel1, this.settings["1"], this.generator.freq, this.canvas, this.context);
        } else {
          drawRec(this.channel1, this.settings["1"], this.generator.freq, this.canvas, this.context);
        }
      }

      if (this.settings["2"].active) {
        this.context.strokeStyle = "rgb(234, 222, 200)";
        if (!this.isRec) {
          drawSin(this.channel2, this.settings["2"], this.generator.freq, this.canvas, this.context);
        } else {
          drawRec(this.channel2, this.settings["2"], this.generator.freq, this.canvas, this.context);
        }
      }

      // внешняя рамка
      this.context.strokeStyle = "rgb(223, 223, 223)";
      this.context.strokeRect(0, 0, this.canvas.width, this.canvas.height);

      /**
       * Рисует основную сетку
       */
      function drawMainGrid(canvas, context) {
        // основной прямоугольник
        context.fillStyle = "rgb(93, 177, 162)";
        context.fillRect(0, 0, canvas.width, canvas.height);

        // вспомогательная сетка
        context.strokeStyle = "rgb(111, 152, 142)";
        context.beginPath();
        drawVerticalLines(context, canvas, 20);
        drawHorizontalLines(context, canvas, 20);
        context.stroke();
        context.closePath();

        // основная сетка
        context.strokeStyle = "rgb(68, 116, 107)";
        context.beginPath();
        drawVerticalLines(context, canvas, 100);
        drawHorizontalLines(context, canvas, 100);
        context.stroke();
        context.closePath();

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
      }

      /**
       * нарисовать синусоидальный сигнал
       */
      function drawSin(channel, settings, freq, canvas, context) {
        var step = 0.01;

        var voltK = 100; // коэфициент, благодаря которому вольты корректно соотносятся с пикселями
        var timeK = 0.000005; // коэфициент для времени

        var xStart = settings.offsetX;
        var yStart = canvas.height / 2 - settings.offsetY;

        var yMax = canvas.height - yStart;
        var yMin = -1 * yStart;

        context.beginPath();
        context.moveTo(xStart + getX(0), yStart + getY(0));
        for (var t = xStart; t < canvas.width / step - xStart; t++) {
          context.lineTo(xStart + getX(t), yStart + getY(t));
        }

        context.lineWidth = 2;
        context.stroke();
        context.closePath();

        function getX(t) {
          return step * t;
        }

        function getY(t) {
          var y =
            ((-1 *
              (channel.curVolt +
                channel.amplitude *
                  Math.sin(
                    2 *
                      Math.PI *
                      freq *
                      t *
                      step *
                      timeK *
                      settings.timeDiv +
                      (channel.phase / 180) * Math.PI
                  ))) /
              settings.voltDiv) *
            voltK;
          if (y < yMin) {
            y = yMin;
          }
          if (y > yMax) {
            y = yMax;
          }
          return y;
        }
      }

      function drawRec(channel, settings, freq, canvas, context) {
        var step = 0.01;

        var voltK = 20; // коэфициент, благодаря которому вольты корректно соотносятся с пикселями
        var timeK = 10; // коэфициент для времени

        var xStart = settings.offsetX;
        var yStart = canvas.height / 2 - settings.offsetY;

        var yMax = canvas.height - yStart;
        var yMin = -1 * yStart;

        context.beginPath();
        context.moveTo(xStart + getX(0), yStart + getY(0));
        for (var t = xStart; t < canvas.width / step - xStart; t++) {
          context.lineTo(xStart + getX(t), yStart + getY(t));
        }

        context.lineWidth = 2;
        context.stroke();
        context.closePath();

        function getX(t) {
          return step * t;
        }

        console.log(settings.timeDiv);
        function getY(t) {
          var pos = t % (freq * settings.timeDiv * timeK);
          var y = 0;
          if (pos > freq * settings.timeDiv * timeK / 2) {
            y = -1 * channel.amplitude;
          }

          if (y < yMin) {
            y = yMin;
          }
          if (y > yMax) {
            y = yMax;
          }
          return y * voltK;
        }
      }
    },

    changeSettings: function(data) {
      this.settings[data.id] = data.settings;
      this.draw();
    }
  }
};
</script>

<style scoped>
</style>
