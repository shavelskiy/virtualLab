<template>
  <div id="task">
    <div class="alert alert-primary" role="alert" v-if="!canFinish">
      Режим просмотра работы. Отсутствует возможность отправить отчет!
    </div>
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
          <button class="btn btn-primary" v-if="(Number(task.num) === maxPage) && canFinish" v-on:click="finishLab">Закончить</button>
        </div>
        <hr>
      </div>
    </div>
  </div>
</template>

<script>
  import html2pdf from 'html2pdf.js';
  import Vue from 'vue';
  import graphTable from "../lab_components/table_1.vue";
  import graph from "../lab_components/graph_1.vue";
  import transfer_function_4 from "../lab_components/transfer_function_4";
  import transfer_function_5 from "../lab_components/transfer_function_5";
  import {bus} from "../bus.js";

  export default {
    name: "task",

    components: {
      graphTable: graphTable,
      graph: graph,
      transfer_function_4: transfer_function_4,
      transfer_function_5: transfer_function_5
    },

    data() {
      return {
        description: "/api/task/",
        page: 1,
        tasks: null,
        canFinish: true,
        titlePdfOpt: {
          margin: [10, 0, 10, 0],
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
        bus.$emit("show-preloader");

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

        titlePdf.outputPdf().then(function (pdf1) {
          taskPdf.outputPdf().then(function (pdf2) {
            let data = {
              titlePdf: btoa(pdf1),
              taskPdf: btoa(pdf2)
            };

            Vue.http.post('/api/lab/result/', data).then((response) => {
              bus.$emit('lab-success', response.data);
            }).catch(e => {
              bus.$emit('lab-success', e.data);
            });
          });
        });
      }
    },

    computed: {
      maxPage: function () {
        return Object.keys(this.tasks).length;
      }
    },

    created: function () {
      this.$http.get(this.description).then(function (response) {
        this.tasks = response.data.task;
        this.canFinish = response.data.can_finish;
      });
    }
  };
</script>

<style scoped>
  ul {
    list-style: none;
  }
</style>
