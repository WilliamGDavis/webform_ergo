<?php
/*
 * Create a combobox that lists all the United States
 */
function state_builder() {
    $states_array = [
        'AL' => 'Alabama',
        'AK' => 'Alaska',
        'AZ' => 'Arizona',
        'AR' => 'Arkansas',
        'CA' => 'California',
        'CO' => 'Colorado',
        'CT' => 'Conneticut',
        'DE' => 'Delaware',
        'FL' => 'Florida',
        'GA' => 'Georgia',
        'HI' => 'Hawaii',
        'ID' => 'Idaho',
        'IL' => 'Illinois',
        'IN' => 'Indiana',
        'IA' => 'Iowa',
        'KS' => 'Kansas',
        'KY' => 'Kentucky',
        'LA' => 'Louisiana',
        'ME' => 'Maine',
        'MD' => 'Maryland',
        'MA' => 'Massachusetts',
        'MI' => 'Michigan',
        'MN' => 'Minnesota',
        'MS' => 'Mississippi',
        'MO' => 'Missouri',
        'MT' => 'Montana',
        'NE' => 'Nebraska',
        'NV' => 'Nevada',
        'NH' => 'New Hampshire',
        'NJ' => 'New Jersey',
        'NM' => 'New Mexico',
        'NY' => 'New York',
        'NC' => 'North Carolina',
        'ND' => 'North Dakota',
        'OH' => 'Ohio',
        'OK' => 'Oklahoma',
        'OR' => 'Oregon',
        'PA' => 'Pennsylvania',
        'RI' => 'Rhode Island',
        'SC' => 'South Carolina',
        'SD' => 'South Dakota',
        'TN' => 'Tenessee',
        'TX' => 'Texas',
        'UT' => 'Utah',
        'VT' => 'Vermont',
        'VA' => 'Virginia',
        'WA' => 'Washington',
        'WV' => 'West Virginia',
        'WI' => 'Wisconson',
        'WY' => 'Wyoming'
    ];

    $states = '';
    foreach ($states_array as $key => $value) {
        $states .= "<option value='$key'>$value</option>";
    }

    return $states;
}

/*
 * Make sure that the POST variables are filled out and sanitized(HTML)
 * If they aren't, display the 'die' message
 * 
 * @param       bool $required          true = Mandatory | false = Optional
 * @param       string $postName        The name of the input field in survey.php
 * @param       string $postVariable    The name of the variable you want created to be refered to as
 * @param       string $postString      The value that is displayed to the user
 * @return      string                  The cleaned, verified POST variable as a string
 */
function check_post_mandatory($required, $postName, $postVariable, $postString) {
    if ($required === true) {
        (filter_input(INPUT_POST, $postName) && filter_input(INPUT_POST, $postName) != "") ?
                        //Create a variable based on the string passed in ($postVariable)
                        $$postVariable = trim(filter_input(INPUT_POST, $postName)) :
                        die("Please press the BACK button on your browser and fill out the '$postString'<br />"
                                . "DO NOT refresh or reload this page as you will lose everything you have typed");
    } elseif ($required === false) {
        (filter_input(INPUT_POST, $postName)) ?
                        //Create a variable based on the string passed in ($postVariable)
                        $$postVariable = trim(filter_input(INPUT_POST, $postName)) :
                        $$postVariable = "";
    }
    //Clean the returned string
    return clean_string_html($$postVariable);
}

/*
 * Checks all checkboxes and assigned a yes or no value
 * 
 * @param       string $postName        The name of the input field in survey.php
 * @param       string $postVariable    The name of the variable you want created to be refered to as
 * @return      string 
 */
function check_checkboxes($postName, $postVariable){
    (filter_input(INPUT_POST, $postName)) ?
            $$postVariable = 'Yes' :
            $$postVariable = 'No';
    return $$postVariable;
           
}

/*
 * Check radio buttons and collect the selected radio button value as a string
 * 
 * @param       string $postName        The name of the input field in survey.php
 * @param       string $postVariable    The name of the variable you want created to be refered to as
 * @return      string 
 */
function check_radio($postName, $postVariable){
    (filter_input(INPUT_POST, $postName)) ?
            $$postVariable = trim(filter_input(INPUT_POST, $postName)) :
            $$postVariable = "";
    return $$postVariable;
}

/*
 * Clean the passed in string from HTML injections
 * 
 * @param   string $string         Any String
 */
function clean_string_html($string) {
    $clean_string = htmlspecialchars(trim($string));
    return $clean_string;
}
