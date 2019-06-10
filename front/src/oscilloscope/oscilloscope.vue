<template>
  <div class="panel panel-default">
    <div class="panel-body device-color">
      <div class="row">
        <div class="col-8">
          <canvas id="oscilloscope" width="700" height="400"></canvas>
        </div>
        <div class="col-4 my-auto">
          <settings :id="1"></settings>
          <settings :id="2"></settings>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Settings from "./settings.vue";
  import {bus} from "../bus.js";

  export default {
    name: "oscilloscope",

    components: {
      Settings: Settings
    },

    data() {
      return {
        cacheValues: {
          1: {},
          2: {}
        },
        values: null,
        canvas: null,
        context: null,
        signal: null,
        generator: {
          amplitude: 0,
          freq: 0
        },
        channels: {
          1: {
            points: {
              1: null,
              2: null
            },
            amplitude: 0,
            phase: 0,
            first_front: '0',
            second_front: '0',
            reverse: false
          },
          2: {
            points: {
              1: null,
              2: null
            },
            amplitude: 0,
            phase: 0,
            first_front: '0',
            second_front: '0',
            reverse: false
          }
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

    methods: {
      // получаем значения сигналов при смене схемы
      loadValues: function (values) {
        this.values = values;
      },

      // получаем тип сигнала
      acceptSignal: function (signal) {
        this.signal = signal;
      },

      // принимаем выбранные узлы
      acceptPoints: function (channel1, channel2) {
        this.channels[1].points[1] = channel1.point1;
        this.channels[1].points[2] = channel1.point2;
        this.channels[2].points[1] = channel2.point1;
        this.channels[2].points[2] = channel2.point2;
        this.calculateSignals();
      },

      // принимаем новые настройки
      changeSettings: function (data) {
        this.settings[data.id] = data.settings;
        this.resetCache();
        this.draw();
      },

      // принимаем значения от другого компонента - генератор
      loadGeneratorParams: function (data) {
        this.generator = data;
        this.calculateSignals();
      },

      // сбросить кэш
      resetCache() {
        this.cacheValues = {
          1: {},
          2: {},
        };
      },

      // пересчитать сигналы
      calculateSignals: function () {
        this.resetCache();
        let re, im, tmp, point1, point2;

        let w = this.generator.freq / (2 * Math.PI),
                A = this.generator.amplitude;

        // если есть значения
        if (this.values) {
          for (let i = 1; i <= 2; i++) {
            tmp = undefined;

            point1 = this.channels[i].points[1];
            point2 = this.channels[i].points[2];

            if (this.values[point1 + "." + point2]) {
              this.channels[i].reverse = false;
              tmp = this.values[point1 + "." + point2];
            } else if (this.values[point2 + "." + point1]) {
              this.channels[i].reverse = true;
              tmp = this.values[point2 + "." + point1];
            }

            if (tmp) {
              if (this.signal === 'sinusoidal') {
                try {
                  re = eval(tmp.re.replace(/pow/g, 'Math.pow'));
                  im = eval(tmp.im.replace(/pow/g, 'Math.pow'));
                  re = (re) ? re : 0;
                  im = (im) ? im : 0;
                } catch (e) {
                  re = 0;
                  im = 0;
                }
                console.log(tmp)
                console.log(A, w)
                console.log(tmp.re.replace(/pow/g, 'Math.pow'))
                console.log(im)
                this.channels[i].amplitude = Math.sqrt(re * re + im * im);
                this.channels[i].phase = (Math.atan(im / re) * 180) / Math.PI;
              } else if (this.signal === 'rectangular') {
                this.channels[i].first_front = tmp.first_front.replace(/exp/g, 'Math.exp').replace(/A/g, 'generator.amplitude').replace(/pow/g, 'Math.pow');
                this.channels[i].second_front = tmp.second_front.replace(/exp/g, 'Math.exp').replace(/A/g, 'generator.amplitude').replace(/pow/g, 'Math.pow');
              }
            } else {
              this.channels[i].amplitude = 0;
              this.channels[i].phase = 0;
              this.channels[i].first_front = '';
              this.channels[i].second_front = '';
            }
          }
        }

        this.draw();
      },

      // нарисовать сигналы
      draw: function () {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
        drawMainGrid(this.canvas, this.context);

        for (let i = 1; i <= 2; i++) {
          if (this.settings[i].active) {
            this.context.strokeStyle = (i == 1) ? 'rgb(134, 222, 200)' : 'rgb(234, 222, 200)';
            this.cacheValues[i] = drawSignal(i, this.channels[i], this.settings[i], this.generator, this.canvas, this.context, this.signal, this.cacheValues[i]);
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
            let i = gridSpacing;
            while (i < canvas.width) {
              context.moveTo(i, 0);
              context.lineTo(i, canvas.height);
              i = i + gridSpacing;
            }
          }

          function drawHorizontalLines(context, canvas, gridSpacing) {
            let i = gridSpacing;
            while (i < canvas.height) {
              context.moveTo(0, i);
              context.lineTo(canvas.width, i);
              i = i + gridSpacing;
            }
          }
        }

        function drawSignal(i, channel, settings, generator, canvas, context, signal, cache) {
          // параметры отрисовки
          let step = 1;

          let curY, time;
          let T = 1 / generator.freq;

          let voltK = 100; // коэфициент, благодаря которому вольты корректно соотносятся с пикселями

          if (channel.reverse) {
            voltK = voltK * (-1);
          }

          let timeK = 0.00001; // коэфициент для времени

          let xStart = settings.offsetX;
          let xEnd = (settings.offsetX > 0) ? canvas.width : canvas.width + settings.offsetX;

          let yStart = canvas.height / 2 - settings.offsetY;

          context.beginPath();
          context.moveTo(xStart, yStart - getY(0));

          // основной цикл отрисовки
          for (let x = (xStart > 0) ? xStart : 0; x < xEnd; x += step) {

            time = getT(x);
            time = time % T;

            if (cache[time] !== undefined) {
              curY = cache[time];
            } else {
              curY = getY(time);
              cache[time] = curY;
            }
            context.lineTo(x, yStart - curY);
          }

          context.lineWidth = 2;
          context.stroke();
          context.closePath();

          // получить время
          function getT(x) {
            return (x - xStart) * settings.timeDiv * timeK;
          }

          // получить значение
          function getY(time) {
            let y = 0;

            if (signal === 'sinusoidal') {
              y = getSin(time);
              y = (y) ? y : 0;
            } else if (signal === 'rectangular') {
              y = getRec(time);
            }

            return y * voltK / settings.voltDiv;
          }

          function getSin(time) {
            return (channel.amplitude * Math.sin(2 * Math.PI * generator.freq * time + (channel.phase / 180) * Math.PI));
          }

          function getRec(t) {
            let y = 0;

            if (t > 1 / (2 * generator.freq)) {
              t -= 1 / (2 * generator.freq);
              try {
                y = eval(channel.second_front);
                y = (y) ? y : 0;
              } catch (e) {
                y = 0;
              }
            } else {
              try {
                y = eval(channel.first_front);
                y = (y) ? y : 0;
              } catch (e) {
                y = 0;
              }
            }

            return y;
          }

          return cache;
        }
      },
    },

    mounted() {
      this.canvas = document.getElementById("oscilloscope");
      if (this.canvas.getContext) {
        this.context = this.canvas.getContext("2d");
        this.calculateSignals();
      }

      bus.$on("signal-view", this.acceptSignal); // получаем вид сигнала
      bus.$on("load-values", this.loadValues); // получаем значения для схемы
      bus.$on("send-generator-params", this.loadGeneratorParams); // получаем значения генератора
      bus.$on("print-signal", this.acceptPoints); // рисуем сигнал при смене узлов
      bus.$on("change-settings", this.changeSettings); // принимаем настройки
    },
  };
</script>

<style scoped>
</style>
