<template>
  <div>
    <task></task>
    <gdm v-if="signal === 'linear' && !isHomeTraining"></gdm>
    <oscilloscope v-if="needOscilloscope && !isHomeTraining"></oscilloscope>
    <stand v-if="!isHomeTraining"></stand>
  </div>
</template>

<script>
import { bus } from "./bus.js";
import oscilloscope from "./oscilloscope/oscilloscope.vue";
import gdm from "./gdm/gdm.vue";
import task from "./task/task.vue";
import stand from "./stand/stand.vue";

export default {
  name: "App",

  data: function() {
    return {
      signal_url: "/frontend/web/lab/signal/",
      signal: null,
      isHomeTraining: true
    };
  },

  methods: {
    homeTraining: function(isHomeTraining) {
      this.isHomeTraining = isHomeTraining;
    },
    sendSignal: function() {
      bus.$emit("signal-view", this.signal);
    }
  },

  components: {
    Task: task,
    Oscilloscope: oscilloscope,
    Gdm: gdm,
    Stand: stand
  },

  created: function() {
    this.$http.get(this.signal_url).then(function(response) {
      this.signal = JSON.parse(response.data);

      bus.$emit("signal-view", this.signal);
    });

    bus.$on("home-training", this.homeTraining);
    bus.$on("get-signal", this.sendSignal);
  },

  computed: {
    needOscilloscope: function () {
      return this.signal === "sinusoidal" || this.signal === "rectangular"
    }
  }
};
</script>

<style scoped>
</style>
