<template>
  <div>
      <preloader></preloader>
      <TitlePage></TitlePage>
      <task></task>
      <gdm v-if="signal === 'linear' && !isHomeTraining"></gdm>
      <oscilloscope v-if="needOscilloscope && !isHomeTraining"></oscilloscope>
      <generator v-if="needOscilloscope && !isHomeTraining"></generator>
      <stand v-if="!isHomeTraining"></stand>
  </div>
</template>

<script>
  import {bus} from "./bus.js";
  import preloader from "./preloader/preloader.vue";
  import oscilloscope from "./oscilloscope/oscilloscope.vue";
  import generator from "./generator/generator.vue";
  import gdm from "./gdm/gdm.vue";
  import title_page from "./title_page/title_page.vue";
  import task from "./task/task.vue";
  import stand from "./stand/stand.vue";

  export default {
    name: "App",

    data: function () {
      return {
        signal_url: "/api/signal/",
        signal: null,
        isHomeTraining: true
      };
    },

    methods: {
      homeTraining: function (isHomeTraining) {
        this.isHomeTraining = isHomeTraining;
      },
      sendSignal: function () {
        bus.$emit("signal-view", this.signal);
      }
    },

    components: {
      preloader: preloader,
      TitlePage: title_page,
      Task: task,
      Oscilloscope: oscilloscope,
      Generator: generator,
      Gdm: gdm,
      Stand: stand
    },

    created: function () {
      this.$http.get(this.signal_url).then(function (response) {
        this.signal = response.data;

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

<style>
  .device-color {
    background-color: #f0f8ff;
  }
</style>
