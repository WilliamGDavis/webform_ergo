<?php

require './scripts/class.ClientValue';
require './scripts/functions.php';

//Make sure the form was submitted using the POST method
//If a user reloads this file, they will get nothing but the 'die' message
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Press the BACK button on your browser to proceed.");
}

//Set the timezone within the script
date_default_timezone_set('America/Detroit');

//Check for mandatory variables within POST array
$CompanyName = check_post_mandatory(true, 'company_name', 'CompanyName', 'Company Name');
$FirstName = check_post_mandatory(true, 'firstName', 'FirstName', 'First Name');
$LastName = check_post_mandatory(true, 'lastName', 'LastName', 'Last Name');
$Phone = check_post_mandatory(true, 'phone', 'Phone', 'Phone');
$Email = check_post_mandatory(true, 'email', 'Email', 'Email');
$PartDescription = check_post_mandatory(true, 'part_description', 'PartDescription', 'Part Description');

//Check for non-mandatory variables within the POST array
$StreetAddress = check_post_mandatory(false, 'street_address', 'StreetAddress', 'Street Address');
$City = check_post_mandatory(false, 'city', 'City', 'City');
$State = check_post_mandatory(false, 'state', 'State', 'State');
$Zip = check_post_mandatory(false, 'zip', 'Zip', 'Zip');
$Title = check_post_mandatory(false, 'title', 'Title', 'Title');
$Fax = check_post_mandatory(false, 'fax', 'Fax', 'Fax');
$UserCompanyName = check_post_mandatory(false, 'user_company_name', 'UserCompanyName', 'End User Company Name');
$UserStreetAddress = check_post_mandatory(false, 'user_street_address', 'UserStreetAddress', 'End User Street Address');
$UserCity = check_post_mandatory(false, 'user_city', 'UserState', 'End User State');
$UserState = check_post_mandatory(false, 'user_state', 'UserState', 'End User State');
$UserZip = check_post_mandatory(false, 'user_zip', 'UserZip', 'End User Zip');
$UserFirstName = check_post_mandatory(false, 'user_firstName', 'UserFirstName', 'End User First Name');
$UserLastName = check_post_mandatory(false, 'user_lastName', 'UserLastName', 'End User Last Name');
$UserTitle = check_post_mandatory(false, 'user_title', 'UserTitle', 'End User Title');
$UserPhone = check_post_mandatory(false, 'user_phone', 'UserPhone', 'End User Phone');
$UserFax = check_post_mandatory(false, 'user_fax', 'UserFax', 'End User Fax');
$UserEmail = check_post_mandatory(false, 'user_email', 'UserEmail', 'End User Email');
$Quantity = check_post_mandatory(false, 'quantity', 'Quantity', 'Quantity');
$MaxWeight = check_post_mandatory(false, 'max_weight', 'MaxWeight', 'Maximim Weight');
$MaxHeight = check_post_mandatory(false, 'max_height', 'MaxHeight', 'Maximim Height');
$MaxWidth = check_post_mandatory(false, 'max_width', 'MaxWidth', 'Maximim Width');
$MaxLength = check_post_mandatory(false, 'max_length', 'MaxLength', 'Maximim Length');
$MaxID = check_post_mandatory(false, 'max_id', 'MaxID', 'Maximim Inner Dimension');
$MaxOD = check_post_mandatory(false, 'max_od', 'MaxOD', 'Maximim Outer Dimension');
$MinWeight = check_post_mandatory(false, 'min_weight', 'MinWeight', 'Minimim Weight');
$MinHeight = check_post_mandatory(false, 'min_height', 'MinHeight', 'Minimim Height');
$MinWidth = check_post_mandatory(false, 'min_width', 'MinWidth', 'Minimim Width');
$MinLength = check_post_mandatory(false, 'min_length', 'MinLength', 'Minimim Length');
$MinID = check_post_mandatory(false, 'min_id', 'MinID', 'Minimim Inner Dimension');
$MinOD = check_post_mandatory(false, 'min_od', 'MinOD', 'Minimim Outer Dimension');
$STTemp = check_post_mandatory(false, 'st_temp', 'STTemp', 'Surface Temperature');
$ProcessDescription = check_post_mandatory(false, 'process_description', 'ProcessDescription', 'Process Description');
$ProductionRate = check_post_mandatory(false, 'production_rate', 'ProductionRate', 'Production Rate');
$Shifts = check_post_mandatory(false, 'shifts', 'Shifts', 'Shifts');
$EngPickup = check_post_mandatory(false, 'eng_pickup', 'EngPickup', 'Part Pickup');
$EngObstructions = check_post_mandatory(false, 'eng_obstructions', 'EngObstructions', 'Obstructions');
$EngRecommended = check_post_mandatory(false, 'eng_recommended', 'EngRecommended', 'Recommendations');
$EngNoTouching = check_post_mandatory(false, 'eng_noTouching', 'EngNoTouching', 'Cannot Touch');
$EngOrientation = check_post_mandatory(false, 'eng_orientation', 'EngOrientation', 'Orientation');
$EngDimElevation = check_post_mandatory(false, 'eng_dimElevation', 'EngDimElevation', 'Dimensional Elevation');
$CraneExplain = check_post_mandatory(false, 'crane_explain', 'CraneExplain', 'Please Explain the Above');
$PSI = check_post_mandatory(false, 'psi', 'PSI', 'PSI');
$OtherPowerSource = check_post_mandatory(false, 'other_power_source', 'OtherPowerSource', 'Other Power Source');
$Environment = check_post_mandatory(false, 'txt_environment', 'Environment', 'Environment');
$ElevationHeader = check_post_mandatory(false, 'elevation_header', 'ElevationHeader', 'ElevationHeader');
$SDLocation = check_post_mandatory(false, 'sd_location', 'SDOther', 'Set Down - Other');
$SDObstruction = check_post_mandatory(false, 'sd_obstruction', 'SDObstruction', 'Set Down - Obstruction');
$SDOrientation = check_post_mandatory(false, 'sd_orientation', 'SDOrientation', 'Set Down - Orientation');
$SDDimElevation = check_post_mandatory(false, 'sd_dimElevation', 'SDDimElevation', 'Set Down - Dimensional Elevation');
$SpecialRequirements = check_post_mandatory(false, 'special_requirements', 'SpecialRequirements', 'Special Requirements');
$Budget = check_post_mandatory(false, 'budgetary_numbers', 'Budget', 'Budget');

