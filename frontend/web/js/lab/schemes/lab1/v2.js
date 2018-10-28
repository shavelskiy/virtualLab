/**
 * Рисует в labCanvas схему
 */
function drawScheme() {
    // основной контур
    labContext.strokeStyle = 'black';
    labContext.beginPath();
    labContext.moveTo(50, 50);
    labContext.lineTo(250, 50);
    labContext.lineTo(250, 250);
    labContext.lineTo(50, 250);
    labContext.lineTo(50, 50);
    labContext.stroke();
    labContext.closePath();

    // резисторы
    drawResistor(150, 50, false, 'R', 10, 'lab1v2', true);

    // катушка
    drawCoil(250, 150, true, 'L', 30, 'мГн', true);

    // конденсатор
    drawCapacitor(150, 250, false, 'C', 510, 'мкФ', true);

    // источник эдс
    drawVoltageSource(50, 150, true, true, 'E', 50, 'В', true);

    // частота
    drawData('f', 2000, 'Гц')
}

/**
 * Получить значение в конкретнойц точке
 * @param number
 * @returns {{Re: number, Im: number}}
 */
function getPoint(number) {
    var point = {
        'Re': 0,
        'Im': 0
    };

    switch (number) {
        case 0:
        case 6:
            point.Re = 0;
            point.Im = 0;
            break;
        case 1:
        case 2:
            point.Re = -0.66;
            point.Im = 1.53;
            break;

            break;
        case 3:
        case 5:
            point.Re = -1;
            point.Im = 2.01;
            break;
        case 4:
        case 7:
            point.Re = 5;
            point.Im = 0;
            break;
    }

    return point;
}