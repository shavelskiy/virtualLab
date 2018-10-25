function drawScheme() {
    labcontext.clearRect(0, 0, labCanvas.width, labCanvas.height);

    // внешняя рамка
    labcontext.strokeStyle = 'rgb(223, 223, 223)';
    labcontext.strokeRect(0, 0, labCanvas.width, labCanvas.height);

    // основной прямоугольник
    labcontext.fillStyle = 'rgb(93, 177, 162)';
    labcontext.fillRect(0, 0, labCanvas.width, labCanvas.height);
}