//Checkbox Variables
$STWet = check_checkboxes('st_wet', 'STWet');
$STOily = check_checkboxes('st_oily', 'STOily');
$STDry = check_checkboxes('st_dry', 'STDry');
$STHot = check_checkboxes('st_hot', 'STHot');
$STClassA = check_checkboxes('st_classA', 'STClassA');
$STFragile = check_checkboxes('st_fragile', 'STFragile');
$STTextured = check_checkboxes('st_textured', 'STTextured');
$STOther = check_checkboxes('st_other', 'STOther');

//Check Radio Buttons
$STTempScale = check_radio('st_temp_scale', 'STTempScale');
$EngMovement = check_radio('eng_movement', 'EngMovement');
$SDMovement = check_radio('sd_movement', 'SDMovement');
$FMA = check_radio('fma', 'FloorMountedArm');
$XYRailSystem = check_radio('xyrail', 'XYRailSystem');
$JibCrane = check_radio('jibcrane', 'JibCrane');
$ElevationDrawings = check_radio('elevation_drawings', 'ElevationDrawings');
$PlantDrawings = check_radio('plant_drawings', 'PlantDrawings');
$RackProvided = check_radio('rack_provided', 'RackProvided');
$DrawingsProvided = check_radio('drawings_provided', 'DrawingsProvided');
$FloorPlansProvided = check_radio('floor_plans_provided', 'FloorPlansProvided');
$MachineProvided = check_radio('machine_provided', 'MachineProvided');
$PhotoVideoProvided = check_radio('photo_video_provided', 'PhotoVideoProvided');
$ApprovalProvided = check_radio('approval_provided', 'ApprovalProvided');
$Installation = check_radio('installation', 'Installation');
$CustomerReviews = check_radio('customer_reviews', 'CustomerReviews');
$CustomerReviewsExplain = check_radio('customer_reviews_explain', 'CustomerReviewsExplain');
$CustomerPaper = check_radio('customer_paper', 'CustomerPaper');

