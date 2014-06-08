$(document).ready(function() {
    ////Displays the character count for the text inputs
    //////Maximum Length: ANY
    $('.length_text', this).keyup(function() {
        var max = $(this).attr('maxlength');
        var len = $(this).val().length;
        if (len >= max) {
            $(this).closest('div')
                    .find('.charNum')
                    .text(' (Character limit)')
                    .css('color', 'red');
//            string = string.substr(0, string.length - 1);
//            $(this).val(string);
        } else {
            var char = max - len;
            $(this).closest('div')
                    .find('.charNum')
                    .text(' (' + char + ' characters left)')
                    .css('color', 'black');
        }
//    $('.length_any', this).keydown(function(event) {
//        var max = $(this).attr('maxlength');
//        var len = $(this).val().length;
//        if (len >= max) {
//            event.preventDefault();
//        }
//        if (len >= max) {
//            $(this).closest('div')
//                    .find('.charNum')
//                    .text(' (You have reached the character limit)')
//                    .css('color', 'red');
//            string = string.substr(0, string.length - 1);
//            $(this).val(string);
//        } else {
//            var char = max - len;
//            $(this).closest('div')
//                    .find('.charNum')
//                    .text(' (' + char + ' characters left)')
//                    .css('color', 'black');
//        }
    });
});

function textbox_check_length(minLength, maxLength, error, type) {
    if (type == "Alert") {
        if (minLength <= maxLength) {
            alert("Incorrect Length");
        }
    } else if (type == "Message_Halt") {

    }
}