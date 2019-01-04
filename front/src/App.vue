<template>
  <div class="container-fluid">
    <task></task>
    <div class="row">
      <gdm></gdm>
      <oscilloscope></oscilloscope>
    </div>
  </div>
</template>

<script>
  import oscilloscope from './oscilloscope/oscilloscope.vue'
  import gdm from './gdm/gdm.vue'
  import task from './task/task.vue'

  export default {
    name: "App",

    components: {
      'Task': task,
      'Oscilloscope': oscilloscope,
      'Gdm': gdm
    }
  }
</script>

<style scoped>

</style>