//Create a new Client Object
$Client = new Client_Value();

//Add the appropriate values to the Client Object
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
    'Value' => $CompanyName,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 60,
    'Required' => 1,
    'Display' => 'Company Name'
);
$Client->Delivery = array(
    'Name' => 'Delivery',
    'Type' => 'Radio',
    'Value' => 'XXX',
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 3,
    'Required' => 1,
    'Display' => 'Delivery'
);
$Client->StreetAddress = array(
    'Name' => 'StreetAddress',
    'Type' => 'Textbox',
    'Value' => $StreetAddress,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'Street Address'
);
$Client->City = array(
    'Name' => 'City',
    'Type' => 'Textbox',
    'Value' => $City,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 28,
    'Required' => 0,
    'Display' => 'City'
);
$Client->State = array(
    'Name' => 'State',
    'Type' => 'Textbox',
    'Value' => $State,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 2,
    'Required' => 0,
    'Display' => 'State'
);
$Client->Zip = array(
    'Name' => 'Zip',
    'Type' => 'Textbox',
    'Value' => $Zip,
    'Value_Type' => 'String',
    'MinLength' => 5,
    'MaxLength' => 5,
    'Required' => 0,
    'Display' => 'Zip'
);
$Client->FirstName = array(
    'Name' => 'FirstName',
    'Type' => 'Textbox',
    'Value' => $FirstName,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 28,
    'Required' => 1,
    'Display' => 'First Name'
);
$Client->LastName = array(
    'Name' => 'LastName',
    'Type' => 'Textbox',
    'Value' => $LastName,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 28,
    'Required' => 1,
    'Display' => 'Last Name'
);
$Client->Title = array(
    'Name' => 'Title',
    'Type' => 'Textbox',
    'Value' => $Title,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'Title'
);
$Client->Phone = array(
    'Name' => 'Phone',
    'Type' => 'Textbox',
    //Strip all the symbols and whitespaces the phone number
    'Value' => preg_replace('/(\W*)/', '', $Phone),
    'Value_Type' => 'String',
    'MinLength' => 10,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Phone'
);
$Client->Fax = array(
    'Name' => 'Fax',
    'Type' => 'Textbox',
    'Value' => preg_replace('/(\W*)/', '', $Fax),
    'Value_Type' => 'String',
    'MinLength' => 10,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Fax'
);
$Client->Email = array(
    'Name' => 'Email',
    'Type' => 'Textbox',
    'Value' => $Email,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'Email'
);

