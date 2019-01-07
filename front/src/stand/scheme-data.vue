<template>
  <div class="panel panel-default">
    <div class="panel-body">
      <p class="text-center" v-for="(key, item) in data" >{{ item }} = {{ key }}</p>
    </div>
  </div>
</template>

<script>
  import {bus} from '../bus.js'

  export default {
    name: "scheme-data",

    data() {
      return {
        data: null
      }
    },

    methods: {
      acceptData: function(data) {
        this.data = data
      }
    },

    mounted() {
      bus.$on('print-scheme-data', this.acceptData)
    }
  }
</script>

<style scoped>

</style>
