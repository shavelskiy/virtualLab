var kolData = 0;
var currentPoint = 0;

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
    drawResistor(120, 50, false, 'R1', 100, 'Ом', true);
    drawResistor(350, 110, true, 'R2', 200, 'Ом', true);

    // конденсатор
    drawCapacitor(350, 200, true, 'C1', 50, 'нФ', true);
    drawCapacitor(120, 350, false, 'C2', 140, 'мкФ', true);

    // катушка
    drawCoil(250, 350, false, 'L1', 340, 'мГн', true);
    drawCoil(350, 290, true, 'L2', 120, 'мГн', true);

    // источник эдс
    drawVoltageSource(50, 250, true, true, 'E1', 35, 'В', true);
    drawVoltageSource(280, 50, false, false, 'E2', 10, 'В', true);

    // источник тока
    drawCurrentSource(50, 150, true, true, 'J1', 10, 'мА', true);

    // проставляем узлы
    // drawPoint(50, 50, true, false, false);
    // drawPoint(350, 50, true, true, false);
    // drawPoint(350, 350, true, true, true);
    // drawPoint(50, 350, true, false, true);
    // drawPoint(150, 50, false, null, false);
    // drawPoint(350, 150, false, true, null);
    // drawPoint(300, 350, false, null, true);
    // drawPoint(50, 250, false, false, null);
}

/**
 * Добавляет значения элементов
 * @param name
 * @param value
 * @param units
 */
function drawData(name, value, units) {
    dataContext.font = 'bold 16px sans-serif';
    dataContext.fillText(name + ' = ' + value + ' ' + units, 30, kolData * 25 + 50);
    kolData++;
}