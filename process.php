<?php

require 'class.ClientValue';

class error_action {

    public $e_type;
    public $e_message;

    function process_error($e_type, $e_message) {
        $e_type = $this->e_type;
        $e_message = $this->e_message;

        if ($e_type == "Error_Continue") {
            
        } elseif ($e_type == "Error_Halt") {
            
        }
    }

}

function check_ClientArray($Client) {
    //Checks the POST array for mandatory fields
    //Gather the individual form fields within the Client object
    foreach ($Client as $array => $formField) {
        //Get the values from the Client Object
        $value = $formField['Value'];
        if (isset($formField['MinLength'])) {
            $minLength = $formField['MinLength'];
        }
        if (isset($formField['MaxLength'])) {
            $maxLength = $formField['MaxLength'];
        }
        $display = $formField['Display'];
        $required = $formField['Required'];
        $valueType = $formField['Value_Type'];

        //Check for empty required form fields
        if ($required == 1 && $value == '') {
            //Display the field that is generating the error
            echo "Please fill in the $display to continue<br />";
        } elseif ($required == 1 && $value != '') {
            //Check the values for the correct attribute requirements
            switch ($valueType) {
                Case "String":
                    check_string_length($value, $minLength, $maxLength, $display);
                    break;
            }
        }
    }
}

//Create a new Client
$email_password = $_POST['email_password'];
$Client = new Client_Value();

//Add the appropriate values to the Client Class
$Client->CurrentDateTime = array(
    'Value' => date("F j, Y, g:i a"),
    'Value_Type' => 'Date',
    'MinLength' => 0,
    'MaxLength' => 60,
    'Required' => 1,
    'Display' => 'Date'
);
//Company Variables
$Client->CompanyName = array(
    'Name' => 'CompanyName',
    'Type' => 'Textbox',
    //TODO: Sanitize before passing in POST
    'Value' => (string) $_POST['company_name'],
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 60,
    'Required' => 1,
    'Display' => 'Company Name'
);
$Client->Delivery = array(
    'Name' => 'Delivery',
    'Type' => 'Radio',
    'Value' => 'Yes',
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 3,
    'Required' => 1,
    'Display' => 'Delivery'
);
$Client->StreetAddress = array(
    'Name' => 'StreetAddress',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['street_address'],
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 60,
    'Required' => 1,
    'Display' => 'Street Address'
);
$Client->City = array(
    'Name' => 'City',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['city'],
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 28,
    'Required' => 1,
    'Display' => 'City'
);
$Client->State = array(
    'Name' => 'State',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['state'],
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 2,
    'Required' => 1,
    'Display' => 'State'
);
$Client->Zip = array(
    'Name' => 'Zip',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['zip'],
    'Value_Type' => 'String',
    'MinLength' => 5,
    'MaxLength' => 5,
    'Required' => 1,
    'Display' => 'Zip'
);
$Client->FirstName = array(
    'Name' => 'FirstName',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['firstName'],
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 28,
    'Required' => 1,
    'Display' => 'First Name'
);
$Client->LastName = array(
    'Name' => 'LastName',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['lastName'],
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 28,
    'Required' => 1,
    'Display' => 'Last Name'
);
$Client->Title = array(
    'Name' => 'Title',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['title'],
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'Title'
);
$Client->Phone = array(
    'Name' => 'Phone',
    'Type' => 'Textbox',
    //Strip all the symbols and whitespaces the phone number
    'Value' => preg_replace('/(\W*)/', '', trim($_POST['phone'])),
    'Value_Type' => 'String',
    'MinLength' => 10,
    'MaxLength' => 10,
    'Required' => 1,
    'Display' => 'Phone'
);
$Client->Fax = array(
    'Name' => 'Fax',
    'Type' => 'Textbox',
    'Value' => preg_replace('/(\W*)/', '', trim($_POST['fax'])),
    'Value_Type' => 'String',
    'MinLength' => 14,
    'MaxLength' => 14,
    'Required' => 0,
    'Display' => 'Fax'
);
$Client->Email = array(
    'Name' => 'Email',
    'Type' => 'Textbox',
    'Value' => trim($_POST['email']),
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'Email'
);

//User Variables
$Client->UserCompanyName = array(
    'Name' => 'UserCompanyName',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['user_company_name'],
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'End User Company Name'
);
$Client->UserStreetAddress = array(
    'Name' => 'UserStreetAddress',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['user_street_address'],
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'End User Street Address'
);
$Client->UserCity = array(
    'Name' => 'UserCity',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['user_city'],
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 28,
    'Required' => 0,
    'Display' => 'End User City'
);
$Client->UserState = array(
    'Name' => 'UserState',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['user_state'],
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 2,
    'Required' => 0,
    'Display' => 'End User State'
);
$Client->UserZip = array(
    'Name' => 'UserZip',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['user_zip'],
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 5,
    'Required' => 0,
    'Display' => 'End User Zip'
);
$Client->UserFirstName = array(
    'Name' => 'UserFirstName',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['user_firstName'],
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 28,
    'Required' => 0,
    'Display' => 'End User First Name'
);
$Client->UserLastName = array(
    'Name' => 'UserLastName',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['user_lastName'],
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 28,
    'Required' => 0,
    'Display' => 'End User Last Name'
);
$Client->UserTitle = array(
    'Name' => 'UserTitle',
    'Type' => 'Textbox',
    'Value' => (string) $_POST['user_title'],
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'End User Title'
);
$Client->UserPhone = array(
    'Name' => 'UserPhone',
    'Type' => 'Textbox',
    'Value' => preg_replace('/(\W*)/', '', trim($_POST['user_phone'])),
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 14,
    'Required' => 0,
    'Display' => 'Phone'
);
$Client->UserFax = array(
    'Name' => 'UserFax',
    'Type' => 'Textbox',
    'Value' => preg_replace('/(\W*)/', '', trim($_POST['user_fax'])),
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 14,
    'Required' => 0,
    'Display' => 'End User Fax'
);
$Client->UserEmail = array(
    'Name' => 'UserEmail',
    'Type' => 'Textbox',
    'Value' => trim($_POST['user_email']),
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'End User Email'
);

