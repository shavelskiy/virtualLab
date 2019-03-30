<template>
  <div class="panel panel-default">
    <div class="panel-body p-4">
      <div class="row">
        <div class="col-2">
          <scheme-data></scheme-data>
        </div>
        <div class="col-7 px-0">
          <scheme></scheme>
        </div>
        <div class="col-3">
          <choose></choose>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import scheme from "./scheme.vue";
import schemeData from "./scheme-data.vue";
import choosePoints from "./choosePoints.vue";

export default {
  name: "stand",

  components: {
    Scheme: scheme,
    SchemeData: schemeData,
    Choose: choosePoints
  }
};
</script>

<style scoped>
.panel {
  height: 100%;
}
</style>
