<?php

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

require 'class.ClientValue';

function check_POSTarray($Client) {
    //Checks the POST array for mandatory fields
    foreach ($Client as $array => $formField) {
        $fieldValue = $formField['Value'];
        $minLength = $formField['MinLength'];
        $maxLength = $formField['MaxLength'];
        $display = $formField['Display'];
        //Check for empty required form fields
        if ($formField['Required'] == 1 && $formField['Value'] == '') {
            //Display the field that is generating the error
            echo "Please fill in the $display to continue<br />";
        } elseif ($formField['Required'] == 1 && $formField != '') {
            //Check the values for the correct attribute requirements
            switch ($formField['Value_Type']) {
                Case "String":
                    check_string_length($fieldValue, $minLength, $maxLength, $display);
                    break;
            }
        }
    }
}

require('fpdf.php');

//Create a new Client
$Client = new Client_Value();

//TODO: 
//Validate $_POST variables
//TODO
//Add the appropriate values to the Client Class
//$Client->CompanyName['company_name'] = array(
$Client->CompanyName = array(
    'Name' => 'CompanyName',
    'Type' => 'Textbox',
    //TODO: Sanitize before passing in POST
    'Value' => $_POST['company_name'],
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 60,
    'Required' => 1,
    'Display' => 'Company Name'
);
$Client->CurrentDateTime = array(
    'Value' => date("F j, Y, g:i a"),
    'Required' => 1
);
$Client->StreetAddress = array(
    'Name' => 'StreetAddress',
    'Type' => 'Textbox',
    'Value' => $_POST['street_address'],
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 60,
    'Required' => 1,
    'Display' => 'Street Address'
);

check_POSTarray($Client);

//echo $Client->CompanyName['Value'];
//echo '<br />';
//echo '<pre>';
//print_r($Client->CompanyName);
//echo '</pre>';
//echo '<br />';
echo '<pre>';
print_r($Client);
echo '</pre>';


$email_password = $_POST['email_password'];

