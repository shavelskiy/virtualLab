<template>
  <div>
    <div v-for="task in tasks" :key="task.id">
      <div class="container mb-5 to-print" v-show="task.num == page">
        <h3 v-html="task.num + '. ' + task.name"></h3>
        <ul>
          <li v-for="data in task.children" :key="data.id" class="mt-5 task">
            <p v-html="'<b>' + task.num + '.' + data.num + '</b>&nbsp;&nbsp;' + data.name"></p>
            <div v-html="data.content"></div>
            <component :is="data.component"></component>
          </li>
        </ul>
        <hr class="no-print">
        <div class="col text-center no-print">
          <button
            class="btn btn-primary"
            @click="changePage(Number(task.num) - 1)"
            v-if="Number(task.num) != 1"
          >Назад</button>
          <button
            class="btn btn-primary"
            @click="changePage(Number(task.num) + 1)"
            v-if="Number(task.num) != maxPage"
          >Далее</button>
          <button class="btn btn-primary" v-if="Number(task.num) == maxPage" v-on:click="finishLab">Закончить</button>
        </div>
        <hr>
      </div>
    </div>
  </div>
</template>

<script>
import graphTable from "../lab_components/table_1.vue";
import graph from "../lab_components/graph_1.vue";
import transfer_functions from "../lab_components/transfer_functions_5_6";
import { bus } from "../bus.js";

export default {
  name: "task",

  components: {
    graphTable: graphTable,
    graph: graph,
    transfer_functions: transfer_functions
  },

  data() {
    return {
      description: "/frontend/web/lab/task/",
      page: 1,
      tasks: null
    };
  },

  methods: {
    changePage: function(page) {
      this.page = page;
      $("body, html").animate({ scrollTop: 0 }, 200);
      bus.$emit("home-training", page == 1);
    },

    finishLab: function () {
      console.log('kek')
    }
  },

  computed: {
    maxPage: function() {
      return Object.keys(this.tasks).length;
    }
  },

  created: function() {
    this.$http.get(this.description).then(function(response) {
      this.tasks = response.data;
    });
  }
};
</script>

<style scoped>
ul {
  list-style: none;
}
</style>
