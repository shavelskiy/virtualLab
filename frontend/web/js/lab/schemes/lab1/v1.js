function drawScheme() {
    labContext.clearRect(0, 0, labCanvas.width, labCanvas.height);

    // внешняя рамка
    labContext.strokeStyle = 'rgb(223, 223, 223)';
    labContext.strokeRect(0, 0, labCanvas.width, labCanvas.height);

    // русуем схему
    labContext.font = 'bold 16px sans-serif';

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
    drawResistor(200, 50, false, 'R1');
    drawResistor(350, 100, true, 'R2');

    // конденсатор
    drawCapacitor(350, 200, true, 'C1');
    drawCapacitor(100, 350, false, 'C2');

    // катушка
    drawCoil(200, 350, false, 'L1');
    drawCoil(350, 300, true, 'L2');

    // источник эдс
    drawVoltageSource(50, 200, true, true, 'E1');
    drawVoltageSource(300, 50, false, false, 'E2');

    // источник тока
    drawCurrentSource(50, 100, true, true, 'J1');
    drawCurrentSource(100, 50, false, false, 'J2');
}
