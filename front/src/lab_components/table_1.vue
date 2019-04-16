<template>
    <table class="table table-bordered ml-5">
        <thead>
        <tr>
            <td>R, Ом</td>
            <td>50</td>
            <td>100</td>
            <td>150</td>
            <td>200</td>
            <td>250</td>
            <td>300</td>
            <td>400</td>
            <td>500</td>
            <td>600</td>
            <td>700</td>
            <td>800</td>
            <td>900</td>
            <td>∞</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>U, В</td>
            <td class="input" v-for="i in 13">
                <input type="text" class="form-control value-input" v-model="volts[i -1]">
            </td>
        </tr>
        <tr>
            <td>I, мА</td>
            <td class="input" v-for="i in 13">
                <input type="text" class="form-control value-input" v-model="ampers[i - 1]">
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    import {bus} from "../bus.js";

    export default {
        name: "graphTable",

        data() {
            return {
                volts: [],
                ampers: [],
                errorCount: false,
                errorType: false
            };
        },

        methods: {
            sendData: function () {
                this.errorCount = false;
                this.errorType = false;

                for (var i = 0; i <= 12; i++) {
                    if (this.volts[i]) {
                        if (!Number(this.volts[i])) {
                            this.errorType = true;
                        }
                    } else {
                        this.errorCount = true;
                    }

                    if (this.ampers[i]) {
                        if (!Number(this.ampers[i])) {
                            this.errorType = true;
                        }
                    } else {
                        this.errorCount = true;
                    }
                }

                bus.$emit("draw-graph", {
                    data: {
                        volts: this.volts,
                        ampers: this.ampers
                    },
                    errors: {
                        data: this.errorCount,
                        type: this.errorType
                    }
                });
            }
        },

        mounted() {
            bus.$on("get-table-data", this.sendData);
        }
    };
</script>

<style scoped>
</style>
