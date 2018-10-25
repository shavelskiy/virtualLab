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
    labContext.clearRect(175, 40, 50, 20);
    labContext.strokeRect(175, 40, 50, 20);

    // конденсатор
    labContext.clearRect(325, 195, 50, 10);
    labContext.beginPath();
    labContext.moveTo(325, 195);
    labContext.lineTo(375, 195);
    labContext.moveTo(325, 205);
    labContext.lineTo(375, 205);
    labContext.stroke();
    labContext.closePath();

    // катушка
    labContext.clearRect(170, 340, 60, 20);
    labContext.beginPath();
    labContext.arc(180, 350, 10, 0, Math.PI, true);
    labContext.stroke();
    labContext.closePath();
    labContext.beginPath();
    labContext.arc(200, 350, 10, 0, Math.PI, true);
    labContext.stroke();
    labContext.closePath();
    labContext.beginPath();
    labContext.arc(220, 350, 10, 0, Math.PI, true);
    labContext.stroke();
    labContext.closePath();

    // источник эдс
    labContext.beginPath();
    labContext.arc(50, 200, 20, 0, 2 * Math.PI, true);
    labContext.stroke();
    labContext.closePath();
    labContext.beginPath();
    labContext.moveTo(50, 180);
    labContext.lineTo(55, 195);
    labContext.lineTo(45, 195);
    labContext.lineTo(50, 180);
    labContext.fill();
    labContext.closePath();
}