//Application Information
$Client->PartDescription = array(
    'Name' => 'PartDescription',
    'Type' => 'Textbox',
    //Clear whitespace before and after
    'Value' => trim($_POST['part_description']),
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 124,
    'Required' => 1,
    'Display' => 'Part Description'
);
$Client->Quantity = array(
    'Name' => 'Quantity',
    'Type' => 'Textbox',
    'Value' => trim($_POST['quantity']),
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'Quantity Required'
);
$Client->LhRhUnit = array(
    'Name' => 'LhRhUnit',
    'Type' => 'Textbox',
    'Value' => trim($_POST['lh_rh_unit']),
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'Left Hand / Right Hand Units Required'
);

//echo $Client->Phone['Value'];
//echo preg_replace('/(\W*)/', '', $Client->Phone['Value']);
//Validate the array values
check_ClientArray($Client);

////Create an email attachment
//$attachment = $Client->pdf_attach();
////Attach the PDF and send an email
//email_pdf($attachment, $email_password);
//Output the PDF to a browser window
$Client->pdf_output();

//
////Application Information
//$part_description = $_POST['part_description'];
//$quantity = $_POST['quantity'];
//$lh_rh_unit = $_POST['lh_rh_unit'];
//
////Part Dimensions
//$max_weight = $_POST['max_weight'];
//$max_height = $_POST['max_height'];
//$max_width = $_POST['max_width'];
//$max_length = $_POST['max_length'];
//$max_id = $_POST['max_id'];
//$max_od = $_POST['max_od'];
//$min_weight = $_POST['min_weight'];
//$min_height = $_POST['min_height'];
//$min_width = $_POST['min_width'];
//$min_length = $_POST['min_length'];
//$min_id = $_POST['min_id'];
//$min_od = $_POST['min_od'];
//
////Surface Type
//(isset($_POST['st_wet']) && $_POST['st_wet'] == 'Yes') ?
//                $st_wet = 'Yes' : $st_wet = 'No';
//(isset($_POST['st_oily']) && $_POST['st_oily'] == 'Yes') ?
//                $st_oily = 'Yes' : $st_oily = 'No';
//(isset($_POST['st_dry']) && $_POST['st_dry'] == 'Yes') ?
//                $st_dry = 'Yes' : $st_dry = 'No';
//if (isset($_POST['st_hot']) && $_POST['st_hot'] == 'Yes') {
//    $st_hot = 'Yes';
//    if (isset($_POST['temperature']) && $_POST['temperature'] != '') {
//        $temperature = $_POST['temperature'];
//        if (isset($_POST['tempScale'])) {
//            $tempScale = $_POST['tempScale'];
//        } else {
//            $tempScale = 'Not Chosen';
//        }
//    } else {
//        $temperature = 'No Value';
//    }
//} else {
//    $st_hot = 'No';
//    $temperature = 'No Value';
//    $tempScale = 'Not Chosen';
//}
//(isset($_POST['st_classA']) && $_POST['st_classA'] == 'Yes') ?
//                $st_classA = 'Yes' : $st_classA = 'No';
//(isset($_POST['st_fragile']) && $_POST['st_fragile'] == 'Yes') ?
//                $st_fragile = 'Yes' : $st_fragile = 'No';
//(isset($_POST['st_textured']) && $_POST['st_textured'] == 'Yes') ?
//                $st_textured = 'Yes' : $st_textured = 'No';
//(isset($_POST['st_other']) && $_POST['st_other'] == 'Yes') ?
//                $st_other = 'Yes' : $st_other = 'No';
//
////Process Description
//$process_description = $_POST['process_description'];
//$production_rate = $_POST['production_rate'];
//$shifts = $_POST['shifts'];
//
////Part Engagement
//$eng_pickup = $_POST['eng_pickup'];
//$eng_obstructions = $_POST['eng_obstructions'];
//$eng_recommended = $_POST['eng_recommended'];
//$eng_noTouching = $_POST['eng_noTouching'];
//$eng_orientation = $_POST['eng_orientation'];
//$eng_dimElevation = $_POST['eng_dimElevation'];

function email_pdf($attachment, $email_password) {
    try {
        include 'class.phpmailer.php';
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = 'will@willdavis.net';
        $mail->Password = $email_password;
        $mail->SetFrom('will@willdavis.net');
        $mail->Subject = "Test Subject";
        $mail->Body = "Test Body";
        $mail->AddAddress('will@willdavis.net');
        $mail->AddStringAttachment($attachment, 'attachment.pdf');
        $mail->Send();
    } catch (Exception $e) {
        db_errorHandler($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
    }
    return;
}

function check_string_length($string, $minLength, $maxLength, $display) {
    $cleaned_string = '';
    //Remove spaces before and after
    $cleaned_string = trim($string);
    //Make sure the string is less than the maximum allowed length
    if ((strlen($cleaned_string) < $minLength) || strlen($cleaned_string) > $maxLength) {
        die("$display should be between $minLength and $maxLength characters");
    }
    return $cleaned_string;
}
