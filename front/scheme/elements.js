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
    kolPoints++;
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

/**
 * Добавляет значения элементов
 * @param name
 * @param value
 * @param units
 */
function drawData(name, value, units) {
    dataContext.font = 'bold 16px sans-serif';
    dataContext.fillText(name + ' = ' + value + ' ' + units, 0, kolData * 25 + 20);
    kolData++;
}

function addPoints() {
    $('#choose #points').find('select').each(function (data) {
        $(this).find('option').remove();
        for (var i = 0; i < kolPoints; i++) {
            $(this).append('<option value="' + i + '">' + i + '</option>');
        }
    });
}
