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
  import Settings from './settings.vue'

  export default {
    name: 'oscilloscope',

    components: {
      'Settings': Settings
    },

    data() {
      return {
        canvas: null,
        context: null,
        channel1: {
          'curVolt': 1,
          'amplitude': 5,
          'freq': 4500,
          'phase': 0
        },
        channel2: {
          'curVolt': 3,
          'amplitude': 2,
          'freq': 2000,
          'phase': 0
        },
        settings: {
          1: {
            'active': true,
            'voltDiv': 5,
            'timeDiv': 1,
            'offsetX': 0,
            'offsetY': 0
          },
          2: {
            'active': true,
            'voltDiv': 5,
            'timeDiv': 1,
            'offsetX': 0,
            'offsetY': 0
          }
        }
      }
    },

    mounted() {
      this.canvas = document.getElementById('oscilloscope');
      if (this.canvas.getContext) {
        this.context = this.canvas.getContext('2d');
        this.draw()
      }
    },

    methods: {
      draw: function () {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height)
        drawMainGrid(this.canvas, this.context)

        if (this.settings["1"].active) {
          this.context.strokeStyle = 'rgb(134, 222, 200)'
          drawSin(this.channel1, this.settings["1"], this.canvas, this.context)
        }

        if (this.settings["2"].active) {
          this.context.strokeStyle = 'rgb(234, 222, 200)'
          drawSin(this.channel2, this.settings["2"], this.canvas, this.context)
        }

        // внешняя рамка
        this.context.strokeStyle = 'rgb(223, 223, 223)'
        this.context.strokeRect(0, 0, this.canvas.width, this.canvas.height)

        /**
         * Рисует основную сетку
         */
        function drawMainGrid(canvas, context) {
          // основной прямоугольник
          context.fillStyle = 'rgb(93, 177, 162)'
          context.fillRect(0, 0, canvas.width, canvas.height)

          // вспомогательная сетка
          context.strokeStyle = 'rgb(111, 152, 142)'
          context.beginPath()
          drawVerticalLines(context, canvas, 20)
          drawHorizontalLines(context, canvas, 20)
          context.stroke()
          context.closePath()

          // основная сетка
          context.strokeStyle = 'rgb(68, 116, 107)'
          context.beginPath()
          drawVerticalLines(context, canvas, 100);
          drawHorizontalLines(context, canvas, 100);
          context.stroke()
          context.closePath()

          function drawVerticalLines(context, canvas, gridSpacing) {
            var i = gridSpacing;
            while (i < canvas.width) {
              context.moveTo(i, 0)
              context.lineTo(i, canvas.height)
              i = i + gridSpacing
            }
          }

          function drawHorizontalLines(context, canvas, gridSpacing) {
            var i = gridSpacing;
            while (i < canvas.height) {
              context.moveTo(0, i)
              context.lineTo(canvas.width, i)
              i = i + gridSpacing
            }
          }
        }

        /**
         * нарисовать синусоидальный сигнал
         */
        function drawSin(channel, settings, canvas, context) {
          var step = 0.01

          var voltK = 100 // коэфициент, благодаря которому вольты корректно соотносятся с пикселями
          var timeK = 0.000005 // коэфициент для времени

          var xStart = settings.offsetX
          var yStart = canvas.height / 2 - settings.offsetY

          var yMax = canvas.height - yStart
          var yMin = (-1) * yStart

          context.beginPath()
          context.moveTo(xStart + getX(0), yStart + getY(0))
          for (var t = xStart; t < canvas.width / step - xStart; t++) {
            context.lineTo(xStart + getX(t), yStart + getY(t))
          }

          context.lineWidth = 2
          context.stroke()
          context.closePath()

          function getX(t) {
            return step * t
          }

          function getY(t) {
            var y = (-1) * (
              channel.curVolt +
              channel.amplitude *
              Math.sin(
                2 * Math.PI * channel.freq * t * step * timeK * settings.timeDiv + channel.phase / 180 * Math.PI
              )) / settings.voltDiv * voltK
            if (y < yMin) {
              y = yMin
            }
            if (y > yMax) {
              y = yMax
            }
            return y
          }
        }
      },

      changeSettings: function (data) {
        this.settings[data.id] = data.settings
        this.draw()
      }
    }
  }
</script>

<style scoped>

</style>