//User Variables
$Client->UserCompanyName = array(
    'Name' => 'UserCompanyName',
    'Type' => 'Textbox',
    'Value' => $UserCompanyName,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'End User Company Name'
);
$Client->UserStreetAddress = array(
    'Name' => 'UserStreetAddress',
    'Type' => 'Textbox',
    'Value' => $UserStreetAddress,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'End User Street Address'
);
$Client->UserCity = array(
    'Name' => 'UserCity',
    'Type' => 'Textbox',
    'Value' => $UserCity,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 28,
    'Required' => 0,
    'Display' => 'End User City'
);
$Client->UserState = array(
    'Name' => 'UserState',
    'Type' => 'Textbox',
    'Value' => $UserState,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 2,
    'Required' => 0,
    'Display' => 'End User State'
);
$Client->UserZip = array(
    'Name' => 'UserZip',
    'Type' => 'Textbox',
    'Value' => $UserZip,
    'Value_Type' => 'String',
    'MinLength' => 5,
    'MaxLength' => 5,
    'Required' => 0,
    'Display' => 'End User Zip'
);
$Client->UserFirstName = array(
    'Name' => 'UserFirstName',
    'Type' => 'Textbox',
    'Value' => $UserFirstName,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 28,
    'Required' => 0,
    'Display' => 'End User First Name'
);
$Client->UserLastName = array(
    'Name' => 'UserLastName',
    'Type' => 'Textbox',
    'Value' => $UserLastName,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 28,
    'Required' => 0,
    'Display' => 'End User Last Name'
);
$Client->UserTitle = array(
    'Name' => 'UserTitle',
    'Type' => 'Textbox',
    'Value' => $UserTitle,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'End User Title'
);
$Client->UserPhone = array(
    'Name' => 'UserPhone',
    'Type' => 'Textbox',
    'Value' => preg_replace('/(\W*)/', '', $UserPhone),
    'Value_Type' => 'String',
    'MinLength' => 10,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Phone'
);
$Client->UserFax = array(
    'Name' => 'UserFax',
    'Type' => 'Textbox',
    'Value' => preg_replace('/(\W*)/', '', $UserFax),
    'Value_Type' => 'String',
    'MinLength' => 10,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'End User Fax'
);
$Client->UserEmail = array(
    'Name' => 'UserEmail',
    'Type' => 'Textbox',
    'Value' => $UserEmail,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'End User Email'
);

//Application Information
$Client->PartDescription = array(
    'Name' => 'PartDescription',
    'Type' => 'Textbox',
    //Clear whitespace before and after
    'Value' => $PartDescription,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 124,
    'Required' => 1,
    'Display' => 'Part Description'
);
$Client->Quantity = array(
    'Name' => 'Quantity',
    'Type' => 'Textbox',
    'Value' => $Quantity,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 60,
    'Required' => 0,
    'Display' => 'Quantity Required'
);

//Part Dimensions
$Client->MaxWeight = array(
    'Name' => 'MaxWeight',
    'Type' => 'Textbox',
    'Value' => $MaxWeight,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Maximum Weight'
);
$Client->MaxHeight = array(
    'Name' => 'MaxHeight',
    'Type' => 'Textbox',
    'Value' => $MaxHeight,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Maximum Height'
);
$Client->MaxWidth = array(
    'Name' => 'MaxWidth',
    'Type' => 'Textbox',
    'Value' => $MaxWidth,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Maximum Width'
);
$Client->MaxLength = array(
    'Name' => 'MaxLength',
    'Type' => 'Textbox',
    'Value' => $MaxLength,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Maximum Length'
);
$Client->MaxID = array(
    'Name' => 'MaxID',
    'Type' => 'Textbox',
    'Value' => $MaxID,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Maximum Inner Dimension (ID)'
);
$Client->MaxOD = array(
    'Name' => 'MaxOD',
    'Type' => 'Textbox',
    'Value' => $MaxOD,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Maximum Outer Dimensions (OD)'
);
$Client->MinWeight = array(
    'Name' => 'MinWeight',
    'Type' => 'Textbox',
    'Value' => $MinWeight,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Minimum Weight'
);
$Client->MinHeight = array(
    'Name' => 'MinHeight',
    'Type' => 'Textbox',
    'Value' => $MinHeight,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Minimum Height'
);
$Client->MinWidth = array(
    'Name' => 'MinWidth',
    'Type' => 'Textbox',
    'Value' => $MinWidth,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Miniimum Width'
);
$Client->MinLength = array(
    'Name' => 'MinLength',
    'Type' => 'Textbox',
    'Value' => $MinLength,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Minimum Length'
);
$Client->MinID = array(
    'Name' => 'MinID',
    'Type' => 'Textbox',
    'Value' => $MinID,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Minimum Inner Dimension (ID)'
);
$Client->MinOD = array(
    'Name' => 'MinOD',
    'Type' => 'Textbox',
    'Value' => $MinOD,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Minimum Outer Dimensions (OD)'
);

