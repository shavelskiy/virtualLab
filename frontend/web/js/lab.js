var canvas;
var ctx;

var width = 700;
var height = 400;
var border = 2;
var gridSpacingMain = 100;
var gridSpacingSecond = 20;

var amplitude = 5;
var freq = 10;
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

    function drawMainGrid() {
        // основной прямоугольник
        ctx.fillStyle = 'rgb(93, 177, 162)';
        ctx.fillRect(border, border, width, height);

        // внешняя рамка
        ctx.strokeStyle = 'rgb(223, 223, 223)';
        ctx.strokeRect(1, 1, width + border, height + border);

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
            var i = gridSpacing + border;
            while (i < width + border) {
                ctx.moveTo(i, border);
                ctx.lineTo(i, height + border);
                i = i + gridSpacing;
            }
        }

        function drawHorizontalLines(ctx, gridSpacing) {
            var i = gridSpacing + border;
            while (i < height + border) {
                ctx.moveTo(border, i);
                ctx.lineTo(width + border, i);
                i = i + gridSpacing;
            }
        }
    }

    function drawSin() {
        var step = 0.01;

        var x = getX(0);
        var y = getY(0);
        var skip = false;
        var k = 100; // коэфициент, благодаря которому вольты корректно соотносятся с пикселями

        var xStart = border + offsetX;
        var yStart = height / 2 - offsetY + border;

        var xMax = width - xStart + border / 2;
        var xMin = border + 1 - xStart;
        var yMax = height - yStart + border / 2;
        var yMin = border + 1 - yStart;

        ctx.moveTo(xStart + x, yStart + y);
        for (var t = 1; t < width / step; t++) {
            x = getX(t);
            y = getY(t);

            if ((y == false) || (x == false)) {
                skip = true;
            } else {
                if (skip == true) {
                    ctx.moveTo(xStart + x, yStart + y);
                    skip = false;
                } else {
                    ctx.lineTo(xStart + x, yStart + y);
                }
            }
        }

        function getX(t) {
            var x = step * t;
            if ((x > xMax) || (x < xMin)) {
                return false;
            }
            return x;
        }

        function getY(t) {
            var y = amplitude / voltDiv * k * Math.sin(freq * step * t / 180 * timeDiv * Math.PI + phase);
            if ((y > yMax) || (y < yMin)) {
                return false;
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
