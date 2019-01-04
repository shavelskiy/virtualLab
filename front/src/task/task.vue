<template>
  <div class="task">
    <div class="container mb-5">
      <div v-for="(task, taskIndex) in tasks">
        <div class="row" v-show="taskIndex == page">
          <h3 v-html="taskIndex + '. ' + task.name"></h3>
          <ul>
            <li class="mt-5" v-for="(data, paragraphIndex) in task.task">
              <p v-html="'<b>' + taskIndex + '.' + paragraphIndex + '</b>&nbsp;&nbsp;' + data.name"></p>
              <div v-html="data.content"></div>
              <component :is="data.component"></component>
            </li>
          </ul>
          <hr>
          <div class="col text-center">
            <button class="btn btn-primary" @click="changePage(Number(taskIndex) - 1)" v-if="Number(taskIndex) != 1">Назад</button>
            <button class="btn btn-primary" @click="changePage(Number(taskIndex) + 1)" v-if="Number(taskIndex) != maxPage">Далее</button>
            <button class="btn btn-primary" v-if="Number(taskIndex) == maxPage">Закончить</button>
          </div>
          <hr>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import graphTable from '../graph/table.vue'
  import graph from '../graph/graph.vue'

  export default {
    name: "task",

    components: {
      'graphTable': graphTable,
      'graph': graph
    },

    data() {
      return {
        description: 'http://localhost/frontend/web/lab/description/',
        page: 1,
        tasks: null
      }
    },

    methods: {
      changePage: function (page) {
        this.page = page
        $('body, html').animate({scrollTop: 0}, 200)
      }
    },

    computed: {
      maxPage: function() {
        return Object.keys(this.tasks).length
      }
    },

    created: function () {
      this.$http.get(this.description).then(function (response) {
        this.tasks = JSON.parse(response.data)
      })
    },
  }
</script>

<style scoped>
  ul {
    list-style: none;
  }

  .value-input {
    width: 100%;
    height: 100%;
  }

  .input {
    height: 0px;
    padding: 2px !important;
  }

  .bottom-align-text {
    position: absolute;
    bottom: 20px;
    right: 0;
  }

  .table-p3-2 {
    width: 58%;
  }
</style>
