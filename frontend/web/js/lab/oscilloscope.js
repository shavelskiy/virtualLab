var gridSpacingMain = 100;
var gridSpacingSecond = 20;

var curVolt = 0;
var amplitude = 5;
var freq = 2000;
var phase = 0;

var voltDiv = 5; // сколько вольт в одной клетке
var timeDiv = 1; // сколько милисекунд в одной клетке
var offsetX = 0;
var offsetY = 0;

function draw() {
    osciContext.clearRect(0, 0, osciCanvas.width, osciCanvas.height);

    drawMainGrid();

    osciContext.strokeStyle = 'rgb(134, 222, 200)';
    osciContext.beginPath();
    drawSin();
    osciContext.lineWidth = 2;
    osciContext.stroke();
    osciContext.closePath();

    // внешняя рамка
    osciContext.strokeStyle = 'rgb(223, 223, 223)';
    osciContext.strokeRect(0, 0, osciCanvas.width, osciCanvas.height);

    function drawMainGrid() {
        // основной прямоугольник
        osciContext.fillStyle = 'rgb(93, 177, 162)';
        osciContext.fillRect(0, 0, osciCanvas.width, osciCanvas.height);

        // вспомогательная сетка
        osciContext.strokeStyle = 'rgb(111, 152, 142)';
        osciContext.beginPath();
        drawVerticalLines(osciContext, gridSpacingSecond);
        drawHorizontalLines(osciContext, gridSpacingSecond);
        osciContext.stroke();
        osciContext.closePath();

        // основная сетка
        osciContext.strokeStyle = 'rgb(68, 116, 107)';
        osciContext.beginPath();
        drawVerticalLines(osciContext, gridSpacingMain);
        drawHorizontalLines(osciContext, gridSpacingMain);
        osciContext.stroke();
        osciContext.closePath();

        function drawVerticalLines(osciContext, gridSpacing) {
            var i = gridSpacing;
            while (i < osciCanvas.width) {
                osciContext.moveTo(i, 0);
                osciContext.lineTo(i, osciCanvas.height);
                i = i + gridSpacing;
            }
        }

        function drawHorizontalLines(osciContext, gridSpacing) {
            var i = gridSpacing;
            while (i < osciCanvas.height) {
                osciContext.moveTo(0, i);
                osciContext.lineTo(osciCanvas.width, i);
                i = i + gridSpacing;
            }
        }
    }

    function drawSin() {
        var step = 0.01;

        var voltK = 100; // коэфициент, благодаря которому вольты корректно соотносятся с пикселями
        var timeK = 0.000005; // коэфициент для времени

        var xStart = offsetX;
        var yStart = osciCanvas.height / 2 - offsetY;

        var xMax = osciCanvas.width - xStart;
        var xMin = xStart;
        var yMax = osciCanvas.height - yStart;
        var yMin = (-1) * yStart;

        osciContext.moveTo(xStart + getX(0), yStart + getY(0));
        for (var t = xStart; t < osciCanvas.width / step - xStart; t++) {
            osciContext.lineTo(xStart + getX(t), yStart + getY(t));
        }

        function getX(t) {
            return step * t;
        }

        function getY(t) {
            var y = (-1) * (curVolt + amplitude * Math.sin(2 * Math.PI * freq * t * step * timeK * timeDiv + phase / 180 * Math.PI)) / voltDiv * voltK;
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
