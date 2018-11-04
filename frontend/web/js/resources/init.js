var labCanvas;
var labContext;

var dataCanvas;
var dataContext;

var schemeNum = 1;
var elems;

$(document).ready(function () {
    dataCanvas = document.getElementById('data');
    if (dataCanvas.getContext) {
        dataContext = dataCanvas.getContext('2d');
        dataContext.clearRect(0, 0, dataCanvas.width, dataCanvas.height);
    }

    labCanvas = document.getElementById('scheme');
    if (labCanvas.getContext) {
        labContext = labCanvas.getContext('2d');
        labContext.clearRect(0, 0, labCanvas.width, labCanvas.height);
        labContext.font = 'bold 16px sans-serif';
        drawScheme();
        addPoints();
    }

    $('.choose-scheme').change(function () {
        schemeNum = Number($(this).val());
        if (on) {
            display.val(getValue());
        }

        elems = elements[schemeNum];

        drawScheme();
        addPoints();
    });
});