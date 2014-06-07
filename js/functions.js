$(document).ready(function() {
    ////Displays the character count for the text inputs
    ////Maximum Length: 24
    $('.length_24', this).keyup(function() {
        var max = 24;
        var len = $(this).val().length;
        if (len >= max) {
            $(this).closest('div')
                    .find('.charNum')
                    .text(' (You have reached the character limit)')
                    .css('color', 'red');
        } else {
            var char = max - len;
            $(this).closest('div')
                    .find('.charNum')
                    .text(' (' + char + ' characters left)')
                    .css('color', 'black');
        }
    });
    //Maximum Length: 50
    $('.length_50', this).keyup(function() {
        var max = 50;
        var len = $(this).val().length;
        if (len >= max) {
            $(this).closest('div')
                    .find('.charNum')
                    .text(' (You have reached the character limit)')
                    .css('color', 'red');
        } else {
            var char = max - len;
            $(this).closest('div')
                    .find('.charNum')
                    .text(' (' + char + ' characters left)')
                    .css('color', 'black');
        }
    });
    //Maximum Length: 64
    $('.length_64', this).keyup(function() {
        var max = 64;
        var len = $(this).val().length;
        if (len >= max) {
            $(this).closest('div')
                    .find('.charNum')
                    .text(' (You have reached the character limit)')
                    .css('color', 'red');
        } else {
            var char = max - len;
            $(this).closest('div')
                    .find('.charNum')
                    .text(' (' + char + ' characters left)')
                    .css('color', 'black');
        }
    });
    //Maximum Length: 128
    $('.length_128', this).keyup(function() {
        var max = 128;
        var len = $(this).val().length;
        if (len >= max) {
            $(this).closest('div')
                    .find('.charNum')
                    .text(' (You have reached the character limit)')
                    .css('color', 'red');
        } else {
            var char = max - len;
            $(this).closest('div')
                    .find('.charNum')
                    .text(' (' + char + ' characters left)')
                    .css('color', 'black');
        }
    });
    //Maximum Length: 700
    $('.length_700', this).keyup(function() {
        var max = 700;
        var len = $(this).val().length;
        if (len >= max) {
            $(this).closest('div')
                    .find('.charNum')
                    .text(' (You have reached the character limit)')
                    .css('color', 'red');
        } else {
            var char = max - len;
            $(this).closest('div')
                    .find('.charNum')
                    .text(' (' + char + ' characters left)')
                    .css('color', 'black');
        }
    });
});