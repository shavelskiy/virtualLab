function getV() {
    if (point1 == point2) {
        return 0;
    }
    pot = potentials['1'];
    return pot[point2] - pot[point1];
}

function getA() {
    return 'a';
}

function getO() {
    return 'o';
}

function calculatePotencials() {
    var curElems = elements['1'];
    var value = curElems.E * curElems.R / (curElems.R + curElems.R1);
    potentials['1']['1'] = Math.round(value * 1000) / 1000;
}

$(document).ready(function () {

    var task1 = $('.task-1'),
        task2 = $('.task-2'),
        task3 = $('.task-3');

    var prevToTask1 = $('.prev-to-task-1'),
        nextToTask2 = $('.next-to-task-2'),
        prevToTask2 = $('.prev-to-task-2'),
        nextToTask3 = $('.next-to-task-3');

    prevToTask1.click(function () {
        task2.addClass('hidden');
        task1.removeClass('hidden');
    });

    nextToTask2.click(function () {
        task1.addClass('hidden');
        task2.removeClass('hidden');
        $('body, html').animate({scrollTop: 0}, 200);
    });

    prevToTask2.click(function () {
        task3.addClass('hidden');
        task2.removeClass('hidden');
    });

    nextToTask3.click(function () {
        task2.addClass('hidden');
        task3.removeClass('hidden');
        $('body, html').animate({scrollTop: 0}, 200);
    });

    $('.choose-resistor').change(function () {
        elements["1"].R = $(this).val();
    });
});
