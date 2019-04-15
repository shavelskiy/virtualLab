<template>
    <div>
        <table class="table table-bordered ml-5">
            <thead>
            <tr>
                <td class="col-md-1 text-center"><b>k * f</b></td>
                <td class="col-md-1 text-center"><b>1</b></td>
                <td class="col-md-1 text-center"><b>0.3 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>0.5 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>0.8 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>1.2 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>1.5 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>1.8 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>2.0 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>2.5 f<sub>0</sub></b></td>
                <td class="col-md-1 text-center"><b>3.0 f<sub>0</sub></b></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="col-md-1 text-center">
                    <b>f, кГц</b>
                </td>
                <td class="input" v-for="i in 11">
                    <input type="text" class="form-control value-input" v-model="freq[i]">
                </td>
            </tr>
            <tr>
                <td class="col-md-1 text-center">
                    <b>U<sub>1</sub>, В</b>
                </td>
                <td class="input" v-for="i in 11">
                    <input type="text" class="form-control value-input">
                </td>
            </tr>
            <tr>
                <td class="col-md-1 text-center">
                    <b>U<sub>2</sub>, В</b>
                </td>
                <td class="input" v-for="i in 11">
                    <input type="text" class="form-control value-input">
                </td>
            </tr>
            <tr>
                <td class="col-md-1 text-center"><b>&Delta;t, мкс</b></td>
                <td class="input" v-for="i in 11">
                    <input type="text" class="form-control value-input">
                </td>
            </tr>
            <tr>
                <td class="col-md-1 text-center">
                    <b>H(f)</b>
                </td>
                <td class="input" v-for="i in 11">
                    <input type="text" class="form-control value-input" v-model="amplitude[i]">
                </td>
            </tr>
            <tr>
                <td class="col-md-1 text-center">
                    <b>&psi;(f)</b>
                </td>
                <td class="input" v-for="i in 11">
                    <input type="text" class="form-control value-input" v-model="phase[i]">
                </td>
            </tr>
            </tbody>
        </table>
        <div class="col-8 ml-5">
            <canvas id="graph" width="700" height="400"></canvas>
        </div>
    </div>
</template>

<script>
    export default {
        name: "transfer_functions",

        data() {
            return {
                freq: [],
                amplitude: [],
                phase: []
            }
        }
    }
</script>

<style scoped>

</style>