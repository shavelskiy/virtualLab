<template>
    <div>
        <task></task>
        <gdm v-if="signal == 'linear'"></gdm>
        <oscilloscope v-if="needOsci"></oscilloscope>
        <stand></stand>
    </div>
</template>

<script>
    import {bus} from './bus.js'
    import oscilloscope from './oscilloscope/oscilloscope.vue'
    import gdm from './gdm/gdm.vue'
    import task from './task/task.vue'
    import stand from './stand/stand.vue'

    export default {
        name: "App",

        data: function () {
            return {
                signal_url: '/frontend/web/lab/signal/',
                signal: null
            }
        },

        components: {
            'Task': task,
            'Oscilloscope': oscilloscope,
            'Gdm': gdm,
            'Stand': stand
        },

        created: function () {
            this.$http.get(this.signal_url).then(function (response) {
                this.signal = JSON.parse(response.data)

                bus.$emit('signal-view', this.signal)
            })
        },

        computed: {
            needOsci: function () {
                return ((this.signal === 'sin') || (this.signal === 'rect'))
            }
        }
    }
</script>

<style scoped>

</style>
