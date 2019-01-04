<template>
  <div class="col-10 offset-1 mt-5">
    <div class="card">
      <div class="card-body pb-0">
        <form class="form-horizontal">
          <div class="form-row">
            <div class="form-group col-3">
              <input v-if="active" type="text" class="form-control col-8 ml-4" disabled v-model="data">
              <input v-else type="text" class="form-control col-8 ml-4" disabled>
            </div>
            <div class="form-group col-6">
              <label class="radio-inline"><input type="radio" v-model="mode" class="gdm-mode" value="v" name="mode" checked>V</label>
              <label class="radio-inline"><input type="radio" v-model="mode" class="gdm-mode" value="a" name="mode">mA</label>
              <label class="radio-inline"><input type="radio" v-model="mode" class="gdm-mode" value="o" name="mode">kΩ</label>
            </div>
            <div class="col-3 pt-2">
              <label class="form-check-label" for="active">Pwr</label>
              <input v-model="active" class="form-check-input ml-4" type="checkbox" id="active">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "gdm",

    data() {
      return {
        data: 0,
        mode: 'v',
        active: false
      }
    },

    methods: {
      init: function () {

      }
    }
  }
</script>

<style scoped>

</style>
