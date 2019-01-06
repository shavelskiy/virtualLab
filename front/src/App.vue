<template>
  <div>
    <task></task>
    <gdm></gdm>
    <oscilloscope></oscilloscope>
    <stand></stand>
  </div>
</template>

<script>
  import oscilloscope from './oscilloscope/oscilloscope.vue'
  import gdm from './gdm/gdm.vue'
  import task from './task/task.vue'
  import stand from './stand/stand.vue'

  export default {
    name: "App",

    components: {
      'Task': task,
      'Oscilloscope': oscilloscope,
      'Gdm': gdm,
      'Stand': stand
    }
  }
</script>

<style scoped>

</style>
