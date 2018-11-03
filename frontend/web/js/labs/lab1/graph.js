var graphCanvas;
var graphContext;

var graphError = $('.graph-error'),
    graphErrorType = $('.graph-error-type');

var volts = [],
    ampers = [];

var error = false;

/**
 * Русиуем разметку
 */
function drawGrid() {
    graphContext.clearRect(0, 0, graphCanvas.width, graphCanvas.height);

    // основной прямоугольник
    graphContext.fillStyle = 'rgb(255, 254, 242)';
    graphContext.fillRect(0, 0, graphCanvas.width, graphCanvas.height);

    // основная сетка
    graphContext.strokeStyle = 'rgb(191, 191, 191)';
    graphContext.lineWidth = 2.0;
    graphContext.beginPath();
    drawVerticalLines(graphContext, 50);
    drawHorizontalLines(graphContext, 50);
    graphContext.stroke();
    graphContext.closePath();

    // вспомогательная сетка
    graphContext.strokeStyle = 'rgb(192, 192, 192)';
    graphContext.lineWidth = 1.0;
    graphContext.beginPath();
    drawVerticalLines(graphContext, 10);
    drawHorizontalLines(graphContext, 10);
    graphContext.stroke();
    graphContext.closePath();

    //русуем оси
    graphContext.strokeStyle = 'rgb(0, 0, 0)';
    graphContext.fillStyle = 'rgb(0, 0, 0)';
    graphContext.lineWidth = 2.0;

    graphContext.beginPath();
    graphContext.moveTo(50, graphCanvas.height - 50);
    graphContext.lineTo(graphCanvas.width - 70, graphCanvas.height - 50);
    graphContext.stroke();

    graphContext.moveTo(50, graphCanvas.height - 50);
    graphContext.lineTo(50, 70);
    graphContext.stroke();

    graphContext.moveTo(graphCanvas.width - 50, graphCanvas.height - 50);
    graphContext.lineTo(graphCanvas.width - 70, graphCanvas.height - 55);
    graphContext.lineTo(graphCanvas.width - 70, graphCanvas.height - 45);
    graphContext.fill();

    graphContext.moveTo(50, 50);
    graphContext.lineTo(45, 70);
    graphContext.lineTo(55, 70);
    graphContext.fill();

    var i = 100;
    while (i < graphCanvas.width - 50) {
        graphContext.moveTo(i, graphCanvas.height - 55);
        graphContext.lineTo(i, graphCanvas.height - 45);
        i = i + 50;
    }
    graphContext.stroke();

    var i = 100;
    while (i < graphCanvas.height - 50) {
        graphContext.moveTo(45, i);
        graphContext.lineTo(55, i);
        i = i + 50;
    }
    graphContext.stroke();
    graphContext.closePath();

    // подписываем оси
    graphContext.font = 'bold 16px sans-serif';
    graphContext.fillText('0', 38, graphCanvas.height - 34);
    graphContext.fillText('I, мА', 5, 65);
    graphContext.fillText('U, В', graphCanvas.width - 80, graphCanvas.height - 30);
    graphContext.fillText('5', graphCanvas.width - 150, graphCanvas.height - 28);
    graphContext.fillText('50', 15, 100);

    // внешняя рамка
    graphContext.strokeStyle = 'rgb(0, 0, 0)';
    graphContext.lineWidth = 1.0;
    graphContext.strokeRect(0, 0, graphCanvas.width, graphCanvas.height);

    function drawVerticalLines(graphContext, gridSpacing) {
        var i = gridSpacing;
        while (i < graphCanvas.width) {
            graphContext.moveTo(i, 0);
            graphContext.lineTo(i, graphCanvas.height);
            i = i + gridSpacing;
        }
    }

    function drawHorizontalLines(graphContext, gridSpacing) {
        var i = gridSpacing;
        while (i < graphCanvas.height) {
            graphContext.moveTo(0, i);
            graphContext.lineTo(graphCanvas.width, i);
            i = i + gridSpacing;
        }
    }
}

/**
 * Рисует график по таблице 1.1
 */
function drawGraph() {
    drawGrid();
    graphError.addClass('hidden');
    graphErrorType.addClass('hidden');
    var value;
    error = false;

    for (var i = 0; i < 13; i++) {
        value = $('[volt-id="' + i + '"]').val();
        if (value == '') {
            graphError.removeClass('hidden');
            error = true;
            break;
        }
        if (!Number(value)) {
            if (value != '0') {
                graphErrorType.removeClass('hidden');
                error = true;
                break;
            }
        }
        volts[i] = Number(value);
    }

    for (var i = 0; i < 13; i++) {
        value = $('[amper-id="' + i + '"]').val();
        if (value == '') {
            graphError.removeClass('hidden');
            error = true;
            break;
        }
        if (!Number(value)) {
            if (value != '0') {
                graphErrorType.removeClass('hidden');
                error = true;
                break;
            }
        }
        ampers[i] = Number(value);
    }

    if (!error) {
        graphContext.lineWidth = 2;
        var x0 = 50;
        var y0 = graphCanvas.height - 50;

        graphContext.beginPath();
        graphContext.moveTo(x0 + 100 * (volts[0]), y0 - 5 * ampers[0]);

        for (var i = 1; i < 13; i++) {
            graphContext.lineTo(x0 + 100 * (volts[i]), y0 - 5 * ampers[i]);
        }

        graphContext.stroke();
        graphContext.closePath();
    }
}

$(document).ready(function () {
    graphCanvas = document.getElementById('table-1.1');
    if (graphCanvas.getContext) {
        graphContext = graphCanvas.getContext('2d');
        drawGrid();
    }

    $('.draw-graph').click(function () {
        drawGraph();
    });
});
