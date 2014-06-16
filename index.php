<?php
require './scripts/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ergomatic Form</title>
        <style type="text/css">
            div.inline { float:left; }
            .clearBoth { clear:both; }
            /*custom font*/
            /*            @import url(http://fonts.googleapis.com/css?family=Montserrat);*/

            /*basic reset*/
            * {margin: 0; padding: 0; box-sizing: border-box;}

            html {
                height: 100%;
                /*Image only BG fallback*/
                background: url('./background.png');
                /*background = gradient + image pattern combo*/
                background: 
                    /*linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)),*/ 
                    url('./background.png');
            }

            body {
                font-family: montserrat, arial, verdana;
            }
            /*form styles*/
            #msform {
                width: 80%;
                margin: 50px auto;
                text-align: center;
                position: relative;
            }
            #msform fieldset {
                background: white;
                border: 0 none;
                border-radius: 3px;
                box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
                padding: 20px 30px;

                box-sizing: border-box;
                width: 80%;
                margin: 0 10%;

                /*stacking fieldsets above each other*/
                position: absolute;
            }
            /*Hide all except first fieldset*/
            #msform fieldset:not(:first-of-type) {
                display: none;
            }
            /*inputs*/
            #msform input, 
            #msform textarea,
            #msform select{
                width: 100%;
                padding: .25em .5em;
                border: 1px solid #ccc;
                border-radius: 3px;
                margin-bottom: 10px;
                /*width: 100%;*/
                box-sizing: border-box;
                font-family: montserrat;
                color: #2C3E50;
                font-size: 16px;
            }
            /*buttons*/
            #msform .action-button {
                width: 100px;
                background: #27AE60;
                font-weight: bold;
                color: white;
                border: 0 none;
                border-radius: 1px;
                cursor: pointer;
                padding: 10px 5px;
                margin: 10px 5px;
            }
            #msform .action-button:hover, #msform .action-button:focus {
                box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
            }
            /*headings*/
            .fs-title {
                font-size: 15px;
                text-transform: uppercase;
                color: #2C3E50;
                margin-bottom: 10px;
            }
            .fs-subtitle {
                font-weight: normal;
                font-size: 13px;
                color: #666;
                margin-bottom: 20px;
            }
            /*progressbar*/
            #progressbar {
                margin-bottom: 30px;
                overflow: hidden;
                /*CSS counters to number the steps*/
                counter-reset: step;
            }
            #progressbar li {
                list-style-type: none;
                color: white;
                text-transform: uppercase;
                font-size: 9px;
                width: 25%;
                float: left;
                position: relative;
            }
            #progressbar li:before {
                content: counter(step);
                counter-increment: step;
                width: 20px;
                line-height: 20px;
                display: block;
                font-size: 10px;
                color: #333;
                background: white;
                border-radius: 3px;
                margin: 0 auto 5px auto;
            }
            /*progressbar connectors*/
            #progressbar li:after {
                content: '';
                width: 100%;
                height: 2px;
                background: white;
                position: absolute;
                left: -50%;
                top: 9px;
                z-index: -1; /*put it behind the numbers*/
            }
            #progressbar li:first-child:after {
                /*connector not needed before the first step*/
                content: none; 
            }
            /*marking active/completed steps green*/
            /*The number of the step and the connector before it = green*/
            #progressbar li.active:before,  #progressbar li.active:after{
                background: #27AE60;
                color: white;
            }
            .width_100{
                text-align: left;
                width: 100%;
            }
            .width_33-Left{
                text-align: left;
                width: 33.33%;
                padding-right: 1%;
            }
            .width_33-Center{
                text-align: left;
                width: 33.34%;
                padding: 0 1%;
            }
            .width_33-Right{
                text-align: left;
                width: 33.33%;
                padding-left: 1%;
            }
        </style>
        <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="js/masked_input.js" type="text/javascript"></script>
        <script src="js/functions.js" type="text/javascript"></script>
        <!-- jQuery -->
        <!--<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>-->
        <!-- jQuery easing plugin -->
        <script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                //jQuery time
                var current_fs, next_fs, previous_fs; //fieldsets
                var left, opacity, scale; //fieldset properties which we will animate
                var animating; //flag to prevent quick multi-click glitches

                $(".next").click(function() {
                    if (animating)
                        return false;
                    animating = true;

                    current_fs = $(this).parent();
                    next_fs = $(this).parent().next();

                    //activate next step on progressbar using the index of next_fs
                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                    //show the next fieldset
                    next_fs.show();
                    //hide the current fieldset with style
                    current_fs.animate({opacity: 0}, {
                        step: function(now, mx) {
                            //as the opacity of current_fs reduces to 0 - stored in "now"
                            //1. scale current_fs down to 80%
                            scale = 1 - (1 - now) * 0.2;
                            //2. bring next_fs from the right(50%)
                            left = (now * 50) + "%";
                            //3. increase opacity of next_fs to 1 as it moves in
                            opacity = 1 - now;
                            current_fs.css({'transform': 'scale(' + scale + ')'});
                            next_fs.css({'left': left, 'opacity': opacity});
                        },
                        duration: 800,
                        complete: function() {
                            current_fs.hide();
                            animating = false;
                        },
                        // Shis comes from the custom easing plugin
                        easing: 'easeInOutBack'
                    });
                });

                $(".previous").click(function() {
                    if (animating)
                        return false;
                    animating = true;

                    current_fs = $(this).parent();
                    previous_fs = $(this).parent().prev();

                    //de-activate current step on progressbar
                    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

                    //show the previous fieldset
                    previous_fs.show();
                    //hide the current fieldset with style
                    current_fs.animate({opacity: 0}, {
                        step: function(now, mx) {
                            //as the opacity of current_fs reduces to 0 - stored in "now"
                            //1. scale previous_fs from 80% to 100%
                            scale = 0.8 + (1 - now) * 0.2;
                            //2. take current_fs to the right(50%) - from 0%
                            left = ((1 - now) * 50) + "%";
                            //3. increase opacity of previous_fs to 1 as it moves in
                            opacity = 1 - now;
                            current_fs.css({'left': left});
                            previous_fs.css({'transform': 'scale(' + scale + ')', 'opacity': opacity});
                        },
                        duration: 800,
                        complete: function() {
                            current_fs.hide();
                            animating = false;
                        },
                        //this comes from the custom easing plugin
                        easing: 'easeInOutBack'
                    });
                });

                $(".submit").click(function() {
                    return false;
                });
            });
        </script>
    </head>
    <body>
        <!-- Temporarily used to generate fields -->
        <button type="button" id="btn_GenerateFields">Generate Test</button>
        <!--        <form id='msform' action="process.php" method="post" enctype="multipart/form-data">-->
        <form id='msform' action="process.php" method="post" enctype="multipart/form-data">
            <ul id="progressbar">
                <li class="active">Customer Info</li>
                <li>End User Info</li>
                <li>Application Info</li>
                <li>Surface Type</li>
            </ul>
            <fieldset>
                <div>
                    <label>Email Password (Temporary):</label> <input type="password" name="email_password" />
                </div>
                <!-- Customer Information -->
                <h2 class="fs-title">Customer Information</h2>
                <h3 class="fs-subtitle">Your company's information</h3>
                <div class='width_100'>
                    <label>Company Name: </label><label class="charNum"></label>
                    <input type="text" id="txt_CompanyName" name="company_name" class="length_text" maxlength="60" />
                </div>
                <div class='width_100'>
                    <label>Street Address: </label><label class="charNum"></label>
                    <input type="text" id="txt_StreetAddress" name="street_address" class="length_text" maxlength="60" />
                </div>
                <div>
                    <div class='inline width_33-Left'>
                        <label>City: </label><label class="charNum"></label>
                        <input type="text" id="txt_City" name="city" class="length_text" maxlength="28" />
                    </div>
                    <div class='inline width_33-Center'>
                        <label>State:</label>
                        <select name="state" id="cb_State">
                            <?php echo state_builder(); ?>
                        </select>
                    </div>
                    <div class='inline width_33-Right'>
                        <label>Zip:</label><label class="charNum"></label>
                        <input type="text" id="txt_Zip" name="zip" class="length_text" maxlength="5" />
                    </div>
                </div>
                <br class='clearBoth' />
                <div>
                    <div class="inline width_33-Left">
                        <label>First Name:</label><label class="charNum"></label>
                        <input type="text" id="txt_FirstName" name="firstName" class="length_text" maxlength="28" />
                    </div>
                    <div class="inline width_33-Center">
                        <label>Last Name:</label><label class="charNum"></label>
                        <input type="text" id="txt_LastName" name="lastName" class="length_text" maxlength="28" />
                    </div>
                    <div class="inline width_33-Right">
                        <label>Title:</label><label class="charNum"></label>
                        <input type="text" id="txt_Title" name="title" class="length_text" maxlength="60" />
                    </div>
                </div>
                <br class='clearBoth' />
                <div>
                    <div class="inline width_33-Left">
                        <label>Phone:</label>
                        <input type="text" id="txt_Phone" name="phone" class="length_text" maxlength="14" />
                    </div>
                    <div class="inline width_33-Center">
                        <label>Fax:</label>
                        <input type="text" id="txt_Fax" name="fax" class="length_text" maxlength="14" />
                    </div>
                    <div class="inline width_33-Right">
                        <label>Email:</label><label class="charNum"></label>
                        <input type="text" id="txt_Email" name="email" class="length_text" maxlength="60" />
                    </div>
                </div>
                <br class='clearBoth' />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>
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
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>
                <!-- Application Information -->
                <div class="pure-u-1">
                    <legend>Application Information</legend>
                </div>
                <div class="pure-u-1">
                    <label>Part Description:</label><label class="charNum"></label>
                    <input type="text" id="txt_PartDescription" name="part_description" class="pure-input-1 length_text" maxlength="124"/>
                </div>
                <div class="pure-u-1-4">
                    <label>Quantity:</label>
                    <input type="text" id="txt_Quantity" name="quantity" class="pure-input-1" />
                </div>
                <div class="pure-u-1-4">
                    <label>LH/RH Units Required:</label>
                    <input type="text" id="txt_LhRhUnit" name="lh_rh_unit" class="pure-input-1" />
                </div>
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
                                <td><input type="text" id="txt_MaxWeight" name="max_weight" class="pure-input-1" /></td>
                                <td><input type="text" id="txt_MaxHeight" name="max_height" class="pure-input-1" /></td>
                                <td><input type="text" id="txt_MaxWidth" name="max_width" class="pure-input-1" /></td>
                                <td><input type="text" id="txt_MaxLength" name="max_length" class="pure-input-1" /></td>
                                <td><input type="text" id="txt_MaxID" name="max_id" class="pure-input-1" /></td>
                                <td><input type="text" id="txt_MaxOD" name="max_od" class="pure-input-1" /></td>
                            </tr>
                            <tr>
                                <td>Minimum</td>
                                <td><input type="text" id="txt_MinWeight" name="min_weight" class="pure-input-1" /></td>
                                <td><input type="text" id="txt_MinHeight" name="min_height" class="pure-input-1" /></td>
                                <td><input type="text" id="txt_MinWidth" name="min_width" class="pure-input-1" /></td>
                                <td><input type="text" id="txt_MinLength" name="min_length" class="pure-input-1" /></td>
                                <td><input type="text" id="txt_MinID" name="min_id" class="pure-input-1" /></td>
                                <td><input type="text" id="txt_MinOD" name="min_od" class="pure-input-1" /></td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="text-align: center;">***Please include a separate sheet for additional parts if necessary***</p>
                </div>
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>

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
                    <label for="part_notSpecified" class="pure-radio">
                        <input id="part_notSpecified" type="radio" name="eng_movement" value="Not Specified" checked>
                        Not Specified
                    </label>
                    <label for="part_moving" class="pure-radio">
                        <input id="part_moving" type="radio" name="eng_movement" value="Moving">
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
                    <textarea class="pure-input-1 notes" id="sd_location" name="sd_location" rows="3" maxlength="700"></textarea>
                </div>
                <div class="pure-u-1">
                    <p>Is the set-down location Moving or Stationary?</p>
                    <label for="setDown_notSpecified" class="pure-radio">
                        <input id="setDown_notSpecified" type="radio" id="sd_movement" name="sd_movement" value="Not Specified" checked>
                        Not Specified
                    </label>
                    <label for="setDown_moving" class="pure-radio">
                        <input id="setDown_moving" type="radio" id="sd_movement" name="sd_movement" value="Moving">
                        Moving
                    </label>
                    <label for="setDown_stationary" class="pure-radio">
                        <input id="setDown_stationary" type="radio" id="sd_movement" name="sd_movement" value="Stationary">
                        Stationary
                    </label>
                </div>
                <div class="pure-u-1">
                    <label>Please list any obstructions that may interfere with engaging the part: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" id="sd_obstruction" name="sd_obstruction" rows="3" maxlength="700"></textarea>
                </div>
                <div class="pure-u-1">
                    <label>Operator's perspective of part orientation: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" id="sd_orientation" name="sd_orientation" rows="3" maxlength="700"></textarea>
                </div>
                <div class="pure-u-1">
                    <label>Dimensional elevation of part at set down: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" id="sd_dimElevation" name="sd_dimElevation" rows="3" maxlength="700"></textarea>
                </div>
                <br />
                <br />
                <div class='pure-u-1'>
                    <legend>Monorail or Crane Systems</legend>
                </div>
                <div class="pure-u-1">
                    <p>Floor Mounted Arm</p>
                    <label for="fmarm_ns" class="pure-radio">
                        <input id="fmarm_ns" type="radio" id="crane_systems" name="fma" value="Not Specified" checked>
                        Not Specified
                    </label>
                    <label for="fmarm_yes" class="pure-radio">
                        <input id="fmarm_yes" type="radio" id="crane_systems" name="fma" value="Yes">
                        Yes
                    </label>
                    <label for="fmarm_no" class="pure-radio">
                        <input id="fmarm_no" type="radio" id="crane_systems" name="fma" value="No">
                        No
                    </label>
                    <p>XY Rail System</p>
                    <label for="xyrail_ns" class="pure-radio">
                        <input id="xyrail_ns" type="radio" id="crane_systems" name="xyrail" value="Not Specified" checked>
                        Not Specified
                    </label>
                    <label for="xyrail_yes" class="pure-radio">
                        <input id="xyrail_yes" type="radio" id="crane_systems" name="xyrail" value="Yes">
                        Yes
                    </label>
                    <label for="xyrail_no" class="pure-radio">
                        <input id="xyrail_no" type="radio" id="crane_systems" name="xyrail" value="No">
                        No
                    </label>
                    <p>Jib Crane</p>
                    <label for="jibcrane_ns" class="pure-radio">
                        <input id="jibcrane_ns" type="radio" id="crane_systems" name="jibcrane" value="Not Specified" checked>
                        Not Specified
                    </label>
                    <label for="jibcrane_yes" class="pure-radio">
                        <input id="jibcrane_yes" type="radio" id="crane_systems" name="jibcrane" value="Yes">
                        Yes
                    </label>
                    <label for="jibcrane_no" class="pure-radio">
                        <input id="jibcrane_no" type="radio" id="crane_systems" name="jibcrane" value="No">
                        No
                    </label>
                </div>
                <div class="pure-u-1">
                    <legend>End Effector Specifics</legend>
                </div>
                <!-- TODO: 
                Fill in the rest of the form values
                -->
                <div class="pure-u-1">
                    <legend>Workcell Specification</legend>
                </div>
                <div class="pure-u-1-3">
                    <label>Air Pressure (PSI):</label>
                    <input type="text" id="txt_psi" name="psi" class="pure-input-1 length_text" maxlength="28" />
                </div>
                <div class="pure-u-1">
                    <label>Other power source? (Please explain): <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" id="other_power_source" name="other_power_source" rows="3" maxlength="700"></textarea>
                </div>
                <div class="pure-u-1">
                    <legend>Additional Information</legend>
                    </di>
                    <div class="pure-u-1">
                        <p>Will the rack or dunnage be provided?</p>
                        <label for="rack_ns" class="pure-radio">
                            <input id="rack_ns" type="radio" name="rack_provided" value="Not Specified" checked>
                            Not Specified
                        </label>
                        <label for="rack_yes" class="pure-radio">
                            <input id="rack_yes" type="radio" name="rack_provided" value="Yes">
                            Yes
                        </label>
                        <label for="rack_no" class="pure-radio">
                            <input id="rack_no" type="radio" name="rack_provided" value="No">
                            No
                        </label>
                    </div>
                    <div class="pure-u-1">
                        <p>Will the part drawing(s) be provided?</p>
                        <label for="drawings_ns" class="pure-radio">
                            <input id="drawings_ns" type="radio" name="drawings_provided" value="Not Specified" checked>
                            Not Specified
                        </label>
                        <label for="drawings_yes" class="pure-radio">
                            <input id="drawings_yes" type="radio" name="drawings_provided" value="Yes">
                            Yes
                        </label>
                        <label for="drawings_no" class="pure-radio">
                            <input id="drawings_no" type="radio" name="drawings_provided" value="No">
                            No
                        </label>
                    </div>
                    <div class="pure-u-1">
                        <p>Will the floor plan(s) be provided?</p>
                        <label for="floor_plans_ns" class="pure-radio">
                            <input id="floor_plans_ns" type="radio" name="floor_plans_provided" value="Not Specified" checked>
                            Not Specified
                        </label>
                        <label for="floor_plans_yes" class="pure-radio">
                            <input id="floor_plans_yes" type="radio" name="floor_plans_provided" value="Yes">
                            Yes
                        </label>
                        <label for="floor_plans_no" class="pure-radio">
                            <input id="floor_plans_no" type="radio" name="floor_plans_provided" value="No">
                            No
                        </label>
                    </div>
                    <div class="pure-u-1">
                        <p>Will the machine, fixture, or tool drawing(s) be provided?</p>
                        <label for="machine_ns" class="pure-radio">
                            <input id="machine_ns" type="radio" name="machine_provided" value="Not Specified" checked>
                            Not Specified
                        </label>
                        <label for="machine_yes" class="pure-radio">
                            <input id="machine_yes" type="radio" name="machine_provided" value="Yes">
                            Yes
                        </label>
                        <label for="machine_no" class="pure-radio">
                            <input id="machine_no" type="radio" name="machine_provided" value="No">
                            No
                        </label>
                    </div>
                    <div class="pure-u-1">
                        <p>Will photo(s) or video(s) be provided?</p>
                        <label for="photo_video_ns" class="pure-radio">
                            <input id="photo_video_ns" type="radio" name="photo_video_provided" value="Not Specified" checked>
                            Not Specified
                        </label>
                        <label for="photo_video_yes" class="pure-radio">
                            <input id="photo_video_yes" type="radio" name="photo_video_provided" value="Yes">
                            Yes
                        </label>
                        <label for="photo_video_no" class="pure-radio">
                            <input id="photo_video_no" type="radio" name="photo_video_provided" value="No">
                            No
                        </label>
                    </div>
                    <div class="pure-u-1">
                        <p>Will approval drawings be be required?</p>
                        <label for="approval_ns" class="pure-radio">
                            <input id="approval_ns" type="radio" name="approval_provided" value="Not Specified" checked>
                            Not Specified
                        </label>
                        <label for="approval_yes" class="pure-radio">
                            <input id="approval_yes" type="radio" name="approval_provided" value="Yes">
                            Yes
                        </label>
                        <label for="approval_no" class="pure-radio">
                            <input id="approval_no" type="radio" name="approval_provided" value="No">
                            No
                        </label>
                    </div>
                    <div class="pure-u-1">
                        <p>Will installation drawings be be required?</p>
                        <label for="installation_ns" class="pure-radio">
                            <input id="installation_ns" type="radio" name="installation" value="Not Specified" checked>
                            Not Specified
                        </label>
                        <label for="installation_yes" class="pure-radio">
                            <input id="installation_yes" type="radio"  name="installation" value="Yes">
                            Yes
                        </label>
                        <label for="installation_no" class="pure-radio">
                            <input id="installation_no" type="radio" name="installation" value="No">
                            No
                        </label>
                    </div>
                    <div class="pure-u-1">
                        <p>Will customer review(s) be be required?</p>
                        <label for="customer_reviews_ns" class="pure-radio">
                            <input id="customer_reviews_ns" type="radio" name="customer_reviews" value="Not Specified" checked>
                            Not Specified
                        </label>
                        <label for="customer_reviews_yes" class="pure-radio">
                            <input id="customer_reviews_yes" type="radio" name="customer_reviews" value="Yes">
                            Yes
                        </label>
                        <label for="customer_reviews_no" class="pure-radio">
                            <input id="customer_reviews_no" type="radio" name="customer_reviews" value="No">
                            No
                        </label>
                        <label>If yes, please explain: <label class='charNum'></label></label>
                        <textarea class="pure-input-1 notes" id="customer_reviews_explain" name="customer_reviews_explain" rows="3" maxlength="700"></textarea>
                    </div>
                    <div class="pure-u-1">
                        <p>Will drawing be required on customer paper?</p>
                        <label for="customer_paper_ns" class="pure-radio">
                            <input id="customer_paper_ns" type="radio" name="customer_paper" value="Not Specified" checked>
                            Not Specified
                        </label>
                        <label for="customer_paper_yes" class="pure-radio">
                            <input id="customer_paper_yes" type="radio" name="customer_paper" value="Yes">
                            Yes
                        </label>
                        <label for="customer_paper_no" class="pure-radio">
                            <input id="customer_paper_no" type="radio" name="customer_paper" value="No">
                            No
                        </label>
                    </div>
                    <div class="pure-u-1">
                        <legend>Special Requirements or Additional Comments</legend>
                        </di>
                        <div>
                            <label>If yes, please explain: <label class='charNum'></label></label>
                            <textarea class="pure-input-1 notes" id="special_requirements" name="special_requirements" rows="3" maxlength="700"></textarea>
                        </div>
                        <input type="button" name="previous" class="previous action-button" value="Previous" />
                        <input class="pure-button pure-button-primary" type="submit" name="" onclick="" />
                        </fieldset>
                        </form>
                        </body>
                        </html>
