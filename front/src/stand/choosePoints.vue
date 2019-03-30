<template>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4>Выберете сигналы</h4>
    </div>
    <div class="panel-body p-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <label>Канал 1</label>
        </div>
        <div class="panel-body p-0">
          <div class="container-fluid p-0">
            <div class="row p-0 m-0">
              <div class="col m-0 pl-2 pr-1 pt-2 pb-2">
                <select class="form-control" v-model="channel1.point1" v-on:change="sendPoints">
                  <option v-for="item in data" :value="item.id" :key="item.id">{{ item.text }}</option>
                </select>
              </div>
              <div class="col m-0 pl-1 pr-2 pt-2 pb-2">
                <select class="form-control" v-model="channel1.point2" v-on:change="sendPoints">
                  <option v-for="item in data" :value="item.id" :key="item.id">{{ item.text }}</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="isTwoChannels" class="panel panel-default">
        <div class="panel-heading">
          <label>Канал 2</label>
        </div>
        <div class="panel-body p-0">
          <div class="container-fluid p-0">
            <div class="row p-0 m-0">
              <div class="col m-0 pl-2 pr-1 pt-2 pb-2">
                <select class="form-control" v-model="channel2.point1" v-on:change="sendPoints">
                  <option v-for="item in data" :value="item.id" :key="item.id">{{ item.text }}</option>
                </select>
              </div>
              <div class="col m-0 pl-1 pr-2 pt-2 pb-2">
                <select class="form-control" v-model="channel2.point2" v-on:change="sendPoints">
                  <option v-for="item in data" :value="item.id" :key="item.id">{{ item.text }}</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { bus } from "../bus.js";

export default {
  name: "choosePoints",

  data() {
    return {
      isTwoChannels: null,
      data: null,
      channel1: {
        point1: null,
        point2: null
      },
      channel2: {
        point1: null,
        point2: null
      }
    };
  },

  methods: {
    acceptData: function(data) {
      this.data = data;
    },

    acceptSignal: function(data) {
      if (data === "linear") {
        this.isTwoChannels = false;
      }
    },

    sendPoints: function() {
      if (this.isTwoChannels) {
        bus.$emit("print-signal", this.channel1, this.channel2);
      } else {
        bus.$emit("print-signal", this.channel1);
      }
    }
  },

  mounted() {
    bus.$on("print-choose-points", this.acceptData);
    bus.$on("signal-view", this.acceptSignal);
  }
};
</script>

<style scoped>
</style>
