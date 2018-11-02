var onOff = $('.gdm #on-off'),
    display = $('.gdm-display');

function getValue() {
    switch (mode) {
        case 'v':
            return getV();
            break;
        case 'a':
            return getA();
            break;
        case 'o':
            return getO();
            break;
    }
}

$(document).ready(function () {
    onOff.change(function () {
        if (onOff.is(':checked')) {
            display.val(getValue());
        } else {
            display.val('');
        }
    });

    $('.gdm-mode').each(function () {
        $(this).change(function () {
            mode = $(this).val();
            display.val(getValue());
        });
    });

    $('.point-1').change(function() {
        point1 = $(this).val();
        calculatePotencials();
        display.val(getValue());
    });

    $('.point-2').change(function() {
        point2 = $(this).val();
        calculatePotencials();
        display.val(getValue());
    });
});
