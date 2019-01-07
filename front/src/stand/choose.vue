<template>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4>Выберете сигналы</h4>
    </div>
    <div class="panel-body p-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <label>Канал 1</label>
        </div>
        <div class="panel-body p-0">
          <div class="container-fluid p-0">
            <div class="row p-0 m-0" >
              <div class="col m-0 pl-2 pr-1 pt-2 pb-2">
                <select class="form-control"></select>
              </div>
              <div class="col m-0 pl-1 pr-2 pt-2 pb-2">
                <select class="form-control"></select>
              </div>
            </div>
            <div class="row p-0 m-0">
              <div class="col p-2 text-center">
                <button type="button" class="btn btn-default">
                  Построить
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <label>Канал 2</label>
        </div>
        <div class="panel-body p-0">
          <div class="container-fluid p-0">
            <div class="row p-0 m-0">
              <div class="col m-0 pl-2 pr-1 pt-2 pb-2">
                <select class="form-control"></select>
              </div>
              <div class="col m-0 pl-1 pr-2 pt-2 pb-2">
                <select class="form-control"></select>
              </div>
            </div>
            <div class="row p-0 m-0">
              <div class="col p-2 text-center">
                <button type="button" class="btn btn-default">
                  Построить
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "choose"
  }
</script>

<style scoped>

</style>
