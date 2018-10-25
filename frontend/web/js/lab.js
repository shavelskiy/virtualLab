var canvas;
var ctx;

var width = 700;
var height = 400;
var border = 2;
var gridSpacingMain = 100;
var gridSpacingSecond = 20;

var amplitude = 200;
var freq = 10;
var phase = 0;

var voltDiv = 5; // сколько вольт в одной клетке
var timeDiv = 1; // сколько милисекунд в одной клетке
var offsetX = 0;
var offsetY = 0;

function draw() {
    drawMainGrid();

    ctx.strokeStyle = "olive";
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
        ctx.strokeStyle = 'rgb(128, 128, 128)';
        ctx.beginPath();
        drawVerticalLines(ctx, gridSpacingSecond);
        drawHorizontalLines(ctx, gridSpacingSecond);
        ctx.stroke();
        ctx.closePath();

        // основная сетка
        ctx.strokeStyle = 'rgb(24, 86, 76)';
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

        var xStart = border + offsetX;
        var yStart = height / 2 - offsetY;

        var xMax = width - xStart + border / 2;
        var xMin = border + 1 - xStart;
        var yMax = height - yStart + border / 2;
        var yMin = border + 1 - yStart;

        ctx.moveTo(xStart + getX(0), yStart + getY(0));
        for (var t = 1; t < width / step; t++) {
            ctx.lineTo(xStart + getX(t), yStart + getY(t));
        }

        function getX(t) {
            var x = step * t;
            if (x > xMax) {
                x = xMax;
            }
            if (x < xMin) {
                x = xMin;
            }
            return x;
        }

        function getY(t) {
            var y = amplitude / voltDiv * Math.sin(freq * step * t / 180 * Math.PI * timeDiv + phase);
            if (y > yMax) {
                y = yMax;
            }
            if (y < yMin) {
                y = yMin;
            }
            return y;
        }
    }
}


function changeVoltDiv(value) {
    voltDiv = Number(value);
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    draw();
}

function changeTimeDiv(value) {
    timeDiv = Number(value);
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    draw();
}

function changeOffsetX(value) {
    offsetX = Number(value);
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    draw();
}

function changeOffsetY(value) {
    offsetY = Number(value);
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    draw();
}

$(document).ready(function () {
    canvas = document.getElementById('canvas');
    if (canvas.getContext) {
        ctx = canvas.getContext('2d');
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