<template>
  <div class="panel panel-default">
    <div class="panel-body p-4">
      <div class="row">

        <!--<div class="col-2">-->
        <!--<div class="panel panel-default">-->
        <!--<div class="panel-body">-->
        <!--<canvas id="data" width="180" height="400"></canvas>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->

        <div class="col-7 px-0">
          <scheme></scheme>
        </div>

        <!--<div class="col-3">-->
        <!--<div class="panel panel-default">-->
        <!--<div class="panel-heading">-->
        <!--<h4>Выберете сигналы</h4>-->
        <!--</div>-->
        <!--<div class="panel-body p-3" id="choose">-->
        <!--<div class="panel panel-default">-->
        <!--<div class="panel-heading">-->
        <!--<label>Канал 1</label>-->
        <!--</div>-->
        <!--<div class="panel-body p-0">-->
        <!--<div class="container-fluid p-0">-->
        <!--<div class="row p-0 m-0" id="points">-->
        <!--<div class="col m-0 pl-2 pr-1 pt-2 pb-2">-->
        <!--<select class="form-control" channel="1"></select>-->
        <!--</div>-->
        <!--<div class="col m-0 pl-1 pr-2 pt-2 pb-2">-->
        <!--<select class="form-control" channel="1"></select>-->
        <!--</div>-->
        <!--</div>-->
        <!--<div class="row p-0 m-0">-->
        <!--<div class="col p-2 text-center">-->
        <!--<button type="button" class="btn btn-default"-->
        <!--id="draw_osci" channel="1">-->
        <!--Построить-->
        <!--</button>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--<div class="panel panel-default">-->
        <!--<div class="panel-heading">-->
        <!--<label>Канал 2</label>-->
        <!--</div>-->
        <!--<div class="panel-body p-0">-->
        <!--<div class="container-fluid p-0">-->
        <!--<div class="row p-0 m-0" id="points">-->
        <!--<div class="col m-0 pl-2 pr-1 pt-2 pb-2">-->
        <!--<select class="form-control" channel="2"></select>-->
        <!--</div>-->
        <!--<div class="col m-0 pl-1 pr-2 pt-2 pb-2">-->
        <!--<select class="form-control" channel="2"></select>-->
        <!--</div>-->
        <!--</div>-->
        <!--<div class="row p-0 m-0">-->
        <!--<div class="col p-2 text-center">-->
        <!--<button type="button" class="btn btn-default"-->
        <!--id="draw_osci" channel="2">-->
        <!--Построить-->
        <!--</button>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->
        <!--</div>-->

      </div>
    </div>
  </div>
</template>

<script>
  import scheme from './scheme.vue'

  export default {
    name: "stand",

    components: {
      'Scheme': scheme
    },

    data() {
      return {
        schemesUrl: 'http://localhost/frontend/web/scheme/get'
      }
    },

    created: function () {
      this.$http.get(this.schemesUrl).then(function (response) {

        this.tasks = JSON.parse(response.data)
      })
    },
  }
</script>

<style scoped>
  .panel {
    height: 100%;
  }
</style>
