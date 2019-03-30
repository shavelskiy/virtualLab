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
        <td class="input">
          <input type="text" class="form-control value-input" v-model="volts[0]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="volts[1]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="volts[2]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="volts[3]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="volts[4]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="volts[5]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="volts[6]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="volts[7]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="volts[8]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="volts[9]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="volts[10]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="volts[11]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="volts[12]">
        </td>
      </tr>
      <tr>
        <td>I, мА</td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="ampers[0]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="ampers[1]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="ampers[2]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="ampers[3]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="ampers[4]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="ampers[5]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="ampers[6]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="ampers[7]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="ampers[8]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="ampers[9]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="ampers[10]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="ampers[11]">
        </td>
        <td class="input">
          <input type="text" class="form-control value-input" v-model="ampers[12]">
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { bus } from "../bus.js";

export default {
  name: "graphTable",

  data() {
    return {
      volts: [
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null
      ],
      ampers: [
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null
      ],
      errorCount: false,
      errorType: false
    };
  },

  methods: {
    sendData: function() {
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

<style>
.value-input {
  width: 100%;
  height: 100%;
}

.input {
  height: 0px;
  padding: 2px !important;
}
</style>
