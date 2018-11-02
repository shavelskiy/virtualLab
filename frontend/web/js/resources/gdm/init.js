var onOff = $('.gdm #on-off');

var display = $('.gdm-display');

$(document).ready(function () {
    onOff.change(function() {
        if (onOff.is(':checked')) {
            display.val(value);
        } else {
            display.val('');
        }
    });

    $('.gdm-mode').each(function() {
        $(this).change(function() {
           mode = $(this).val();
        });
    });
});
