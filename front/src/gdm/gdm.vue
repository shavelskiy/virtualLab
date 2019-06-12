<template>
  <div class="panel panel-default">
    <div class="panel-body pb-0">
      <form class="form-horizontal">
        <div class="form-row">
          <div class="form-group col-3">
            <input
              v-if="active"
              type="text"
              class="form-control col-8 ml-4"
              disabled
              v-model="data"
            >
            <input v-else type="text" class="form-control col-8 ml-4" disabled>
          </div>
          <div class="form-group col-6">
            <label class="radio-inline">
              <input type="radio" v-model="mode" class="gdm-mode" value="u" name="mode" checked>V
            </label>
            <label class="radio-inline">
              <input type="radio" v-model="mode" class="gdm-mode" value="i" name="mode">mA
            </label>
            <label class="radio-inline">
              <input type="radio" v-model="mode" class="gdm-mode" value="r" name="mode">kΩ
            </label>
          </div>
          <div class="col-3 pt-2">
            <label class="form-check-label" for="active">Pwr</label>
            <input v-model="active" class="form-check-input ml-4" type="checkbox" id="active">
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { bus } from "../bus.js";

export default {
  name: "gdm",

  data() {
    return {
      mode: "u",
      active: false,
      values: null,
      point1: null,
      point2: null,
      curValues: {
        cur_u: 0,
        cur_i: 0,
        cur_r: 0
      },
      changeableData: {
        r: 50,
        c: 10
      }
    };
  },

  methods: {
    evalSingal: function() {
      var tmp = false;
      var k = 1;

      var R = Number(this.changeableData.r),
        C = Number(this.changeableData.c);

      if (this.values[this.point1 + "." + this.point2]) {
        tmp = this.values[this.point1 + "." + this.point2];
      } else if (this.values[this.point2 + "." + this.point1]) {
        k = -1;
        tmp = this.values[this.point2 + "." + this.point1];
      }


      this.curValues["cur_u"] = tmp
        ? (k * Math.round(eval(tmp["cur_u"])))
        : 0;
      this.curValues["cur_i"] = tmp
        ? (k * Math.round(eval(tmp["cur_i"])))
        : 0;
      this.curValues["cur_r"] = tmp ? (Math.round(eval(tmp["cur_r"]))) : 0;
    },

    acceptPoints: function(data) {
      this.point1 = data.point1;
      this.point2 = data.point2;
      this.evalSingal();
    },

    loadValues: function(data) {
      this.values = data;
      this.point1 = null;
      this.point2 = null;
      this.evalSingal();
    },

    acceptChangeableData: function(data) {
      this.changeableData = data;
      this.evalSingal();
    }
  },

  computed: {
    data: function() {
      switch (this.mode) {
        case "u":
          return this.curValues["cur_u"];
        case "i":
          return this.curValues["cur_i"];
        case "r":
          return this.curValues["cur_r"];
      }
    }
  },

  mounted() {
    bus.$on("load-values", this.loadValues);
    bus.$on("print-signal", this.acceptPoints);
    bus.$on("send-changeable-data", this.acceptChangeableData);
  }
};
</script>

<style scoped>
</style>
