<template>
  <div>
    <div v-for="task in tasks">
      <div class="container mb-5" v-show="task.num == page">
        <h3 v-html="task.num + '. ' + task.name"></h3>
        <ul>
          <li class="mt-5" v-for="data in task.children">
            <p v-html="'<b>' + task.num + '.' + data.num + '</b>&nbsp;&nbsp;' + data.name"></p>
            <div v-html="data.content"></div>
            <component :is="data.component"></component>
          </li>
        </ul>
        <hr>
        <div class="col text-center">
          <button class="btn btn-primary" @click="changePage(Number(task.num) - 1)" v-if="Number(task.num) != 1">
            Назад
          </button>
          <button class="btn btn-primary" @click="changePage(Number(task.num) + 1)"
                  v-if="Number(task.num) != maxPage">Далее
          </button>
          <button class="btn btn-primary" v-if="Number(task.num) == maxPage">Закончить</button>
        </div>
        <hr>
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
        description: '/frontend/web/lab/description/',
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
      maxPage: function () {
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
</style>
