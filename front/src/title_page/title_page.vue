<template>
    <div class="container-fluid to-print title-page" style="display: none">
        <div class="row">
            <p class="col text-center">
                Национальный исследовательский университет «МЭИ»<br>
                Институт автоматики и вычислительной техники
            </p>
        </div>
        <hr>
        <div class="row">
            <h5 class="col text-center">
                Кафедра вычислительных машин, систем и сетей
            </h5>
        </div>
        <div class="middle-space"></div>
        <div class="row">
            <h3 class="col text-center">
                Лабораторная работа № {{info.number}}.
            </h3>
        </div>
        <div class="row">
            <p class="col text-center">{{info.name}}</p>
        </div>
        <div class="big-space"></div>
        <div class="row">
            <div class="col-4 offset-8">
                <p>
                    <b>Выполнил:</b>&nbsp;&nbsp;{{info.studentName}}<br>
                    <b>Группа:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{info.studentGroup}}<br>
                    <b>Вариант:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;№{{info.studentVariant}}<br>
                </p>
                <div class="min-space"></div>
                <p>
                    <b>Проверил:</b>&nbsp;&nbsp;{{info.teacherName}}<br>
                    <b>Дата:</b><br>
                    <b>Подпись:</b><br>
                </p>
            </div>
        </div>
        <div class="row title-footer">
            <p class="col">
                Москва, {{info.year}}
            </p>
        </div>
    </div>
</template>

<script>
  export default {
    name: "title-page",

    data() {
      return {
        url: '/api/title-info/',
        info: {
          number: 1,
          name: '',
          studentName: '',
          studentGroup: '',
          studentVariant: 1,
          teacherName: '',
          year: ''
        }
      }
    },

    created: function () {
      this.$http.get(this.url).then(function (response) {
        this.info = response.data;
      });
    }
  }
</script>

<style scoped>
    .title-page {
        position: relative;
        width: 21cm;
        height: 27.5cm;
    }

    .title-page .min-space {
        height: 1cm;
    }

    .title-page .middle-space {
        height: 6cm;
    }

    .title-page .big-space {
        height: 7cm;
    }

    .title-page .title-footer {
        position: absolute;
        bottom: 0;
        left: 47%;
        align-items: center;
    }
</style>
