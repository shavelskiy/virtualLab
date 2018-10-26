var gridSpacingMain = 100,
    gridSpacingSecond = 20;

var channel1 = {
        'curVolt': 0,
        'amplitude': 5,
        'freq': 2000,
        'phase': 0
    },
    channel2 = {
        'curVolt': 2,
        'amplitude': 5,
        'freq': 2000,
        'phase': 0
    };

var settings1 = {
        'active': false,
        'voltDiv': 5,
        'timeDiv': 1,
        'offsetX': 0,
        'offsetY': 0
    },
    settings2 = {
        'active': false,
        'voltDiv': 5,
        'timeDiv': 1,
        'offsetX': 0,
        'offsetY': 0
    };


/**
 * Рисует осцилограф
 */
function draw() {
    osciContext.clearRect(0, 0, osciCanvas.width, osciCanvas.height);

    drawMainGrid();

    if (settings1.active) {
        osciContext.strokeStyle = 'rgb(134, 222, 200)';
        drawSin(channel1, settings1);
    }
    if (settings2.active) {
        osciContext.strokeStyle = 'rgb(234, 222, 200)';
        drawSin(channel2, settings2);
    }

    // внешняя рамка
    osciContext.strokeStyle = 'rgb(223, 223, 223)';
    osciContext.strokeRect(0, 0, osciCanvas.width, osciCanvas.height);

    /**
     * Рисует основную сетку
     */
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

    /**
     * Рисует синус
     * @param channel
     * @param settings
     */
    function drawSin(channel, settings) {
        osciContext.beginPath();

        var step = 0.01;

        var voltK = 100; // коэфициент, благодаря которому вольты корректно соотносятся с пикселями
        var timeK = 0.000005; // коэфициент для времени

        var xStart = settings.offsetX;
        var yStart = osciCanvas.height / 2 - settings.offsetY;

        var xMax = osciCanvas.width - xStart;
        var xMin = xStart;
        var yMax = osciCanvas.height - yStart;
        var yMin = (-1) * yStart;

        osciContext.moveTo(xStart + getX(0), yStart + getY(0));
        for (var t = xStart; t < osciCanvas.width / step - xStart; t++) {
            osciContext.lineTo(xStart + getX(t), yStart + getY(t));
        }

        osciContext.lineWidth = 2;
        osciContext.stroke();
        osciContext.closePath();

        function getX(t) {
            return step * t;
        }

        function getY(t) {
            var y = (-1) * (
                channel.curVolt +
                channel.amplitude *
                Math.sin(
                    2 * Math.PI * channel.freq * t * step * timeK * settings.timeDiv + channel.phase / 180 * Math.PI
                )) / settings.voltDiv * voltK;
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

/**
 * Изменения вольт на деление
 * @param value
 */
function changeVoltDiv(value, settingsId) {
    if (settingsId == 1) {
        settings1.voltDiv = Number(value);
    } else {
        settings2.voltDiv = Number(value);
    }
    draw();
}

/**
 * Изменение секунд на деление
 * @param value
 */
function changeTimeDiv(value, settingsId) {
    if (settingsId == 1) {
        settings1.timeDiv = Number(value);
    } else {
        settings2.timeDiv = Number(value);
    }
    draw();
}

/**
 * Изменение сдвига по горизонтали
 * @param value
 */
function changeOffsetX(value, settingsId) {
    if (settingsId == 1) {
        settings1.offsetX = Number(value);
    } else {
        settings2.offsetX = Number(value);
    }
    draw();
}

/**
 * Изменение сдвига по вертикали
 * @param value
 */
function changeOffsetY(value, settingsId) {
    if (settingsId == 1) {
        settings1.offsetY = Number(value);
    } else {
        settings2.offsetY = Number(value);
    }
    draw();
}

/**
 * Включить/выключить канал
 * @param value
 * @param settingsId
 */
function changeActive(value, settingsId) {
    if (settingsId == 1) {
        settings1.active = value;
    } else {
        settings2.active = value;
    }
    draw();
}