//Surface Type
$Client->STWet = array(
    'Name' => 'STWet',
    'Type' => 'Checkbox',
    'Value' => $STWet,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 3,
    'Required' => 0,
    'Display' => 'Surface Type (Wet)'
);
$Client->STOily = array(
    'Name' => 'STOily',
    'Type' => 'Checkbox',
    'Value' => $STOily,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 3,
    'Required' => 0,
    'Display' => 'Surface Type (Oily)'
);
$Client->STDry = array(
    'Name' => 'STDry',
    'Type' => 'Checkbox',
    'Value' => $STDry,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 3,
    'Required' => 0,
    'Display' => 'Surface Type (Dry)'
);
$Client->STHot = array(
    'Name' => 'STHot',
    'Type' => 'Checkbox',
    'Value' => $STHot,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 3,
    'Required' => 0,
    'Display' => 'Surface Type (Hot)',
    'Temperature' => $STTemp,
    'TemperatureScale' => $STTempScale
);
$Client->STWet = array(
    'Name' => 'STWet',
    'Type' => 'Checkbox',
    'Value' => $STWet,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 3,
    'Required' => 0,
    'Display' => 'Surface Type (Wet)'
);
$Client->STClassA = array(
    'Name' => 'STClassA',
    'Type' => 'Checkbox',
    'Value' => $STClassA,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 3,
    'Required' => 0,
    'Display' => 'Surface Type (Class A)'
);
$Client->STFragile = array(
    'Name' => 'STFragile',
    'Type' => 'Checkbox',
    'Value' => $STFragile,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 3,
    'Required' => 0,
    'Display' => 'Surface Type (Fragile)'
);
$Client->STTextured = array(
    'Name' => 'STTextured',
    'Type' => 'Checkbox',
    'Value' => $STTextured,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 3,
    'Required' => 0,
    'Display' => 'Surface Type (Textured)'
);
$Client->STOther = array(
    'Name' => 'STOther',
    'Type' => 'Checkbox',
    'Value' => $STOther,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 3,
    'Required' => 0,
    'Display' => 'Surface Type (Other)'
);

// Current Process
$Client->ProcessDescription = array(
    'Name' => 'ProcessDescription',
    'Type' => 'Textbox',
    'Value' => $ProcessDescription,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Process Description'
);
$Client->ProductionRate = array(
    'Name' => 'ProductionRate',
    'Type' => 'Textbox',
    'Value' => $ProductionRate,
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 28,
    'Required' => 0,
    'Display' => 'Production Rate (Cycles/Hour)'
);
$Client->Shifts = array(
    'Name' => 'Shifts',
    'Type' => 'Textbox',
    'Value' => $Shifts,
    'Value_Type' => 'String',
    'MinLength' => 0,
    'MaxLength' => 28,
    'Required' => 0,
    'Display' => 'Shifts per Day'
);

//Part Engagement
$Client->EngPickup = array(
    'Name' => 'EngPickup',
    'Type' => 'Textbox',
    'Value' => $EngPickup,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Pickup'
);
$Client->EngObstructions = array(
    'Name' => 'EngObstructions',
    'Type' => 'Textbox',
    'Value' => $EngObstructions,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Obstructions'
);
$Client->EngMovement = array(
    'Name' => 'EngMovement',
    'Type' => 'Radio',
    'Value' => $EngMovement,
    'Value_Type' => 'String',
    'MinLength' => 6,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Movement'
);
$Client->EngRecommended = array(
    'Name' => 'EngRecommended',
    'Type' => 'Textbox',
    'Value' => $EngRecommended,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Recommended'
);
$Client->EngNoTouching = array(
    'Name' => 'EngNoTouching',
    'Type' => 'Textbox',
    'Value' => $EngNoTouching,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'No Touching'
);
$Client->EngOrientation = array(
    'Name' => 'EngOrientation',
    'Type' => 'Textbox',
    'Value' => $EngOrientation,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Orientation'
);
$Client->EngDimElevation = array(
    'Name' => 'EngDimElevation',
    'Type' => 'Textbox',
    'Value' => $EngDimElevation,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Dimensional Elevation'
);

