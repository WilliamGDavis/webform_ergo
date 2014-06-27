$(document).ready(function() {
    //Set the mask for the phone number field(s)
    $("#txt_Phone, #txt_Fax, #txt_UserPhone, #txt_UserFax").mask("(999) 999-9999");

    //Temporary:
    $('#btn_GenerateFields').on('click', function() {
        $('#txt_CompanyName').val("Computer Doctors");
        $('#txt_StreetAddress').val("230 N State Rd Ste 200");
        $('#txt_City').val("Davison");
        $('#cb_State').val("MI");
        $('#txt_Zip').val("48423");
        $('#txt_FirstName').val("William");
        $('#txt_LastName').val("Davis");
        $('#txt_Title').val("Director of Operations");
        $('#txt_Phone').val("(810) 412-4200");
        $('#txt_Fax').val("(810) 412-4201");
        $('#txt_Email').val("will@willdavis.net");
        $('#txt_UserCompanyName').val("Digital Medics");
        $('#txt_UserStreetAddress').val("123 Main St");
        $('#txt_UserCity').val("Flushing");
        $('#cb_UserState').val("MI");
        $('#txt_UserZip').val("48539");
        $('#txt_UserFirstName').val("Andrew");
        $('#txt_UserLastName').val("Hall");
        $('#txt_UserTitle').val("Owner");
        $('#txt_UserPhone').val("(810) 555-1212");
        $('#txt_UserFax').val("(810) 555-1213");
        $('#txt_UserEmail').val("andrew@digitalmedics.com");
        $('#txt_PartDescription').val("Overhead Pneumatic Lift");
        $('#txt_Quantity').val("12");
        $('#txt_LhRhUnit').val("2LH 10RH");
        $('#txt_MaxWeight').val("1 Ton");
        $('#txt_MaxHeight').val("120' " + '6"');
        $('#txt_MaxWidth').val("60' " + '6"')
        $('#txt_MaxLength').val("44' " + '2 1/4"');
        $('#txt_MaxID').val('36"');
        $('#txt_MaxOD').val('14"');
        $('#txt_MinWeight').val("900 lbs");
        $('#txt_MinHeight').val("120'");
        $('#txt_MinWidth').val("60'")
        $('#txt_MinLength').val("44'");
        $('#txt_MinID').val('36"');
        $('#txt_MinOD').val('14"');
        $('#st_oily').prop('checked', true);
        $('#st_hot').prop('checked', true);
        $('#st_textured').prop('checked', true);
        $('#st_temp').val('12,500');
        $('#process_description').val("Currently, we use a forklift that transports the part from the operator's workspace to the conveyor belt.\
\n\
We want a pneumatic moving crane to pick up and transport the part.  This process is quite tedious and a major impact to our output time.");
        $('#production_rate').val("240/Hour");
        $('#shifts').val('2 (8 Hours/shift)');
        $('#eng_pickup').val("The part will need to be picked up from a 2-shelf rack.  The rack is 8 feet long, 4 feet wide, and 10 feet tall.\n\
There's a lot of foot traffic here, so we could use a consulatation regarding the best placement for the crane.");
        $('#eng_obstructions').val("The area in which we need to engage the part is clear of any obstructions.  The amount of foot traffic is our major concern.")
        $('#part_stationary').prop('checked', true);
        $('#eng_recommended').val('We are completely unsure how to approach this.  We have a couple of ideas, but it might require us to "think outside of the box"');
        $('#eng_noTouching').val('We can engage the part in almost any way that is safe.  There are two very small sections on the left and the right that we might want to avoid, if possible.')
        $('#eng_orientation').val('The operator stands in front of the part.  The operator currently leaves the workspace, gets a forklift and transfers the part to the shelf.  All parts stay in the same direction from both the starting and ending destinations.  The parts do not rotate at all.');
        $('#eng_dimElevation').val("The part will need to be transferred upstairs on our balcony that overlooks the operator's workspace.  When set down, a single part takes up a 24Lx24Wx24H space.");
        $('#sd_location').val("The part will be set down onto a conveyor belt running at 2200rpm.  We can provide the manufacturer's manual for the belt.");
        $('#sd_moving').prop('checked', true);
        $('#sd_obstruction').val("The set-down point is completely free of any and all obstructions.  There is zero foot traffic in this area.");
        $('#sd_orientation').val("The setdown point is the conveyor belt.  The part will be picked up and not rotated and set down on the conveyor belt.");
        $('#sd_dimElevation').val("The conveyor belt is 24 inches off the ground.  The conveyor belt has an elevation handle that lets us adjust the height, so there is some margin here.");
        $('#drawings_yes').prop('checked', true);
        $('#floor_plans_yes').prop('checked', true);
        $('#machine_no').prop('checked', true);
        $('#approval_yes').prop('checked', true);
        $('#customer_reviews_yes').prop('checked', true);
        $('#customer_reviews_explain').val("Our client will have to sign off on all milestones for this project.  We can discuss milestones at the appropriate time.");
        $('#special_requirements').val("We have no special instructions for you at this time.");
    });

    //Displays the character count for the text inputs
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
    $('#btn_CopyCompanyInfo').on('click', function() {
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
    
    $('#btn_StartSurvey').on('click', function(){
        window.location.replace("./survey.php");
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