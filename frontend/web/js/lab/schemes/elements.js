var width;
var height;

/**
 * Нарисовать резистор
 * @param x
 * @param y
 * @param vertical
 * @param name
 * @param value
 * @param units
 * @param drawPoints
 */
function drawResistor(x, y, vertical, name, value, units, drawPoints) {
    drawData(name, value, units);

    if (drawPoints) {
        drawPointsAroundElement(x, y, vertical, 'long');
    }

    if (vertical) {
        width = 20;
        height = 50;
        labContext.fillText(name, x + 15, y + 8);
    } else {
        width = 50;
        height = 20;
        labContext.fillText(name, x - 8, y - 15);
    }

    labContext.clearRect(x - width / 2, y - height / 2, width, height);
    labContext.strokeRect(x - width / 2, y - height / 2, width, height);
}

/**
 * Нарисовать конденсатор
 * @param x
 * @param y
 * @param vertical
 * @param name
 * @param value
 * @param units
 * @param drawPoints
 */
function drawCapacitor(x, y, vertical, name, value, units, drawPoints) {
    drawData(name, value, units);

    if (drawPoints) {
        drawPointsAroundElement(x, y, vertical, 'short');
    }

    if (vertical) {
        width = 50;
        height = 10;
        labContext.fillText(name, x + 28, y + 6);
    } else {
        width = 10;
        height = 50;
        labContext.fillText(name, x - 9, y - 30);
    }

    labContext.clearRect(x - width / 2, y - height / 2, width, height);
    labContext.beginPath();
    if (vertical) {
        labContext.moveTo(x - width / 2, y - height / 2);
        labContext.lineTo(x + width / 2, y - height / 2);
        labContext.moveTo(x - width / 2, y + height / 2);
        labContext.lineTo(x + width / 2, y + height / 2);
    } else {
        labContext.moveTo(x - width / 2, y + height / 2);
        labContext.lineTo(x - width / 2, y - height / 2);
        labContext.moveTo(x + width / 2, y - height / 2);
        labContext.lineTo(x + width / 2, y + height / 2);
    }
    labContext.stroke();
    labContext.closePath();
}

/**
 * Нарисовать катушку индуктивности
 * @param x
 * @param y
 * @param vertical
 * @param name
 * @param value
 * @param units
 * @param drawPoints
 */
function drawCoil(x, y, vertical, name, value, units, drawPoints) {
    drawData(name, value, units);

    if (drawPoints) {
        drawPointsAroundElement(x, y, vertical, 'long');
    }

    if (vertical) {
        width = 20;
        height = 60;
        labContext.fillText(name, x + 9, y + 7);
    } else {
        width = 60;
        height = 20;
        labContext.fillText(name, x - 9, y - 20);
    }

    labContext.clearRect(x - width / 2, y - height / 2, width, height);
    labContext.beginPath();
    if (vertical) {
        labContext.arc(x, y + width, width / 2, (-1 / 2) * Math.PI, Math.PI / 2, true);
    } else {
        labContext.arc(x - height, y, height / 2, 0, Math.PI, true);
    }
    labContext.stroke();
    labContext.closePath();
    labContext.beginPath();
    if (vertical) {
        labContext.arc(x, y, width / 2, (-1 / 2) * Math.PI, Math.PI / 2, true);
    } else {
        labContext.arc(x, y, height / 2, 0, Math.PI, true);
    }
    labContext.stroke();
    labContext.closePath();
    labContext.beginPath();
    if (vertical) {
        labContext.arc(x, y - width, width / 2, (-1 / 2) * Math.PI, Math.PI / 2, true);
    } else {
        labContext.arc(x + height, y, height / 2, 0, Math.PI, true);
    }
    labContext.stroke();
    labContext.closePath();
}

/**
 * Нарисовать источник ЭДС
 * @param x
 * @param y
 * @param vertical
 * @param direction
 * @param name
 * @param value
 * @param units
 * @param drawPoints
 */
function drawVoltageSource(x, y, vertical, direction, name, value, units, drawPoints) {
    drawData(name, value, units);

    if (drawPoints) {
        drawPointsAroundElement(x, y, vertical, 'middle');
    }

    labContext.beginPath();
    labContext.arc(x, y, 20, 0, 2 * Math.PI, true);
    labContext.stroke();
    labContext.closePath();
    labContext.beginPath();

    if (vertical) {
        if (direction) {
            labContext.moveTo(x, y - 20);
            labContext.lineTo(x + 5, y - 5);
            labContext.lineTo(x - 5, y - 5);
        } else {
            labContext.moveTo(x, y + 20);
            labContext.lineTo(x + 5, y + 5);
            labContext.lineTo(x - 5, y + 5);
        }
        labContext.fillText(name, x + 25, y + 6);
    } else {
        if (direction) {
            labContext.moveTo(x + 20, y);
            labContext.lineTo(x + 5, y - 5);
            labContext.lineTo(x + 5, y + 5);
        } else {
            labContext.moveTo(x - 20, y);
            labContext.lineTo(x - 5, y - 5);
            labContext.lineTo(x - 5, y + 5);
        }
        labContext.fillText(name, x - 10, y - 25);
    }

    labContext.fill();
    labContext.closePath();
}

