<template>
    <div class="preloader" style="display: none">
        <div class="text">
            <div v-if="finish">
                <div v-if="error">
                    <p>{{error}}</p><br>
                </div>
                <div v-else>
                    <h2>Лабораторная работа выполнена!</h2>
                    <a :href="data.file_path" target="_blank">Посмотреть отчет</a><br>
                    <b>Дата выполнения:</b>&nbsp;{{data.date}}<br>
                    <b>Количество попыток:</b>&nbsp;{{data.attempt}}<br>
                </div>
                <a href="/">Вернуться</a>
            </div>
            <div v-else>
                <p>Выполняется формирование отчета.<br>Пожалуйста подождите ...</p>
            </div>
        </div>
    </div>
</template>

<script>
  import {bus} from "../bus.js";

  export default {
    name: "preloader",

    data() {
      return {
        finish: false,
        error: null,
        data: {
          date: null,
          file_path: null,
          attempt: null
        }
      }
    },

    methods: {
      show: function () {
        window.document.querySelector('.preloader').setAttribute('style', 'display: flex');
      },

      labSuccess: function (data) {
        this.finish = true;
        if (data.error) {
          this.error = data.error;
        } else {
          this.data = data;
        }
      }
    },

    mounted() {
      bus.$on("show-preloader", this.show);
      bus.$on('lab-success', this.labSuccess);
    },
  }
</script>

<style scoped>
    .preloader {
        width: 100vw;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        z-index: 999;
        background: #9fcdff;
        justify-content: center;
        align-items: center;
        will-change: transform;
    }

    .preloader .text {
        font-size: 24px;
    }
</style>