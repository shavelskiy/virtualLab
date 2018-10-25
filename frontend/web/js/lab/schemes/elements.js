var width;
var height;

// резистор
function drawResistor(x, y, vertical) {
    if (vertical) {
        width = 20;
        height = 50;
    } else {
        width = 50;
        height = 20;
    }

    labContext.clearRect(x - width / 2, y - height / 2, width, height);
    labContext.strokeRect(x - width / 2, y - height / 2, width, height);
}

// конденсатор
function drawCapacitor(x, y, vertical) {
    if (vertical) {
        width = 50;
        height = 10;
    } else {
        width = 10;
        height = 50;
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

// катушка
function drawCoil(x, y, vertical) {
    if (vertical) {
        width = 20;
        height = 60;
    } else {
        width = 60;
        height = 20;
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

// источник ЭДС
function drawVoltageSource(x, y, vertical, dirrection) {
    labContext.beginPath();
    labContext.arc(x, y, 20, 0, 2 * Math.PI, true);
    labContext.stroke();
    labContext.closePath();
    labContext.beginPath();

    if (vertical) {
        if (dirrection) {
            labContext.moveTo(x, y - 20);
            labContext.lineTo(x + 5, y - 5);
            labContext.lineTo(x - 5, y - 5);
        } else {
            labContext.moveTo(x, y + 20);
            labContext.lineTo(x + 5, y + 5);
            labContext.lineTo(x - 5, y + 5);
        }
    } else {
        if (dirrection) {
            labContext.moveTo(x + 20, y);
            labContext.lineTo(x + 5, y - 5);
            labContext.lineTo(x + 5, y + 5);
        } else {
            labContext.moveTo(x - 20, y);
            labContext.lineTo(x - 5, y - 5);
            labContext.lineTo(x - 5, y + 5);
        }
    }

    labContext.fill();
    labContext.closePath();
}

// источник тока
function drawCurrentSource(x, y, vertical, dirrection) {
    labContext.clearRect(x - 20, y - 20, 40, 40);
    labContext.beginPath();
    labContext.arc(x, y, 20, 0, 2 * Math.PI, true);
    labContext.stroke();
    labContext.closePath();
    labContext.beginPath();

    if (vertical) {
        if (dirrection) {
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
    } else {
        if (dirrection) {
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
            labContext.moveTo(x + 20 , y);
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
    }

    labContext.stroke();
    labContext.closePath();
}