//Customer Variables
$company_name = $_POST['company_name'];
$company_name = check_text($company_name, 60, "Company Name");
$mydate = date("F j, Y, g:i a");
$delivery = 'Yes';
$street_address = $_POST['street_address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$title = $_POST['title'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$email = $_POST['email'];

//End User Variables
$user_company_name = $_POST['user_company_name'];
$user_street_address = $_POST['user_street_address'];
$user_city = $_POST['user_city'];
$user_state = $_POST['user_state'];
$user_zip = $_POST['user_zip'];
$user_firstName = $_POST['user_firstName'];
$user_lastName = $_POST['user_lastName'];
$user_title = $_POST['user_title'];
$user_phone = $_POST['user_phone'];
$user_fax = $_POST['user_fax'];
$user_email = $_POST['user_email'];

//Application Information
$part_description = $_POST['part_description'];
$quantity = $_POST['quantity'];
$lh_rh_unit = $_POST['lh_rh_unit'];

//Part Dimensions
$max_weight = $_POST['max_weight'];
$max_height = $_POST['max_height'];
$max_width = $_POST['max_width'];
$max_length = $_POST['max_length'];
$max_id = $_POST['max_id'];
$max_od = $_POST['max_od'];
$min_weight = $_POST['min_weight'];
$min_height = $_POST['min_height'];
$min_width = $_POST['min_width'];
$min_length = $_POST['min_length'];
$min_id = $_POST['min_id'];
$min_od = $_POST['min_od'];

//Surface Type
(isset($_POST['st_wet']) && $_POST['st_wet'] == 'Yes') ?
                $st_wet = 'Yes' : $st_wet = 'No';
(isset($_POST['st_oily']) && $_POST['st_oily'] == 'Yes') ?
                $st_oily = 'Yes' : $st_oily = 'No';
(isset($_POST['st_dry']) && $_POST['st_dry'] == 'Yes') ?
                $st_dry = 'Yes' : $st_dry = 'No';
if (isset($_POST['st_hot']) && $_POST['st_hot'] == 'Yes') {
    $st_hot = 'Yes';
    if (isset($_POST['temperature']) && $_POST['temperature'] != '') {
        $temperature = $_POST['temperature'];
        if (isset($_POST['tempScale'])) {
            $tempScale = $_POST['tempScale'];
        } else {
            $tempScale = 'Not Chosen';
        }
    } else {
        $temperature = 'No Value';
    }
} else {
    $st_hot = 'No';
    $temperature = 'No Value';
    $tempScale = 'Not Chosen';
}
(isset($_POST['st_classA']) && $_POST['st_classA'] == 'Yes') ?
                $st_classA = 'Yes' : $st_classA = 'No';
(isset($_POST['st_fragile']) && $_POST['st_fragile'] == 'Yes') ?
                $st_fragile = 'Yes' : $st_fragile = 'No';
(isset($_POST['st_textured']) && $_POST['st_textured'] == 'Yes') ?
                $st_textured = 'Yes' : $st_textured = 'No';
(isset($_POST['st_other']) && $_POST['st_other'] == 'Yes') ?
                $st_other = 'Yes' : $st_other = 'No';

//Process Description
$process_description = $_POST['process_description'];
$production_rate = $_POST['production_rate'];
$shifts = $_POST['shifts'];

//Part Engagement
$eng_pickup = $_POST['eng_pickup'];
$eng_obstructions = $_POST['eng_obstructions'];
$eng_recommended = $_POST['eng_recommended'];
$eng_noTouching = $_POST['eng_noTouching'];
$eng_orientation = $_POST['eng_orientation'];
$eng_dimElevation = $_POST['eng_dimElevation'];

class PDF extends FPDF {

// Page header
    function Header() {
        // Logo
        $this->Image('logo.png', 10, 6, 30);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(130);
        // Title
        $this->Cell(30, 10, 'Request for Quote Application', 0, 0, 'C');
        // Line break
        $this->Ln(15);
    }

}

$pdf = new PDF();
$pdf->AddPage('L');
$pdf->SetFont('Arial', '', 12);

//Cell Options
//Width | Height | Text | Border(0 or 1) | New Line(0 or 1) | Text Orientation('L', 'C', or 'R' | Background (true or false) | Link (url)
//Internal Information
$pdf->Cell(80, 10, "Salesperson: ________________________________");
//Do something like this to make black space within a line
$pdf->Cell(80);
$pdf->cell(115, 10, "Request #: _________________________________", 0, 0, 'R');
$pdf->Ln(15);
$pdf->Cell(70, 10, "Customer Information", 'B', 0, 'L');
$pdf->Cell(15, 10, '', 'B');
$pdf->cell(85, 10, "Date: $mydate", 'B', 0, 'C');
$pdf->cell(30, 10, '', 'B');
$pdf->cell(75, 10, "Delivery Requested: $delivery", 'B', 0, 'L');
$pdf->Ln(15);
//Customer Information
//Get current x and y to make Multicells span the same line
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->MultiCell(80, 5, ""
        . "$company_name\n"
        . "$street_address\n"
        . "$city, $state, $zip");

$pdf->SetXY($x + 95, $y);
$pdf->MultiCell(80, 5, "Contact:\n"
        . "$firstName $lastName\n\n"
        . "Title:\n"
        . "$title");
$pdf->SetXY($x + 200, $y);
$pdf->MultiCell(80, 5, "Phone:\n"
        . "$phone\n"
        . "Fax:\n"
        . "$fax\n"
        . "Email:\n"
        . "$email");
$pdf->Ln(10);
//End User Information
$pdf->Cell(275, 10, "End User Information", 'B', 0, 'L');
$pdf->Ln(15);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->MultiCell(80, 5, ""
        . "$user_company_name\n"
        . "$user_street_address\n"
        . "$user_city, $user_state, $user_zip");

$pdf->SetXY($x + 95, $y);
$pdf->MultiCell(80, 5, "Contact:\n"
        . "$user_firstName $user_lastName\n\n"
        . "Title:\n"
        . "$user_title");
$pdf->SetXY($x + 200, $y);
$pdf->MultiCell(80, 5, "Phone:\n"
        . "$user_phone\n"
        . "Fax:\n"
        . "$user_fax\n"
        . "Email:\n"
        . "$user_email");
$pdf->Ln();
$pdf->Cell(275, 10, "Application Information", 'B', 0, 'L');
$pdf->Ln(10);
$pdf->MultiCell(275, 5, "Part Description:\n"
        . "$part_description");
$pdf->Ln(10);
$pdf->cell(80, 10, "Quantity Required: $quantity");
$pdf->cell(20);
$pdf->cell(80, 10, "LH/RH Units: $lh_rh_unit");
$pdf->Ln();
//Part Dimensions
$pdf->cell(275, 10, 'Part Dimensions', 'B');
$pdf->Ln(20);
$pdf->cell(40);
$pdf->cell(40, 10, 'Weight', 1, 0, 'C');
$pdf->cell(40, 10, 'Height', 1, 0, 'C');
$pdf->cell(40, 10, 'Width', 1, 0, 'C');
$pdf->cell(40, 10, 'Length', 1, 0, 'C');
$pdf->cell(40, 10, 'Inner Dimensions', 1, 0, 'C');
$pdf->cell(40, 10, 'Outer Dimensions', 1, 0, 'C');
$pdf->Ln(10);
$pdf->cell(40, 10, 'Maximum', 1);
$pdf->cell(40, 10, $max_weight, 1);
$pdf->cell(40, 10, $max_height, 1);
$pdf->cell(40, 10, $max_width, 1);
$pdf->cell(40, 10, $max_length, 1);
$pdf->cell(40, 10, $max_id, 1);
$pdf->cell(40, 10, $max_od, 1);
$pdf->Ln(10);
$pdf->cell(40, 10, 'Minimum', 1);
$pdf->cell(40, 10, $min_weight, 1);
$pdf->cell(40, 10, $min_height, 1);
$pdf->cell(40, 10, $min_width, 1);
$pdf->cell(40, 10, $min_length, 1);
$pdf->cell(40, 10, $min_id, 1);
$pdf->cell(40, 10, $min_od, 1);
$pdf->Ln(10);
$pdf->cell(275, 10, "***Please indicate a separate sheet for additional parts if necessary***", 0, 0, 'C');
$pdf->Ln(10);
$pdf->cell(275, 10, "Part Surface", 'B', 0, 'L');
$pdf->Ln(10);
$pdf->cell(40, 10, "Wet: $st_wet");
$pdf->cell(60);
$pdf->cell(40, 10, "Hot: $st_hot");
$pdf->cell(60);
$pdf->cell(40, 10, "Class A: $st_classA");
$pdf->Ln(5);
$pdf->cell(40, 10, "Dry: $st_dry");
$pdf->cell(60);
$pdf->cell(40, 10, "Temperature: $temperature");
$pdf->cell(60);
$pdf->cell(40, 10, "Textured: $st_textured");
$pdf->Ln(5);
$pdf->cell(40, 10, "Oily: $st_oily");
$pdf->cell(60);
$pdf->cell(40, 10, "Scale: $tempScale");
$pdf->cell(60);
$pdf->cell(40, 10, "Fragile: $st_fragile");
$pdf->Ln(15);
$pdf->cell(275, 10, "Description of Current Process or Sequence of Operations:");
$pdf->Ln(10);
$pdf->MultiCell(275, 10, $process_description, 1);
$pdf->Ln(10);
$pdf->cell(275, 10, "Production Rate (Cycles/Hour): $production_rate");
$pdf->Ln(5);
$pdf->cell(275, 10, "Shifts/Day: $shifts");
$pdf->Ln(20);
$pdf->Cell(275, 10, "Application Information", 'B', 0, 'L');
$pdf->Ln(15);
$pdf->MultiCell(275, 5, "What is the part being picked up from?");
$pdf->Ln(5);
$pdf->MultiCell(275, 10, $eng_pickup, 1);
$pdf->Ln(5);
$pdf->MultiCell(275, 5, "Please list any obstructions that may interfere with engaging the part:");
$pdf->Ln(5);
$pdf->MultiCell(275, 10, $eng_obstructions, 1);
$pdf->Ln(5);
//Moving or Stationary?
//Placeholder
$pdf->MultiCell(275, 5, "Recommended area to engage on the part:");
$pdf->Ln(5);
$pdf->MultiCell(275, 10, $eng_recommended, 1);
$pdf->Ln(5);
$pdf->MultiCell(275, 5, "Areas of the part that cannot be touched:");
$pdf->Ln(5);
$pdf->MultiCell(275, 10, $eng_noTouching, 1);
$pdf->Ln(5);
$pdf->MultiCell(275, 5, "Operator's perspective of part orientation:");
$pdf->Ln(5);
$pdf->MultiCell(275, 10, $eng_orientation, 1);
$pdf->Ln(5);
$pdf->MultiCell(275, 5, "Dimensional elevation of part at set down:");
$pdf->Ln(5);
$pdf->MultiCell(275, 10, $eng_dimElevation, 1);
$pdf->Ln(5);



////Create an email attachment
//$attachment = $pdf->Output('attachment.pdf', 'S');
////Attach the PDF and send an email
//email_pdf($attachment, $email_password);
//Output the PDF to the browser window
$pdf->Output();

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
