function drawScheme() {

    dataContext.clearRect(0, 0, dataCanvas.width, dataCanvas.height);

    kolPoints = 0;
    kolData = 0;
    currentPoint = 0;
    point1 = 0;
    point2 = 0;


    labContext.clearRect(0, 0, graphCanvas.width, graphCanvas.height);

    switch (schemeNum) {
        case 1:
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
            drawResistor(300, 150, true, 'R', false, 0, 'Ом', true);

            $('.select-value').removeClass('invisible');
            break;
        case 2:
            // основной контур
            labContext.strokeStyle = 'black';
            labContext.beginPath();
            labContext.moveTo(240, 80);
            labContext.lineTo(300, 80);
            labContext.lineTo(300, 100);

            labContext.moveTo(240, 220);
            labContext.lineTo(300, 220);
            labContext.lineTo(300, 200);

            labContext.moveTo(170, 50);
            labContext.lineTo(240, 50);
            labContext.lineTo(240, 250);
            labContext.lineTo(170, 250);
            labContext.lineTo(170, 50);

            labContext.stroke();
            labContext.closePath();

            drawPoint(300, 100, false, true, null);
            drawPoint(300, 200, false, true, null);

            labContext.font = 'bold 16px sans-serif';
            labContext.fillText('A', 200, 150);

            $('.select-value').addClass('invisible');
            break;
        case 3:
            // основной контур
            labContext.strokeStyle = 'black';
            labContext.beginPath();
            labContext.moveTo(150, 50);
            labContext.lineTo(250, 50);
            labContext.lineTo(250, 270);
            labContext.lineTo(150, 270);
            labContext.lineTo(150, 50);

            labContext.stroke();
            labContext.closePath();

            drawResistor(250, 115, true, 'R1', true, elems['R1'], 'Ом', true);
            drawResistor(250, 205, true, 'R2', true, elems['R2'], 'Ом', false);
            drawVoltageSource(150, 150, true, true, 'E', false, elems['E'], 'В', false);

            drawPoint(250, 250, false, true, null);

            $('.select-value').addClass('invisible');
            break;
        case 4:
            // основной контур
            labContext.strokeStyle = 'black';
            labContext.beginPath();
            labContext.moveTo(150, 50);
            labContext.lineTo(250, 50);
            labContext.lineTo(250, 200);
            labContext.lineTo(150, 200);
            labContext.lineTo(150, 50);

            labContext.moveTo(250, 50);
            labContext.lineTo(320, 50);
            labContext.lineTo(320, 200);
            labContext.lineTo(250, 200);

            labContext.stroke();
            labContext.closePath();

            drawResistor(250, 125, true, 'R1', true, elems['R1'], 'Ом', false);
            drawResistor(320, 125, true, 'R', true, elems['R'], 'Ом', false);
            drawResistor(200, 50, false, 'R2', true, elems['R2'], 'Ом', false);
            drawVoltageSource(150, 125, true, true, 'E', false, 0, 'В', false);

            drawPoint(150, 50, false, true, null);
            drawPoint(250, 50, false, null, true);
            drawPoint(250, 200, false, null, false);

            $('.select-value').addClass('invisible');
            break;


    }
}

