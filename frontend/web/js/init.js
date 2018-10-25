var osciCanvas;
var osciContext;

var labCanvas;
var labcontext;

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

    labCanvas = document.getElementById('scheme');
    if (labCanvas.getContext) {
        labcontext = labCanvas.getContext('2d');
        drawScheme();
    }
});