// Part Set Down
$Client->SDLocation = array(
    'Name' => 'SDLocation',
    'Type' => 'Textbox',
    'Value' => $SDLocation,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Set Down Location'
);
$Client->SDMovement = array(
    'Name' => 'SDMovement',
    'Type' => 'Textbox',
    'Value' => $SDMovement,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Set Down Movement'
);
$Client->SDObstruction = array(
    'Name' => 'SDObstruction',
    'Type' => 'Textbox',
    'Value' => $SDObstruction,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Set Down Obstructions'
);
$Client->SDOrientation = array(
    'Name' => 'SDOrientation',
    'Type' => 'Textbox',
    'Value' => $SDOrientation,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Set Down Orientation'
);
$Client->SDDimElevation = array(
    'Name' => 'SDDimElevation',
    'Type' => 'Textbox',
    'Value' => $SDDimElevation,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Set Down Dimensional Elevation'
);

//Monorail and/or Crane Systems
$Client->FloorMountedArm = array(
    'Name' => 'FloorMountedArm',
    'Type' => 'Radio',
    'Value' => $FMA,
    'Value_Type' => 'String',
    'MinLength' => 6,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Floor Mounted Arm'
);
$Client->XYRailSystem = array(
    'Name' => 'XYRailSystem',
    'Type' => 'Radio',
    'Value' => $XYRailSystem,
    'Value_Type' => 'String',
    'MinLength' => 6,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'XY Rail System'
);
$Client->JibCrane = array(
    'Name' => 'JibCrane',
    'Type' => 'Radio',
    'Value' => $JibCrane,
    'Value_Type' => 'String',
    'MinLength' => 6,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Jib Crane'
);
$Client->CraneExplain = array(
    'Name' => 'CraneExplain',
    'Type' => 'Textbox',
    'Value' => $CraneExplain,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Crane Explain'
);
$Client->ElevationHeader = array(
    'Name' => 'ElevationHeader',
    'Type' => 'Textbox',
    'Value' => $ElevationHeader,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Elevation Header'
);
$Client->ElevationDrawings = array(
    'Name' => 'ElevationDrawings',
    'Type' => 'Radio',
    'Value' => $ElevationDrawings,
    'Value_Type' => 'String',
    'MinLength' => 6,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Elevation Drawings'
);
$Client->PlantDrawings = array(
    'Name' => 'PlantDrawings',
    'Type' => 'Radio',
    'Value' => $PlantDrawings,
    'Value_Type' => 'String',
    'MinLength' => 6,
    'MaxLength' => 10,
    'Required' => 0,
    'Display' => 'Plant Drawings'
);

//Workcell Specifications
$Client->PSI = array(
    'Name' => 'PSI',
    'Type' => 'Textbox',
    'Value' => $PSI,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 28,
    'Required' => 0,
    'Display' => 'PSI'
);
$Client->OtherPowerSource = array(
    'Name' => 'OtherPowerSource',
    'Type' => 'Textbox',
    'Value' => $OtherPowerSource,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Other Power Source'
);
$Client->Environment = array(
    'Name' => 'Environment',
    'Type' => 'Textbox',
    'Value' => $Environment,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Environment'
);

