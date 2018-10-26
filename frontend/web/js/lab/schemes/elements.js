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
 */
function drawResistor(x, y, vertical, name, value, units) {
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
    drawData(name, value, units);
}

/**
 * Нарисовать конденсатор
 * @param x
 * @param y
 * @param vertical
 * @param name
 * @param value
 * @param units
 */
function drawCapacitor(x, y, vertical, name, value, units) {
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
    drawData(name, value, units);
}

/**
 * Нарисовать катушку индуктивности
 * @param x
 * @param y
 * @param vertical
 * @param name
 * @param value
 * @param units
 */
function drawCoil(x, y, vertical, name, value, units) {
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
    drawData(name, value, units);
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
 */
function drawVoltageSource(x, y, vertical, direction, name, value, units) {
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
    drawData(name, value, units);
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
 */
function drawCurrentSource(x, y, vertical, direction, name, value, units) {
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
    drawData(name, value, units);
}
