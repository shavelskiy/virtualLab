var kolData = 0;

/**
 * Рисует в lanCanvas схему
 */
function drawScheme() {
    // основной контур
    labContext.strokeStyle = 'black';
    labContext.beginPath();
    labContext.moveTo(50, 50);
    labContext.lineTo(350, 50);
    labContext.lineTo(350, 350);
    labContext.lineTo(50, 350);
    labContext.lineTo(50, 50);
    labContext.stroke();
    labContext.closePath();

    // резисторы
    drawResistor(200, 50, false, 'R1', 100, 'Ом');
    drawResistor(350, 100, true, 'R2', 200, 'Ом');

    // конденсатор
    drawCapacitor(350, 200, true, 'C1', 50, 'нФ');
    drawCapacitor(100, 350, false, 'C2', 140, 'мкФ');

    // катушка
    drawCoil(200, 350, false, 'L1', 340, 'мГн');
    drawCoil(350, 300, true, 'L2', 120, 'мГн');

    // источник эдс
    drawVoltageSource(50, 200, true, true, 'E1', 35, 'В');
    drawVoltageSource(300, 50, false, false, 'E2', 10, 'В');

    // источник тока
    drawCurrentSource(50, 100, true, true, 'J1', 10, 'мА');
    drawCurrentSource(100, 50, false, false, 'J2', 25, 'мА');
}

/**
 * ЗДобавляет значения элементов
 * @param name
 * @param value
 * @param units
 */
function drawData(name, value, units) {
    dataContext.fillText(name + ' = ' + value + ' ' + units, 30, kolData * 25 + 50);
    kolData++;
}