// Additional Information
$Client->RackProvided = array(
    'Name' => 'RackProvided',
    'Type' => 'Checkbox',
    'Value' => $RackProvided,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 13,
    'Required' => 0,
    'Display' => 'RackProvided'
);
$Client->DrawingsProvided = array(
    'Name' => 'DrawingsProvided',
    'Type' => 'Checkbox',
    'Value' => $DrawingsProvided,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 13,
    'Required' => 0,
    'Display' => 'DrawingsProvided'
);
$Client->FloorPlansProvided = array(
    'Name' => 'FloorPlansProvided',
    'Type' => 'Checkbox',
    'Value' => $FloorPlansProvided,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 13,
    'Required' => 0,
    'Display' => 'FloorPlansProvided'
);
$Client->MachineProvided = array(
    'Name' => 'MachineProvided',
    'Type' => 'Checkbox',
    'Value' => $MachineProvided,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 13,
    'Required' => 0,
    'Display' => 'MachineProvided'
);
$Client->PhotoVideoProvided = array(
    'Name' => 'PhotoVideoProvided',
    'Type' => 'Checkbox',
    'Value' => $PhotoVideoProvided,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 13,
    'Required' => 0,
    'Display' => 'PhotoVideoProvided'
);
$Client->ApprovalProvided = array(
    'Name' => 'ApprovalProvided',
    'Type' => 'Checkbox',
    'Value' => $ApprovalProvided,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 13,
    'Required' => 0,
    'Display' => 'ApprovalProvided'
);
$Client->Installation = array(
    'Name' => 'Installation',
    'Type' => 'Checkbox',
    'Value' => $Installation,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 13,
    'Required' => 0,
    'Display' => 'Installation'
);
$Client->CustomerReviews = array(
    'Name' => 'CustomerReviews',
    'Type' => 'Checkbox',
    'Value' => $CustomerReviews,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 13,
    'Required' => 0,
    'Display' => 'CustomerReviews'
);
$Client->CustomerReviewsExplain = array(
    'Name' => 'CustomerReviewsExplain',
    'Type' => 'Textbox',
    'Value' => $CustomerReviewsExplain,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'CustomerReviewsExplain'
);
$Client->CustomerPaper = array(
    'Name' => 'CustomerPaper',
    'Type' => 'Checkbox',
    'Value' => $CustomerPaper,
    'Value_Type' => 'String',
    'MinLength' => 2,
    'MaxLength' => 13,
    'Required' => 0,
    'Display' => 'CustomerPaper'
);

// Special Requirements
$Client->SpecialRequirements = array(
    'Name' => 'SpecialRequirements',
    'Type' => 'Textbox',
    'Value' => $SpecialRequirements,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'SpecialRequirements'
);
$Client->Budget = array(
    'Name' => 'Budget',
    'Type' => 'Textbox',
    'Value' => $Budget,
    'Value_Type' => 'String',
    'MinLength' => 1,
    'MaxLength' => 700,
    'Required' => 0,
    'Display' => 'Budget'
);

//Validate the array values
check_ClientArray($Client);
////Create an email attachment and send the email
//$attachment = $Client->pdf_attach();
//email_pdf($attachment);
//Output the PDF to a browser window
$Client->pdf_output();

function email_pdf($attachment) {
    try {
        include './class.phpmailer.php';
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = 'smtp.hmc1.comcast.net';
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = 'mike@ergomaticproducts.com';
        //Set the password in .htaccess
        $mail->Password = getenv('EMAIL_PW');
        $mail->SetFrom('mike@ergomaticproducts.com');
        $mail->Subject = "REQUEST FOR QUOTE";
        $mail->Body = "REQUEST FOR QUOTE";
        $mail->AddAddress('mike@ergomaticproducts.com');
        $mail->AddStringAttachment($attachment, 'attachment.pdf');
        $mail->Send();
    } catch (Exception $e) {
        db_errorHandler($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        die("Email did not send successfully.  Please press the 'BACK' button on your web browser.");
    }
    return;
}

function check_string_length($string, $minLength, $maxLength, $display) {
    $cleaned_string = '';
    //Remove spaces before and after
    $cleaned_string = trim($string);
    //Make sure the string is less than the maximum allowed length and more than the minimum allowed length
    if ((strlen($cleaned_string) < $minLength) || strlen($cleaned_string) > $maxLength) {
        die("$display should be between $minLength and $maxLength characters");
    }
    return $cleaned_string;
}

/*
 * Checks the POST array for mandatory fields and validates them
 * based on type (string, integer, etc.)
 *
 * @param   obj         $Client
 */

function check_ClientArray($Client) {
    //Gather the individual form fields within the Client object
    foreach ($Client as $array => $formField) {
        //Get the values from the Client Object
        $value = $formField['Value'];
        $minLength = $formField['MinLength'];
        $maxLength = $formField['MaxLength'];
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
