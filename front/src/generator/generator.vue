<template>
  <div class="panel panel-default">
    <div class="panel-body pb-0">
      <div class="form-horizontal">
        <div class="row">
          <div class="col-3 offset-1">
            <input type="text" class="form-control" v-model="data.amplitude">
            <input type="text" class="form-control my-3" v-model="data.freq">
          </div>
          <button type="button" class="btn btn-primary" @click="sendData">Ввод</button>
        </div>
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
        amplitude: 0,
        freq: 0
      }
    };
  },

  methods: {
    sendData: function() {
      bus.$emit('send-generator-params', this.data)
    }
  },

  mounted() {

  }
};
</script>

<style scoped>
</style>
