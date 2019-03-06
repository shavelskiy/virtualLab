<template>
    <div class="panel panel-default">
        <div class="panel-body pb-0">
            <form class="form-horizontal">
                <div class="form-row">
                    <div class="form-group col-3">
                        <input v-if="active" type="text" class="form-control col-8 ml-4" disabled v-model="data">
                        <input v-else type="text" class="form-control col-8 ml-4" disabled>
                    </div>
                    <div class="form-group col-6">
                        <label class="radio-inline"><input type="radio" v-model="mode" class="gdm-mode" value="u" name="mode" checked>V</label>
                        <label class="radio-inline"><input type="radio" v-model="mode" class="gdm-mode" value="i" name="mode">mA</label>
                        <label class="radio-inline"><input type="radio" v-model="mode" class="gdm-mode" value="r" name="mode">kΩ</label>
                    </div>
                    <div class="col-3 pt-2">
                        <label class="form-check-label" for="active">Pwr</label>
                        <input v-model="active" class="form-check-input ml-4" type="checkbox" id="active">
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import {bus} from '../bus.js'

    export default {
        name: "gdm",

        data() {
            return {
                mode: 'u',
                active: false,
                values: null,
                curValues: {
                    'cur_u': 0,
                    'cur_i': 0,
                    'cur_r': 0
                }
            }
        },

        methods: {
            printSignal(data) {
                var tmp
                var reverse = false

                if (data.point1 === data.point2) {
                    tmp = false
                } else {
                    if (data.point1 < data.point2) {
                        tmp = this.values[data.point1 + '.' + data.point2]
                    } else {
                        reverse = true
                        tmp = this.values[data.point2 + '.' + data.point1]
                    }
                }

                this.curValues['cur_u'] = tmp ? tmp['cur_u'] : 0
                this.curValues['cur_i'] = tmp ? tmp['cur_i'] : 0
                this.curValues['cur_r'] = tmp ? tmp['cur_r'] : 0

                if (reverse) {
                    this.curValues['cur_u'] = (-1) * this.curValues['cur_u']
                    this.curValues['cur_i'] = (-1) * this.curValues['cur_i']

                }
            },

            loadValues(data) {
                this.values = data
            }
        },

        computed: {
            data: function() {
                switch (this.mode) {
                    case 'u':
                        return this.curValues['cur_u']
                    case 'i':
                        return this.curValues['cur_i']
                    case 'r':
                        return this.curValues['cur_r']
                }
            }
        },

        mounted() {
            bus.$on('load-values', this.loadValues)
            bus.$on('print-signal', this.printSignal)
        }
    }
</script>

<style scoped>

</style>
