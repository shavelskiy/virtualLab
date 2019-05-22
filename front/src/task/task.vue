<template>
  <div id="task">
    <div v-for="task in tasks" :key="task.id">
      <div class="container mb-5 to-print" v-show="task.num === page">
        <h3 v-html="task.num + '. ' + task.name"></h3>
        <ul>
          <li v-for="data in task.children" :key="data.id" class="mt-5 task-item">
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
            v-if="Number(task.num) !== 1"
          >Назад</button>
          <button
            class="btn btn-primary"
            @click="changePage(Number(task.num) + 1)"
            v-if="Number(task.num) !== maxPage"
          >Далее</button>
          <button class="btn btn-primary" v-if="Number(task.num) === maxPage" v-on:click="finishLab">Закончить</button>
        </div>
        <hr>
      </div>
    </div>
  </div>
</template>

<script>
  import html2pdf from 'html2pdf.js';
  import graphTable from "../lab_components/table_1.vue";
  import graph from "../lab_components/graph_1.vue";
  import transfer_functions from "../lab_components/transfer_functions_5_6";
  import {bus} from "../bus.js";

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
        tasks: null,
        titlePdfOpt: {
          margin: 10,
          filename: 'title.pdf',
        },
        taskPdfOpt: {
          margin: 10,
          filename: 'lab.pdf',
          html2canvas: {width: 1200},
        }
      };
    },

    methods: {
      changePage: function (page) {
        this.page = page;
        $("body, html").animate({scrollTop: 0}, 200);
        bus.$emit("home-training", page === 1);
      },

      finishLab: function () {
        let titleHtml = window.document.querySelector('.title-page');

        titleHtml.setAttribute('style', 'display: block');

        let taskHtml = window.document.querySelector('#task');

        taskHtml.querySelectorAll('.to-print').forEach(function (curElement) {
          curElement.setAttribute('style', 'display: block');
        });

        taskHtml.querySelectorAll('.no-print').forEach(function (curElement) {
          curElement.setAttribute('style', 'display: none');
        });

        let titlePdf = html2pdf().set(this.titlePdfOpt).from(titleHtml);
        let taskPdf = html2pdf().set(this.taskPdfOpt).from(taskHtml);

        titlePdf.save();
        taskPdf.save();


        // html2pdf().set(opt).from(element).outputPdf().then(function(pdf) {
          // выведет в консоль base64
          // console.log(btoa(pdf));
        // });
      }
    },

    computed: {
      maxPage: function () {
        return Object.keys(this.tasks).length;
      }
    },

    created: function () {
      this.$http.get(this.description).then(function (response) {
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
