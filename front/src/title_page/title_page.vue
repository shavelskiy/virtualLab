<template>
    <div class="container-fluid to-print title-page">
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
        <div class="space"></div>
        <div class="row">
            <h3 class="col text-center">
                Лабораторная работа № 1.
            </h3>
        </div>
        <div class="row">
            <p class="col text-center">
                Создание параллельной программы с использованием интерфейса MPI и проведение экспериментов с ней на
                вычислительной системе.
            </p>
        </div>
        <div class="space"></div>
        <div class="row">
            <p class="col-4 offset-8">
                <b>Выполнил:</b>&nbsp;&nbsp;Шавельский В.А.<br>
                <b>Группа:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;А-08-15<br>
                <b>Вариант:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;№19<br>
            </p>
        </div>
        <div class="row title-footer">
            <p class="col text-center">
                Москва, 2019
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "title-page"
    }
</script>

<style scoped>
    .title-page {
        position: relative;
        width: 21cm;
        height: 47cm;

    }

    .title-page .space {
        height: 6cm;
    }

    .title-page .title-footer {
        position: absolute;
        bottom: 5%;
        left: 50%;
        align-items: center;
    }
</style>
