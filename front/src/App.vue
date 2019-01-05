<template>
  <div>
    <task></task>
    <gdm></gdm>
    <oscilloscope></oscilloscope>
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
