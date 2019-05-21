<template>
  <div class="panel panel-default device-color">
    <h3 class="text-center">Генератор</h3>
    <div class="panel-body pb-0">
      <div class="form-inline mb-4">
        <div class="form-group col-md-2">
          <label for="amplitude" class="custom-label">Амплитуда</label>
          <input type="number" max="50" min="0" step="0.5" class="form-control" id="amplitude" v-model="data.amplitude">
          <span class="text-muted">В</span>
        </div>
        <div class="form-group col-md-2">
          <label for="freq" class="custom-label">Частота</label>
          <input type="number" max="20000" min="0" step="100" class="form-control" id="freq" v-model="data.freq">
          <span class="text-muted">Гц</span>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="signal-view" id="sin" :disabled="!isSin" :checked="isSin">
          <label class="form-check-label" for="sin">Синусоидальный сигнал</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="signal-view" id="rec" :disabled="!isRec" :checked="isRec">
          <label class="form-check-label" for="rec">Прямоугольный импульс</label>
        </div>
        <button type="button" class="btn btn-primary mt-4 ml-3" @click="sendData">Подтвердить</button>
      </div>
    </div>
  </div>
</template>

<script>
import { bus } from "../bus.js";

export default {
  name: "generator",

  data() {
    return {
      data: {
        test: true,
        amplitude: 0,
        freq: 0
      },
      signal: '',
    };
  },

  computed: {
    isSin: function () {
      return this.signal === 'sinusoidal';
    },

    isRec: function () {
      return this.signal === 'rectangular';
    }
  },

  methods: {
    // получаем тип сигнала
    acceptSignal: function (signal) {
      this.signal = signal;
    },

    sendData: function() {
      bus.$emit('send-generator-params', this.data)
    }
  },

  mounted() {
    bus.$on("signal-view", this.acceptSignal); // получаем вид сигнала
  }
};
</script>

<style scoped>
  .custom-label {
    justify-content: left;
    padding-left: 6px;
    padding-bottom: 3px;
  }
</style>
