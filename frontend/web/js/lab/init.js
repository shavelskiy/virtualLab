var osciCanvas;
var osciContext;

var labCanvas;
var labContext;

var dataCanvas;
var dataContext;

$(document).ready(function () {
    osciCanvas = document.getElementById('oscilloscope');
    if (osciCanvas.getContext) {
        osciContext = osciCanvas.getContext('2d');
        draw();
        draw();
    }

    $('#timeDiv').change(function () {
        changeTimeDiv($(this).val());
    });

    $('#voltsDiv').change(function () {
        changeVoltDiv($(this).val());
    });

    $(document).on('input', '#offsetX', function () {
        changeOffsetX($(this).val());
    }).change();

    $(document).on('input', '#offsetY', function () {
        changeOffsetY($(this).val());
    });

    dataCanvas = document.getElementById('data');
    if (dataCanvas.getContext) {
        dataContext = dataCanvas.getContext('2d');
        dataContext.clearRect(0, 0, dataCanvas.width, dataCanvas.height);
        // внешняя рамка
        dataContext.strokeStyle = 'rgb(223, 223, 223)';
        dataContext.strokeRect(0, 0, dataCanvas.width, dataCanvas.height);
    }

    labCanvas = document.getElementById('scheme');
    if (labCanvas.getContext) {
        labContext = labCanvas.getContext('2d');
        labContext.clearRect(0, 0, labCanvas.width, labCanvas.height);
        // внешняя рамка
        labContext.strokeStyle = 'rgb(223, 223, 223)';
        labContext.strokeRect(0, 0, labCanvas.width, labCanvas.height);
        labContext.font = 'bold 16px sans-serif';
        drawScheme();
    }
});