/**
 * Нарисвоать источник тока
 * @param x
 * @param y
 * @param vertical
 * @param direction
 * @param name
 * @param value
 * @param units
 * @param drawPoints
 */
function drawCurrentSource(x, y, vertical, direction, name, value, units, drawPoints) {
    drawData(name, value, units);

    if (drawPoints) {
        drawPointsAroundElement(x, y, vertical, 'middle');
    }

    labContext.clearRect(x - 20, y - 20, 40, 40);
    labContext.beginPath();
    labContext.arc(x, y, 20, 0, 2 * Math.PI, true);
    labContext.stroke();
    labContext.closePath();
    labContext.beginPath();

    if (vertical) {
        if (direction) {
            labContext.moveTo(x, y - 20);
            labContext.lineTo(x, y - 10);
            labContext.moveTo(x, y + 20);
            labContext.lineTo(x, y);
            labContext.moveTo(x - 10, y);
            labContext.lineTo(x, y - 10);
            labContext.lineTo(x + 10, y);
            labContext.moveTo(x - 10, y + 10);
            labContext.lineTo(x, y);
            labContext.lineTo(x + 10, y + 10);
        } else {
            labContext.moveTo(x, y - 20);
            labContext.lineTo(x, y);
            labContext.moveTo(x, y + 10);
            labContext.lineTo(x, y + 20);
            labContext.moveTo(x - 10, y - 10);
            labContext.lineTo(x, y);
            labContext.lineTo(x + 10, y - 10);
            labContext.moveTo(x - 10, y);
            labContext.lineTo(x, y + 10);
            labContext.lineTo(x + 10, y);
        }
        labContext.fillText(name, x + 25, y + 6);
    } else {
        if (direction) {
            labContext.moveTo(x + 20, y);
            labContext.lineTo(x + 10, y);
            labContext.moveTo(x - 20, y);
            labContext.lineTo(x, y);
            labContext.moveTo(x, y - 10);
            labContext.lineTo(x + 10, y);
            labContext.lineTo(x, y + 10);
            labContext.moveTo(x - 10, y - 10);
            labContext.lineTo(x, y);
            labContext.lineTo(x - 10, y + 10);
        } else {
            labContext.moveTo(x + 20, y);
            labContext.lineTo(x, y);
            labContext.moveTo(x - 20, y);
            labContext.lineTo(x - 10, y);
            labContext.moveTo(x, y - 10);
            labContext.lineTo(x - 10, y);
            labContext.lineTo(x, y + 10);
            labContext.moveTo(x + 10, y - 10);
            labContext.lineTo(x, y);
            labContext.lineTo(x + 10, y + 10);
        }
        labContext.fillText(name, x - 10, y - 25);
    }

    labContext.stroke();
    labContext.closePath();
}

/**
 * Рисует точку (узел)
 * @param x
 * @param y
 * @param offset смещать надпись по диагонали?
 * @param left
 * для offset = false - писать слева от ветви? null - если есть top
 * для offset = true - смещать по диагонали налево?
 * @param top
 * по аналогии с параметром left
 */
function drawPoint(x, y, offset, left, top) {
    var k = 1;
    var kOff = 1;
    if (currentPoint > 9) {
        k = 1.5;
        kOff = 2;
    }

    labContext.beginPath();
    labContext.clearRect(x - 3, y - 3, 6, 6);
    labContext.arc(x, y, 4, 0, 2 * Math.PI, true);
    labContext.stroke();
    labContext.closePath();

    labContext.font = 'bold 10px sans-serif';
    if (offset) {
        if (top) {
            if (left) {
                labContext.fillText(currentPoint, x - (12 * k), y - 6);
            } else {
                labContext.fillText(currentPoint, x + 6, y - 6);
            }
        } else {
            if (left) {
                labContext.fillText(currentPoint, x - (12 * k), y + 12);
            } else {
                labContext.fillText(currentPoint, x + 6, y + 12);
            }
        }
    } else {
        if (top != null) {
            if (top) {
                labContext.fillText(currentPoint, x - (3 * kOff), y - 6);
            } else {
                labContext.fillText(currentPoint, x - (3 * kOff), y + 15);
            }
        } else {
            if (left) {
                labContext.fillText(currentPoint, x - 10 - (4 * kOff), y + 3);
            } else {
                labContext.fillText(currentPoint, x + 6, y + 3);
            }
        }
    }

    currentPoint++;
    labContext.font = 'bold 16px sans-serif';
}

/**
 * Нарисовать два узла вокруг элемента
 * @param x
 * @param y
 * @param vertical
 * @param size
 */
function drawPointsAroundElement(x, y, vertical, size) {
    var radius = 45;

    switch (size) {
        case 'short':
            radius = 20;
            break;
        case 'middle':
            radius = 35;
            break;
        case 'long':
            radius = 45;
            break;
    }

    if (vertical) {
        drawPoint(x, y - radius, false, true, null);
        drawPoint(x, y + radius, false, true, null);
    } else {
        drawPoint(x - radius, y, false, null, false);
        drawPoint(x + radius, y, false, null, false);
    }
}
