function drawScheme11(R) {
    // основной контур
    labContext.strokeStyle = 'black';
    labContext.beginPath();
    labContext.moveTo(240, 80);
    labContext.lineTo(300, 80);
    labContext.lineTo(300, 220);
    labContext.lineTo(240, 220);

    labContext.moveTo(170, 50);
    labContext.lineTo(240, 50);
    labContext.lineTo(240, 250);
    labContext.lineTo(170, 250);
    labContext.lineTo(170, 50);

    labContext.stroke();
    labContext.closePath();

    labContext.font = 'bold 16px sans-serif';
    labContext.fillText('A', 200, 150);

    // резисторы
    drawResistor(300, 150, true, 'R', false,  R, 'Ом', true);
}