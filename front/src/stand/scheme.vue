<template>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="col">
        <form class="form-horizontal">
          <div class="form-group">
            <label for="choose-scheme" class="col-sm-3 control-label px-3">Выбрать схему</label>
            <div class="col-sm-5 px-0">
              <select class="form-control" @change="drawScheme" v-model.number="currentScheme">
                <option v-for="n in schemeCol" :value="n">{{ n }}</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <canvas id="scheme" width="640" height="360"></canvas>
      <div class="col">
        <form class="form-horizontal">
          <div class="form-group">
            <label for="choose-resistor" class="col-sm-3 control-label px-3">Изменить R</label>
            <div class="col-sm-5 px-0">
              <select class="form-control" id="choose-resistor">
                <option value="50">50 Ом</option>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  import {bus} from '../bus.js'

  export default {
    name: "scheme",

    data() {
      return {
        schemesUrl: 'http://localhost/frontend/web/scheme/get',
        schemeInfo: null,
        schemeCol: null,
        currentScheme: 1,
        canvas: null,
        context: null
      }
    },

    mounted() {
      this.canvas = document.getElementById('scheme');
      if (this.canvas.getContext) {
        this.context = this.canvas.getContext('2d')
      }
    },

    created() {
      this.$http.get(this.schemesUrl).then(function (response) {
        this.schemeInfo = JSON.parse(response.data)
        this.schemeCol = Object.keys(this.schemeInfo).length
        this.drawScheme(1)
      })
    },

    methods: {
      // резистор
      drawResistor: function (x, y, vertical, name) {
        var width, height;

        if (vertical) {
          width = 20;
          height = 50;
          this.context.fillText(name, x + 15, y + 8)
        } else {
          width = 50;
          height = 20;
          this.context.fillText(name, x - 8, y - 15);
        }

        this.context.clearRect(x - width / 2, y - height / 2, width, height);
        this.context.strokeRect(x - width / 2, y - height / 2, width, height);
      },

      // конденсатор
      drawCapacitor: function (x, y, vertical, name) {
        var width, height;

        if (vertical) {
          width = 50;
          height = 10;
          this.context.fillText(name, x + 28, y + 6);
        } else {
          width = 10;
          height = 50;
          this.context.fillText(name, x - 9, y - 30);
        }

        this.context.clearRect(x - width / 2, y - height / 2, width, height);
        this.context.beginPath();
        if (vertical) {
          this.context.moveTo(x - width / 2, y - height / 2);
          this.context.lineTo(x + width / 2, y - height / 2);
          this.context.moveTo(x - width / 2, y + height / 2);
          this.context.lineTo(x + width / 2, y + height / 2);
        } else {
          this.context.moveTo(x - width / 2, y + height / 2);
          this.context.lineTo(x - width / 2, y - height / 2);
          this.context.moveTo(x + width / 2, y - height / 2);
          this.context.lineTo(x + width / 2, y + height / 2);
        }
        this.context.stroke();
        this.context.closePath();
      },

      // катушка
      drawCoil: function (x, y, vertical, name) {
        var width, height;

        if (vertical) {
          width = 20;
          height = 60;
          this.context.fillText(name, x + 9, y + 7);
        } else {
          width = 60;
          height = 20;
          this.context.fillText(name, x - 9, y - 20);
        }

        this.context.clearRect(x - width / 2, y - height / 2, width, height);
        this.context.beginPath();
        if (vertical) {
          this.context.arc(x, y + width, width / 2, (-1 / 2) * Math.PI, Math.PI / 2, true);
        } else {
          this.context.arc(x - height, y, height / 2, 0, Math.PI, true);
        }
        this.context.stroke();
        this.context.closePath();
        this.context.beginPath();
        if (vertical) {
          this.context.arc(x, y, width / 2, (-1 / 2) * Math.PI, Math.PI / 2, true);
        } else {
          this.context.arc(x, y, height / 2, 0, Math.PI, true);
        }
        this.context.stroke();
        this.context.closePath();
        this.context.beginPath();
        if (vertical) {
          this.context.arc(x, y - width, width / 2, (-1 / 2) * Math.PI, Math.PI / 2, true);
        } else {
          this.context.arc(x + height, y, height / 2, 0, Math.PI, true);
        }
        this.context.stroke();
        this.context.closePath();
      },

      // источник эдс
      drawVoltageSource: function (x, y, vertical, direction, name) {

        this.context.beginPath();
        this.context.arc(x, y, 20, 0, 2 * Math.PI, true);
        this.context.stroke();
        this.context.closePath();
        this.context.beginPath();

        if (vertical) {
          if (direction) {
            this.context.moveTo(x, y - 20);
            this.context.lineTo(x + 5, y - 5);
            this.context.lineTo(x - 5, y - 5);
          } else {
            this.context.moveTo(x, y + 20);
            this.context.lineTo(x + 5, y + 5);
            this.context.lineTo(x - 5, y + 5);
          }
          this.context.fillText(name, x + 25, y + 6);
        } else {
          if (direction) {
            this.context.moveTo(x + 20, y);
            this.context.lineTo(x + 5, y - 5);
            this.context.lineTo(x + 5, y + 5);
          } else {
            this.context.moveTo(x - 20, y);
            this.context.lineTo(x - 5, y - 5);
            this.context.lineTo(x - 5, y + 5);
          }
          this.context.fillText(name, x - 10, y - 25);
        }

        this.context.fill();
        this.context.closePath();
      },

      // источник тока
      drawCurrentSource: function (x, y, vertical, direction, name) {

        this.context.clearRect(x - 20, y - 20, 40, 40);
        this.context.beginPath();
        this.context.arc(x, y, 20, 0, 2 * Math.PI, true);
        this.context.stroke();
        this.context.closePath();
        this.context.beginPath();

        if (vertical) {
          if (direction) {
            this.context.moveTo(x, y - 20);
            this.context.lineTo(x, y - 10);
            this.context.moveTo(x, y + 20);
            this.context.lineTo(x, y);
            this.context.moveTo(x - 10, y);
            this.context.lineTo(x, y - 10);
            this.context.lineTo(x + 10, y);
            this.context.moveTo(x - 10, y + 10);
            this.context.lineTo(x, y);
            this.context.lineTo(x + 10, y + 10);
          } else {
            this.context.moveTo(x, y - 20);
            this.context.lineTo(x, y);
            this.context.moveTo(x, y + 10);
            this.context.lineTo(x, y + 20);
            this.context.moveTo(x - 10, y - 10);
            this.context.lineTo(x, y);
            this.context.lineTo(x + 10, y - 10);
            this.context.moveTo(x - 10, y);
            this.context.lineTo(x, y + 10);
            this.context.lineTo(x + 10, y);
          }
          this.context.fillText(name, x + 25, y + 6);
        } else {
          if (direction) {
            this.context.moveTo(x + 20, y);
            this.context.lineTo(x + 10, y);
            this.context.moveTo(x - 20, y);
            this.context.lineTo(x, y);
            this.context.moveTo(x, y - 10);
            this.context.lineTo(x + 10, y);
            this.context.lineTo(x, y + 10);
            this.context.moveTo(x - 10, y - 10);
            this.context.lineTo(x, y);
            this.context.lineTo(x - 10, y + 10);
          } else {
            this.context.moveTo(x + 20, y);
            this.context.lineTo(x, y);
            this.context.moveTo(x - 20, y);
            this.context.lineTo(x - 10, y);
            this.context.moveTo(x, y - 10);
            this.context.lineTo(x - 10, y);
            this.context.lineTo(x, y + 10);
            this.context.moveTo(x + 10, y - 10);
            this.context.lineTo(x, y);
            this.context.lineTo(x + 10, y + 10);
          }
          this.context.fillText(name, x - 10, y - 25);
        }

        this.context.stroke();
        this.context.closePath();
      },

      drawScheme: function () {
        var num = this.currentScheme
        var name, i

        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height)
        this.context.strokeStyle = 'black';
        this.context.beginPath();
        for (name in this.schemeInfo[num]['circuits']) {
          this.context.moveTo(
            this.schemeInfo[num]['circuits'][name]['start']['x'],
            this.schemeInfo[num]['circuits'][name]['start']['y']
          )
          for (i in this.schemeInfo[num]['circuits'][name]['points']) {
            this.context.lineTo(
              this.schemeInfo[num]['circuits'][name]['points'][i]['x'],
              this.schemeInfo[num]['circuits'][name]['points'][i]['y']
            )
          }
        }
        this.context.stroke();
        this.context.closePath();

        this.context.font = 'bold 16px sans-serif';
        for (i in this.schemeInfo[num]['texts']) {
          this.context.fillText(
            this.schemeInfo[num]['texts'][i]['text'],
            this.schemeInfo[num]['texts'][i]['x'],
            this.schemeInfo[num]['texts'][i]['y'],
          )
        }

        for (name in this.schemeInfo[num]['resistor']) {
          this.drawResistor(
            this.schemeInfo[num]['resistor'][name]['x'],
            this.schemeInfo[num]['resistor'][name]['y'],
            this.schemeInfo[num]['resistor'][name]['vertical'],
            name
          )
        }
        for (name in this.schemeInfo[num]['capacitor']) {
          this.drawCapacitor(
            this.schemeInfo[num]['capacitor'][name]['x'],
            this.schemeInfo[num]['capacitor'][name]['y'],
            this.schemeInfo[num]['capacitor'][name]['vertical'],
            name
          )
        }
        for (name in this.schemeInfo[num]['coil']) {
          this.drawCoil(
            this.schemeInfo[num]['coil'][name]['x'],
            this.schemeInfo[num]['coil'][name]['y'],
            this.schemeInfo[num]['coil'][name]['vertical'],
            name
          )
        }
        for (name in this.schemeInfo[num]['source']) {
          this.drawVoltageSource(
            this.schemeInfo[num]['source'][name]['x'],
            this.schemeInfo[num]['source'][name]['y'],
            this.schemeInfo[num]['source'][name]['direction'],
            this.schemeInfo[num]['source'][name]['vertical'],
            name
          )
        }

        bus.$emit('print-scheme-data', this.schemeInfo[num]['data'])
      }
    }
  }
</script>

<style scoped>
  .panel {
    height: 100%;
  }
</style>
