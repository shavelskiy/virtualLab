<template>
  <div class="panel panel-default">
    <div class="panel-heading">
      <label :for="'active-' + id">Канал {{id}}</label>
      <input
        type="checkbox"
        @change="changeSettings"
        v-model="settings.active"
        :id="'active-' + id"
      >
    </div>
    <div class="panel-body">
      <label :for="'timeDiv-' + id">Время на деление:</label>
      <select
        class="form-control"
        @change="changeSettings"
        v-model.number="settings.timeDiv"
        :id="'timeDiv-' + id"
      >
        <option value="0.05">50 us</option>
        <option value="0.1">100 us</option>
        <option value="0.2">200 us</option>
        <option value="0.5">500 us</option>
        <option value="1" selected>1 ms</option>
        <option value="2">2 ms</option>
        <option value="5">5 ms</option>
      </select>

      <label :for="'voltsDiv-' + id">Вольт на деление:</label>
      <select
        class="form-control"
        @change="changeSettings"
        v-model.number="settings.voltDiv"
        :id="'voltsDiv-' + id"
      >
        <option value="1">1 V</option>
        <option value="2">2 V</option>
        <option value="5" selected>5 V</option>
        <option value="10">10 V</option>
        <option value="25">25 V</option>
      </select>

      <label :for="'offsetX-' + id">Сдвиг по горизонтали</label>
      <input
        type="range"
        @input="changeSettings"
        v-model.number="settings.offsetX"
        :id="'offsetX-' + id"
        min="-500"
        max="500"
      >

      <label :for="'offsetY-' + id">Сдвиг по вертикали</label>
      <input
        type="range"
        @input="changeSettings"
        v-model.number="settings.offsetY"
        :id="'offsetY-' + id"
        min="-300"
        max="300"
      >
    </div>
  </div>
</template>

<script>

  import {bus} from "../bus.js";

  export default {
    name: "settings",

    data() {
      return {
        settings: {
          active: true,
          voltDiv: 5,
          timeDiv: 1,
          offsetX: 0,
          offsetY: 0
        }
      };
    },

    props: {
      id: null
    },

    methods: {
      changeSettings: function () {
        bus.$emit("change-settings", {id: this.id, settings: this.settings});
      }
    }
  };
</script>

<style scoped>
</style>
