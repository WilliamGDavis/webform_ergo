$(document).ready(function() {
    //Set the mask for the phone number field(s)
    $("#txt_Phone, #txt_Fax, #txt_UserPhone, #txt_UserFax").mask("(999) 999-9999");
    
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
    });
    
    //Copy the Company Information into the End User Fields
    $('#btn_CopyCompanyInfo').on('click', function(){
        $('#txt_UserCompanyName').val($('#txt_CompanyName').val());
        $('#txt_UserStreetAddress').val($('#txt_StreetAddress').val());
        $('#txt_UserCity').val($('#txt_City').val());
        $('#cb_UserState').val($('#cb_State option:selected').val());
        $('#txt_UserZip').val($('#txt_Zip').val());
        $('#txt_UserFirstName').val($('#txt_FirstName').val());
        $('#txt_UserLastName').val($('#txt_LastName').val());
        $('#txt_UserTitle').val($('#txt_Title').val());
        $('#txt_UserPhone').val($('#txt_Phone').val());
        $('#txt_UserFax').val($('#txt_Fax').val());
        $('#txt_UserEmail').val($('#txt_Email').val());
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