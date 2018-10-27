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
    }

    // настройки осцилографа
    $('#settings #timeDiv').each(function (data) {
        $(this).change(function () {
            changeTimeDiv($(this).val(), $(this).parent().attr('id'));
        });
    });

    $('#settings #voltsDiv').each(function (data) {
        $(this).change(function () {
            changeVoltDiv($(this).val(), $(this).parent().attr('id'));
        });
    });

    $(document).on('input', '#offsetX', function () {
        changeOffsetX($(this).val(), $(this).parent().attr('id'));
    }).change();

    $(document).on('input', '#offsetY', function () {
        changeOffsetY($(this).val(), $(this).parent().attr('id'));
    });

    $('#settings [id ^=active]').each(function (data) {
        $(this).change(function () {
            changeActive($(this).is(':checked'), $(this).parent().attr('id'));
        });
    });

    // выбор точек
    $('#choose #draw_osci').each(function (data) {
        $(this).click(function () {
            var channel = $(this).attr('channel');
            var points = [];
            $('#choose #points').find('[channel=' + channel + ']').each(function (data) {
                points.push($(this).val());
            });
            changeChannel(channel, points);
        });
    });

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
    }
})
;