var canvas;
var ctx;

var width = 700;
var height = 400;
var gridSpacingMain = 100;
var gridSpacingSecond = 20;

var amplitude = 5;
var freq = 2000;
var phase = 0;

var voltDiv = 5; // сколько вольт в одной клетке
var timeDiv = 1; // сколько милисекунд в одной клетке
var offsetX = 0;
var offsetY = 0;

function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    drawMainGrid();

    ctx.strokeStyle = 'rgb(134, 222, 200)';
    ctx.beginPath();
    drawSin();
    ctx.lineWidth = 2;
    ctx.stroke();
    ctx.closePath();

    // внешняя рамка
    ctx.strokeStyle = 'rgb(223, 223, 223)';
    ctx.strokeRect(0, 0, width, height);

    function drawMainGrid() {
        // основной прямоугольник
        ctx.fillStyle = 'rgb(93, 177, 162)';
        ctx.fillRect(0, 0, width, height);

        // вспомогательная сетка
        ctx.strokeStyle = 'rgb(111, 152, 142)';
        ctx.beginPath();
        drawVerticalLines(ctx, gridSpacingSecond);
        drawHorizontalLines(ctx, gridSpacingSecond);
        ctx.stroke();
        ctx.closePath();

        // основная сетка
        ctx.strokeStyle = 'rgb(68, 116, 107)';
        ctx.beginPath();
        drawVerticalLines(ctx, gridSpacingMain);
        drawHorizontalLines(ctx, gridSpacingMain);
        ctx.stroke();
        ctx.closePath();

        function drawVerticalLines(ctx, gridSpacing) {
            var i = gridSpacing;
            while (i < canvas.width) {
                ctx.moveTo(i, 0);
                ctx.lineTo(i, canvas.height);
                i = i + gridSpacing;
            }
        }

        function drawHorizontalLines(ctx, gridSpacing) {
            var i = gridSpacing;
            while (i < canvas.height) {
                ctx.moveTo(0, i);
                ctx.lineTo(canvas.width, i);
                i = i + gridSpacing;
            }
        }
    }

    function drawSin() {
        var step = 0.01;

        var voltK = 100; // коэфициент, благодаря которому вольты корректно соотносятся с пикселями
        var timeK = 0.000005; // коэфициент для времени

        var xStart = offsetX;
        var yStart = canvas.height / 2 - offsetY;

        var xMax = canvas.width - xStart;
        var xMin = xStart;
        var yMax = canvas.height - yStart;
        var yMin = (-1) * yStart;

        ctx.moveTo(xStart + getX(0), yStart + getY(0));
        for (var t = xStart; t < canvas.width / step - xStart; t++) {
            ctx.lineTo(xStart + getX(t), yStart + getY(t));
        }

        function getX(t) {
            return step * t;
        }

        function getY(t) {
            var y = (-1) * amplitude / voltDiv * voltK * Math.sin(2 * Math.PI * freq * t * step * timeK * timeDiv + phase / 180 * Math.PI);
            if (y < yMin) {
                y = yMin;
            }
            if (y > yMax) {
                y = yMax;
            }
            return y;
        }
    }
}

function changeVoltDiv(value) {
    voltDiv = Number(value);
    draw();
}

function changeTimeDiv(value) {
    timeDiv = Number(value);
    draw();
}

function changeOffsetX(value) {
    offsetX = Number(value);
    draw();
}

function changeOffsetY(value) {
    offsetY = Number(value);
    draw();
}

$(document).ready(function () {
    canvas = document.getElementById('canvas');
    if (canvas.getContext) {
        ctx = canvas.getContext('2d');
        draw();
        draw();
    }

    $('#timeDiv').change(function () {
        changeTimeDiv($(this).val());
    });

    $('#voltsDiv').change(function () {
        changeVoltDiv($(this).val());
    });

    $(document).on('input', '#offsetX', function () {
        changeOffsetX($(this).val());
    }).change();

    $(document).on('input', '#offsetY', function () {
        changeOffsetY($(this).val());
    });
});
