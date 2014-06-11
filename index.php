<?php
require './scripts/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ergomatic Form</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/pure-min.css">
        <style>
            *{
                box-sizing: border-box;
            }
            body{
                background-color: lightgray;
            }
            form{
                width: 70%;
                max-width: 1100px;
                min-width: 720px;
                margin: 0 auto;
                /*background-color: lightblue;*/
                /*border: 1px solid black;*/
            }
            .pure-u-1,
            .pure-u-1-2,
            .pure-u-1-3,
            .pure-u-1-4,
            .pure-u-1-8{
                padding-left: 10px;
                padding-right: 10px;
                margin-top: 5px;
                margin-bottom: 5px;
            }
            textarea{
                resize: none;
            }
        </style>
        <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="js/masked_input.js" type="text/javascript"></script>
        <script src="js/functions.js" type="text/javascript"></script>
    </head>
    <body>
        <form class="pure-form pure-g" action="process.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <div class="pure-u-1">
                    <label>Email Password (Temporary):</label> <input type="password" name="email_password" />
                </div>
                <br />
                <!-- Customer Information -->
                <div class="pure-u-1">
                    <legend>Customer Information</legend>
                </div>
                <div class="pure-u-1">
                    <label>Company Name: </label><label class="charNum"></label>
                    <input type="text" id="txt_CompanyName" name="company_name" class="pure-input-1 length_text" maxlength="60" />
                </div>
                <div class="pure-u-1">
                    <label>Street Address: </label><label class="charNum"></label>
                    <input type="text" id="txt_StreetAddress" name="street_address" class="pure-input-1 length_text" maxlength="60" />
                </div>
                <div class="pure-u-1-3">
                    <label>City:</label><label class="charNum"></label>
                    <input type="text" id="txt_City" name="city" class="pure-input-1 length_text" maxlength="28" />
                </div>
                <div class="pure-u-1-3">
                    <label>State:</label>
                    <select name="state" id="cb_State" class="pure-input-1">
                        <?php echo state_builder(); ?>
                    </select>
                </div>
                <div class="pure-u-1-3">
                    <label>Zip:</label><label class="charNum"></label>
                    <input type="text" id="txt_Zip" name="zip" class="pure-input-1 length_text" maxlength="5" />
                </div>
                <div class="pure-u-1-3">
                    <label>First Name:</label><label class="charNum"></label>
                    <input type="text" id="txt_FirstName" name="firstName" class="pure-input-1 length_text" maxlength="28" />
                </div>
                <div class="pure-u-1-3">
                    <label>Last Name:</label><label class="charNum"></label>
                    <input type="text" id="txt_LastName" name="lastName" class="pure-input-1 length_text" maxlength="28" />
                </div>
                <div class="pure-u-1-3">
                    <label>Title:</label><label class="charNum"></label>
                    <input type="text" id="txt_Title" name="title" class="pure-input-1 length_text" maxlength="60" />
                </div>
                <div class="pure-u-1-3">
                    <label>Phone:</label>
                    <input type="text" id="txt_Phone" name="phone" class="pure-input-1 length_text" maxlength="14" />
                </div>
                <div class="pure-u-1-3">
                    <label>Fax:</label>
                    <input type="text" id="txt_Fax" name="fax" class="pure-input-1 length_text" maxlength="14" />
                </div>
                <div class="pure-u-1-3">
                    <label>Email:</label><label class="charNum"></label>
                    <input type="text" id="txt_Email" name="email" class="pure-input-1 length_text" maxlength="60" />
                </div>
                <br />
                <br />
                <!-- End-User Information -->
                <div class="pure-u-1">
                    <legend>End User Information</legend>
                </div>
                <div class="pure-u-1">
                    <button type="button" id="btn_CopyCompanyInfo" class="pure-button pure-button-primary">Same as Above</button>
                </div>
                <div class="pure-u-1">
                    <label>Company Name:</label><label class="charNum"></label>
                    <input type="text" id="txt_UserCompanyName" name="user_company_name" class="pure-input-1 length_text" maxlength="60" />
                </div>
                <div class="pure-u-1">
                    <label>Street Address:</label><label class="charNum"></label>
                    <input type="text" id="txt_UserStreetAddress" name="user_street_address" class="pure-input-1 length_text" maxlength="60" />
                </div>
                <div class="pure-u-1-3">
                    <label>City:</label><label class="charNum"></label>
                    <input type="text" id="txt_UserCity" name="user_city" class="pure-input-1 length_text" maxlength="28" />
                </div>
                <div class="pure-u-1-3">
                    <label>State:</label>
                    <select id="cb_UserState" name="user_state" class="pure-input-1">
                        <?php echo state_builder(); ?>
                    </select>
                </div>
                <div class="pure-u-1-3">
                    <label>Zip:</label>
                    <input type="text" id="txt_UserZip" name="user_zip" class="pure-input-1" />
                </div>
                <div class="pure-u-1-3">
                    <label>First Name:</label>
                    <input type="text" id="txt_UserFirstName" name="user_firstName" class="pure-input-1" />
                </div>
                <div class="pure-u-1-3">
                    <label>Last Name:</label>
                    <input type="text" id="txt_UserLastName" name="user_lastName" class="pure-input-1" />
                </div>
                <div class="pure-u-1-3">
                    <label>Title:</label>
                    <input type="text" id="txt_UserTitle" name="user_title" class="pure-input-1" />
                </div>
                <div class="pure-u-1-3">
                    <label>Phone:</label>
                    <input type="text" id="txt_UserPhone" name="user_phone" class="pure-input-1" />
                </div>
                <div class="pure-u-1-3">
                    <label>Fax:</label>
                    <input type="text" id="txt_UserFax" name="user_fax" class="pure-input-1" />
                </div>
                <div class="pure-u-1-3">
                    <label>Email:</label>
                    <input type="text" id="txt_UserEmail" name="user_email" class="pure-input-1" />
                </div>
                <br />
                <br />
                <!-- Application Information -->
                <div class="pure-u-1">
                    <legend>Application Information</legend>
                </div>
                <div class="pure-u-1">
                    <label>Part Description:</label><label class="charNum"></label>
                    <input type="text" name="part_description" class="pure-input-1 length_text" maxlength="124"/>
                </div>
                <div class="pure-u-1-4">
                    <label>Quantity:</label>
                    <input type="text" name="quantity" class="pure-input-1" />
                </div>
                <div class="pure-u-1-4">
                    <label>LH/RH Units Required:</label>
                    <input type="text" name="lh_rh_unit" class="pure-input-1" />
                </div>
                <br />
                <br />
                <!-- Part Dimensions -->
                <div class="pure-u-1">
                    <legend>Part Dimensions</legend>
                </div>
                <div class="pure-u-1">
                    <table class="pure-table-horizontal">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Weight</th>
                                <th>Height</th>
                                <th>Width</th>
                                <th>Length</th>
                                <th>Inner Dimensions</th>
                                <th>Outer Dimensions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Maximum</td>
                                <td><input type="text" name="max_weight" class="pure-input-1" /></td>
                                <td><input type="text" name="max_height" class="pure-input-1" /></td>
                                <td><input type="text" name="max_width" class="pure-input-1" /></td>
                                <td><input type="text" name="max_length" class="pure-input-1" /></td>
                                <td><input type="text" name="max_id" class="pure-input-1" /></td>
                                <td><input type="text" name="max_od" class="pure-input-1" /></td>
                            </tr>
                            <tr>
                                <td>Minimum</td>
                                <td><input type="text" name="min_weight" class="pure-input-1" /></td>
                                <td><input type="text" name="min_height" class="pure-input-1" /></td>
                                <td><input type="text" name="min_width" class="pure-input-1" /></td>
                                <td><input type="text" name="min_length" class="pure-input-1" /></td>
                                <td><input type="text" name="min_id" class="pure-input-1" /></td>
                                <td><input type="text" name="min_od" class="pure-input-1" /></td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="text-align: center;">***Please include a separate sheet for additional parts if necessary***</p>
                </div>
                <!-- Surface Type -->
                <div class="pure-u-1">
                    <legend>Surface Type: (check all that apply)</legend>
                </div>
                <div class="pure-u-1">
                    <label for="st_wet" class="pure-checkbox">
                        <input id="st_wet" type="checkbox" name="st_wet" value="Yes"> Wet
                    </label>
                    <label for="st_oily" class="pure-checkbox">
                        <input id="st_oily" type="checkbox" name="st_oily" value="Yes"> Oily
                    </label>
                    <label for="st_dry" class="pure-checkbox">
                        <input id="st_dry" type="checkbox" name="st_dry" value="Yes"> Dry
                    </label>
                    <table class="pure-table">
                        <tr>
                            <td>  
                                <label for="st_hot" class="pure-checkbox">
                                    <input id="st_hot" type="checkbox" name="st_hot" value="Yes"> Hot 
                                </label>
                            </td>
                            <td>
                                <div class="pure-u-1">
                                    <label>Temperature:</label>
                                    <input type="text" id="st_temp" class="pure-u-1" name="st_temp" />
                                </div>
                            </td>
                            <td>
                                <label for="farenheight" class="pure-radio">
                                    <input id="farenheight" type="radio" name="st_temp_scale" value="Farenheight" checked>
                                    Farenheight
                                </label>
                                <label for="celcius" class="pure-radio">
                                    <input id="celcius" type="radio" name="st_temp_scale" value="Celcius">
                                    Celcius
                                </label>
                            </td>
                        </tr>
                    </table>
                    <label for="st_classA" class="pure-checkbox">
                        <input id="st_classA" type="checkbox" name="st_classA" value="Yes"> Class A
                    </label>
                    <label for="st_fragile" class="pure-checkbox">
                        <input id="st_fragile" type="checkbox" name="st_fragile" value="Yes"> Fragile
                    </label>
                    <label for="st_textured" class="pure-checkbox">
                        <input id="st_textured" type="checkbox" name="st_textured" value="Yes"> Textured
                    </label>
                    <label for="st_other" class="pure-checkbox">
                        <input id="st_other" type="checkbox" name="st_other" value="Yes"> Other
                    </label>
                </div>
                <br />
                <br />
                <!-- Current Process -->
                <div class="pure-u-1">
                    <legend>Current Process</legend>
                </div>
                <div class="pure-u-1">
                    <label>Description of current process or sequence of operations: <label class='charNum'></label></label>
                    <textarea class="pure-u-1 length_text" maxlength="700" rows="6" id="process_description" name="process_description"></textarea>
                </div>
                <div class="pure-u-1-3">
                    <label>Production Rate (cycles/hour):</label>
                    <input type="text" class="pure-input-1" id="production_rate" name="production_rate" />
                </div>
                <div class="pure-u-1-3">
                    <label>Shifts/Day: </label>
                    <input type="text" class="pure-input-1" id="shifts" name="shifts" />
                </div>
                <br />
                <br />
                <!-- Part Engagement -->
                <div class="pure-u-1">
                    <legend>Part Engagement</legend>
                </div>
                <div class="pure-u-1">
                    <label>What is part being picked up from? <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700" id="eng_pickup" name="eng_pickup"></textarea>
                </div>
                <div class="pure-u-1">
                    <label>Please list any obstructions that may interfere with engaging the part: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700" id="eng_obstructions" name="eng_obstructions"></textarea>
                </div>
                <div class="pure-u-1">
                    <p>Is the part Moving or Stationary?</p>
                    <label for="part_moving" class="pure-radio">
                        <input id="part_moving" type="radio" name="eng_movement" value="Moving" checked>
                        Moving
                    </label>
                    <label for="part_stationary" class="pure-radio">
                        <input id="part_stationary" type="radio" name="eng_movement" value="Stationary">
                        Stationary
                    </label>
                </div>
                <div class="pure-u-1">
                    <label>Recommended area to engage the part: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700" id="eng_recommended" name="eng_recommended"></textarea>
                </div>
                <div class="pure-u-1">
                    <label>Areas of the part that cannot be touched: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700" id="eng_noTouching" name="eng_noTouching"></textarea>
                </div>
                <div class="pure-u-1">
                    <label>Operator's perspective of part orientation: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700" id="eng_orientation" name="eng_orientation"></textarea>
                </div>
                <div class="pure-u-1">
                    <label>Dimensional elevation of part at set down: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700" id="eng_dimElevation" name="eng_dimElevation"></textarea>
                </div>
                <br />
                <br />
                <!-- Part Set Down -->
                <div class="pure-u-1">
                    <legend>Part Set Down:</legend>
                </div>
                <div class="pure-u-1">
                    <label>What is part being set down on/in: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700"></textarea>
                </div>
                <div class="pure-u-1">
                    <p>Is the set-down location Moving or Stationary?</p>
                    <label for="setDown_moving" class="pure-radio">
                        <input id="setDown_moving" type="radio" name="setDown_movement" value="Moving" checked>
                        Moving
                    </label>
                    <label for="setDown_stationary" class="pure-radio">
                        <input id="setDown_stationary" type="radio" name="setDown_movement" value="Stationary">
                        Stationary
                    </label>
                </div>
                <div class="pure-u-1">
                    <label>Operator's perspective of part orientation: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700"></textarea>
                </div>
                <div class="pure-u-1">
                    <label>Dimensional elevation of part at set down: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700"></textarea>
                </div>
                <br />
                <br />
                <div class='pure-u-1'>
                    <legend>Monorail or Crane Systems</legend>
                </div>
                <div class="pure-u-1">
                    <input class="pure-button pure-button-primary" type="submit" name="" onclick="" />
                </div>
            </fieldset>
        </form>
    </body>
</html>
