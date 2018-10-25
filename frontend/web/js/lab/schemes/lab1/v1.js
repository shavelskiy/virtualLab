function drawScheme() {
    labContext.clearRect(0, 0, labCanvas.width, labCanvas.height);

    // внешняя рамка
    labContext.strokeStyle = 'rgb(223, 223, 223)';
    labContext.strokeRect(0, 0, labCanvas.width, labCanvas.height);

    // русуем схему

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
    // drawResistor(200, 50, false);
    // drawResistor(350, 200, true);

    // конденсатор
    drawCapacitor(350, 200, true);
    // drawCapacitor(200, 350, false);

    // катушка
    drawCoil(200, 350, false);
    // drawCoil(50, 200, true);

    // источник эдс
    // drawVoltageSource(50, 200, true, true);
    // drawVoltageSource(200, 50, false, false);

    // источник тока
    drawCurrentSource(50, 200, true, true);
    drawCurrentSource(200, 50, false, false);
}
