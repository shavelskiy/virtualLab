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
              Это генератор
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
  name: "generator",

  data() {
    return {

    };
  },

  methods: {

  },

  mounted() {

  }
};
</script>

<style scoped>
</style>
