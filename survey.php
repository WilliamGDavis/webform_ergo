<?php
require './scripts/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ergomatic Form</title>
        <!--<link href="./css/normalize.css" rel="stylesheet" type="text/css" />-->
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
            #msform input[type=text], 
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
                resize: none;
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
                width: 10%;
                float: left;
                position: relative;
                display: block;
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
            .width_67-Left{
                text-align: left;
                width: 67%;
                padding-right: 1%;
            }
            .width_50-Left{
                text-align: left;
                width: 50%;
                padding-right: 1%;
            }
            .width_50-Right{
                text-align: left;
                width: 50%;
                padding-left: 1%;
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
        <!--<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>-->
        <script src="js/jquery_easing.js" type="text/javascript"></script>
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
        <form id='msform' action="process.php" method="post" enctype="multipart/form-data">
            <ul id="progressbar">
                <li class="active">Customer Information</li>
                <li>End User Information</li>
                <li>Application Information</li>
                <li>Surface Type</li>
                <li>Current Process</li>
                <li>Part Engagement</li>
                <li>Part Set Down</li>
                <li>Monorail / Crane Systems</li>
                <li>End Effector</li>
                <li>Additional Information</li>
            </ul>
            <fieldset>
                <!--                <div>
                                    <label>Email Password (Temporary):</label> <input type="password" name="email_password" />
                                </div>-->
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
                <h2 class="fs-title">End User Information</h2>
                <h3 class="fs-subtitle">Your client's information</h3>
                <div class="">
                    <button type="button" id="btn_CopyCompanyInfo" class="action-button">Same as Above</button>
                </div>
                <div class="width_100">
                    <label>Company Name:</label><label class="charNum"></label>
                    <input type="text" id="txt_UserCompanyName" name="user_company_name" class="length_text" maxlength="60" />
                </div>
                <div class="width_100">
                    <label>Street Address:</label><label class="charNum"></label>
                    <input type="text" id="txt_UserStreetAddress" name="user_street_address" class="length_text" maxlength="60" />
                </div>
                <div class="inline width_33-Left">
                    <label>City:</label><label class="charNum"></label>
                    <input type="text" id="txt_UserCity" name="user_city" class="length_text" maxlength="28" />
                </div>
                <div class="inline width_33-Center">
                    <label>State:</label>
                    <select id="cb_UserState" name="user_state">
                        <?php echo state_builder(); ?>
                    </select>
                </div>
                <div class="inline width_33-Right">
                    <label>Zip:</label>
                    <input type="text" id="txt_UserZip" name="user_zip" class="length_text" maxlength="5" />
                </div>
                <br class='clearBoth' />
                <div class="inline width_33-Left">
                    <label>First Name:</label>
                    <input type="text" id="txt_UserFirstName" name="user_firstName" class="length_text" maxlength="60" />
                </div>
                <div class="inline width_33-Center">
                    <label>Last Name:</label>
                    <input type="text" id="txt_UserLastName" name="user_lastName" class="length_text" maxlength="60" />
                </div>
                <div class="inline width_33-Right">
                    <label>Title:</label>
                    <input type="text" id="txt_UserTitle" name="user_title" class="length_text" maxlength="60" />
                </div>
                <br class="clearBoth" />
                <div class="inline width_33-Left">
                    <label>Phone:</label>
                    <input type="text" id="txt_UserPhone" name="user_phone" class="length_text" maxlength="14" />
                </div>
                <div class="inline width_33-Center">
                    <label>Fax:</label>
                    <input type="text" id="txt_UserFax" name="user_fax" class="length_text" maxlength="14" />
                </div>
                <div class="inline width_33-Right">
                    <label>Email:</label>
                    <input type="text" id="txt_UserEmail" name="user_email" class="length_text" maxlength="60" />
                </div>
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>
                <!-- Application Information -->
                <h2 class="fs-title">Application Information</h2>
                <h3 class="fs-subtitle">Description of the part</h3>
                <div class="width_100">
                    <label>Part Description:</label><label class="charNum"></label>
                    <textarea id="txt_PartDescription" name="part_description" class="length_text" maxlength="700" rows="4"></textarea>
                </div>
                <div class="inline width_33-Left">
                    <label>Quantity:</label>
                    <input type="text" id="txt_Quantity" name="quantity" class="length_text" />
                </div>
                <div class="inline width_33-Center">
                    <label>LH/RH Units Required:</label>
                    <input type="text" id="txt_LhRhUnit" name="lh_rh_unit" class="length_text" />
                </div>
                <br class="clearBoth" />
                <br />
                <!-- Part Dimensions -->
                <h2 class="fs-title">Part Dimensions</h2>
                <h3 class="fs-subtitle">Please be as accurate as possible</h3>
                <div class="">
                    <table class="">
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
                                <td><input type="text" id="txt_MaxWeight" name="max_weight" class="" /></td>
                                <td><input type="text" id="txt_MaxHeight" name="max_height" class="" /></td>
                                <td><input type="text" id="txt_MaxWidth" name="max_width" class="" /></td>
                                <td><input type="text" id="txt_MaxLength" name="max_length" class="" /></td>
                                <td><input type="text" id="txt_MaxID" name="max_id" class="" /></td>
                                <td><input type="text" id="txt_MaxOD" name="max_od" class="" /></td>
                            </tr>
                            <tr>
                                <td>Minimum</td>
                                <td><input type="text" id="txt_MinWeight" name="min_weight" class="" /></td>
                                <td><input type="text" id="txt_MinHeight" name="min_height" class="" /></td>
                                <td><input type="text" id="txt_MinWidth" name="min_width" class="" /></td>
                                <td><input type="text" id="txt_MinLength" name="min_length" class="" /></td>
                                <td><input type="text" id="txt_MinID" name="min_id" class="" /></td>
                                <td><input type="text" id="txt_MinOD" name="min_od" class="" /></td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="text-align: center;">***Please include a separate sheet for additional parts if necessary***</p>
                </div>
                <br class="clearBoth" />
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <!-- Surface Type -->
            <fieldset>
                <h2 class="fs-title">Surface Type</h2>
                <h3 class="fs-subtitle">(check all that apply)</h3>
                <div class="width_100">
                    <div class="width_100">
                        <div class="width_100">
                            <table class="width_100">
                                <tr>
                                    <td style="width: 20%;">  
                                        <label for="st_hot">
                                            <input id="st_hot" type="checkbox" name="st_hot" value="Yes"> Hot 
                                        </label>
                                    </td>
                                    <td style="width: 60%;">
                                        <div>
                                            <label>Temperature:</label>
                                            <input type="text" id="st_temp" class="pure-u-1" name="st_temp" style="width: 80%;"/>
                                        </div>
                                    </td>
                                    <td style="width: 20%;">
                                        <label for="farenheight"">
                                            <input id="farenheight" type="radio" name="st_temp_scale" value="Farenheight" checked>
                                            Farenheight
                                        </label>
                                        <br />
                                        <label for="celcius">
                                            <input id="celcius" type="radio" name="st_temp_scale" value="Celcius">
                                            Celcius
                                        </label>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <label for="st_wet">
                            <input id="st_wet" type="checkbox" name="st_wet" value="Yes"> Wet
                        </label>
                    </div>
                    <div class="width_100">
                        <label for="st_dry" class="pure-checkbox">
                            <input id="st_dry" type="checkbox" name="st_dry" value="Yes"> Dry
                        </label>
                    </div>
                    <div class="width_100">
                        <label for="st_oily" class="pure-checkbox">
                            <input id="st_oily" type="checkbox" name="st_oily" value="Yes"> Oily
                        </label>
                    </div>
                    <div class="width_100">
                        <label for="st_classA">
                            <input id="st_classA" type="checkbox" name="st_classA" value="Yes"> Class A
                        </label>
                    </div>
                    <div class="width_100">
                        <label for="st_fragile" class="pure-checkbox">
                            <input id="st_fragile" type="checkbox" name="st_fragile" value="Yes"> Fragile
                        </label>
                    </div>
                    <div class="width_100">
                        <label for="st_textured" class="pure-checkbox">
                            <input id="st_textured" type="checkbox" name="st_textured" value="Yes"> Textured
                        </label>
                    </div>
                    <div class="width_100">
                        <label for="st_other" class="pure-checkbox">
                            <input id="st_other" type="checkbox" name="st_other" value="Yes"> Other
                        </label>
                    </div>
                </div>
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>
                <!-- Current Process -->
                <h2 class="fs-title">Current Process</h2>
                <h3 class="fs-subtitle">Please be as thorough as possible</h3>
                <div class="width_100">
                    <label>Description of current process or sequence of operations: <label class='charNum'></label></label>
                    <textarea class="pure-u-1 length_text" maxlength="700" rows="6" id="process_description" name="process_description"></textarea>
                </div>
                <div class="inline width_33-Left">
                    <label>Production Rate (cycles/hour):</label>
                    <input type="text" id="production_rate" name="production_rate" />
                </div>
                <div class="inline width_33-Center">
                    <label>Shifts/Day: </label>
                    <input type="text" id="shifts" name="shifts" />
                </div>
                <br class="clearBoth" />
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>
                <!-- Part Engagement -->
                <h2 class="fs-title">Part Engagement</h2>
                <h3 class="fs-subtitle">Please be as thorough as possible</h3>
                <div class="width_100">
                    <label>What is part being picked up from? <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700" id="eng_pickup" name="eng_pickup"></textarea>
                </div>
                <div class="width_100">
                    <label>Please list any obstructions that may interfere with engaging the part: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700" id="eng_obstructions" name="eng_obstructions"></textarea>
                </div>
                <div class="width_100">
                    <p style="margin-bottom: 1em;">Is the part Moving or Stationary?</p>
                    <div class="width_100">
                        <label for="part_notSpecified" class="pure-radio">
                            <input id="part_notSpecified" type="radio" name="eng_movement" value="Not Specified" checked>
                            Not Specified
                        </label>
                    </div>
                    <div class="width_100">
                        <label for="part_moving" class="pure-radio">
                            <input id="part_moving" type="radio" name="eng_movement" value="Moving">
                            Moving
                        </label>
                    </div>
                    <div class="width_100">
                        <label for="part_stationary" class="pure-radio">
                            <input id="part_stationary" type="radio" name="eng_movement" value="Stationary">
                            Stationary
                        </label>
                    </div>
                </div>
                <br />
                <div class="width_100">
                    <label>Recommended area to engage the part: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700" id="eng_recommended" name="eng_recommended"></textarea>
                </div>
                <div class="width_100">
                    <label>Areas of the part that cannot be touched: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700" id="eng_noTouching" name="eng_noTouching"></textarea>
                </div>
                <div class="width_100">
                    <label>Operator's perspective of part orientation: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700" id="eng_orientation" name="eng_orientation"></textarea>
                </div>
                <div class="width_100">
                    <label>Dimensional elevation of part at set down: <label class='charNum'></label></label>
                    <textarea class="pure-input-1 notes" rows="3" maxlength="700" id="eng_dimElevation" name="eng_dimElevation"></textarea>
                </div>
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>
                <!-- Part Set Down -->
                <h2 class="fs-title">Part Set Down</h2>
                <h3 class="fs-subtitle">Please be as thorough as possible</h3>
                <div class="width_100">
                    <label>What is part being set down on/in: <label class='charNum'></label></label>
                    <textarea class="notes" id="sd_location" name="sd_location" rows="3" maxlength="700"></textarea>
                </div>
                <div class="width_100">
                    <p style="text-align: left; margin-bottom: 1em;">Is the set-down location Moving or Stationary?</p>
                    <div>
                        <label for="setDown_notSpecified" class="pure-radio">
                            <input id="setDown_notSpecified" type="radio" name="sd_movement" value="Not Specified" checked>
                            Not Specified
                        </label>
                    </div>
                    <div>
                        <label for="setDown_moving" class="pure-radio">
                            <input id="setDown_moving" type="radio" name="sd_movement" value="Moving">
                            Moving
                        </label>
                    </div>
                    <div>
                        <label for="setDown_stationary" class="pure-radio">
                            <input id="setDown_stationary" type="radio" name="sd_movement" value="Stationary">
                            Stationary
                        </label>
                    </div>
                </div>
                <br />
                <div class="width_100">
                    <label>Please list any obstructions that may interfere with engaging the part: <label class='charNum'></label></label>
                    <textarea class="notes" id="sd_obstruction" name="sd_obstruction" rows="3" maxlength="700"></textarea>
                </div>
                <div class="width_100">
                    <label>Operator's perspective of part orientation: <label class='charNum'></label></label>
                    <textarea class="notes" id="sd_orientation" name="sd_orientation" rows="3" maxlength="700"></textarea>
                </div>
                <div class="width_100">
                    <label>Dimensional elevation of part at set down: <label class='charNum'></label></label>
                    <textarea class="notes" id="sd_dimElevation" name="sd_dimElevation" rows="3" maxlength="700"></textarea>
                </div>
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>
                <div class='pure-u-1'>
                    <legend>Monorail or Crane Systems</legend>
                </div>
                <div class="width_100">
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
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>
                <h2 class="fs-title">End Effector Specifics</h2>
                <h3 class="fs-subtitle">Please be as thorough as possible</h3>
                <div class="width_33-Left">
                    <label>Air Pressure (PSI):</label>
                    <input type="text" id="txt_psi" name="psi" class="length_text" maxlength="28" />
                </div>
                <div class="width_100">
                    <label>Other power source? (Please explain): <label class='charNum'></label></label>
                    <textarea class="notes" id="other_power_source" name="other_power_source" rows="3" maxlength="700"></textarea>
                </div>
                <h2 class="fs-title">Environment</h2>
                <div class="width_100">
                    <label>Please explain the environment.  Some things we would like information about include:</label><br />
                        <ul>
                            <li>Extreme Temperature (outside of 50-80 degree F range)</li>
                            <li>Corrosive</li>
                            <li>Dusty</li>
                            <li>Clean Room (specify class)</li>
                            <li>Food/Beverage</li>
                        </ul>
                    <label class='charNum'></label>
                    <textarea class="notes" id="other_power_source" name="other_power_source" rows="6" maxlength="700"></textarea>
                </div>
                <div class="width_67-Left">
                    <label>Elevation from floor to bottom surface of header steel:</label>
                    <input type="text" id="elevation_header" name="elevation_header" class="length_text" maxlength="28" />
                </div>
                <div class="width_100" style="margin-bottom: 1em;">
                    <p style="margin-bottom: 1em;">Can elevation drawings be provided?</p>
                    <div class="width_100">
                        <label for="elevation_drawings_ns">
                            <input id="elevation_drawings_ns" type="radio" name="elevation_drawings" value="Not Specified" checked>
                            Not Specified
                        </label>
                    </div
                    <div class="width_100">
                        <label for="elevation_drawings_yes">
                            <input id="elevation_drawings_yes" type="radio" name="elevation_drawings" value="Yes">
                            Yes
                        </label>
                        <div class="width_100">
                            <label for="elevation_drawings_no">
                                <input id="elevation_drawings_no" type="radio" name="elevation_drawings" value="No">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="width_100" style="margin-bottom: 1em;">
                    <p style="margin-bottom: 1em;">Can workcell/plant layout drawings be provided?</p>
                    <div class="width_100">
                        <label for="plant_drawings_ns">
                            <input id="plant_drawings_ns" type="radio" name="plant_drawings" value="Not Specified" checked>
                            Not Specified
                        </label>
                    </div
                    <div class="width_100">
                        <label for="plant_drawings_yes">
                            <input id="plant_drawings_yes" type="radio" name="plant_drawings" value="Yes">
                            Yes
                        </label>
                        <div class="width_100">
                            <label for="plant_drawings_no">
                                <input id="plant_drawings_no" type="radio" name="plant_drawings" value="No">
                                No
                            </label>
                        </div>
                    </div>
                <input type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Additional Information</h2>
                <h3 class="fs-subtitle">Please be as thorough as possible</h3>
                <div class="width_100" style="margin-bottom: 1em;">
                    <p style="margin-bottom: 1em;">Will the rack or dunnage be provided?</p>
                    <div class="width_100">
                        <label for="rack_ns">
                            <input id="rack_ns" type="radio" name="rack_provided" value="Not Specified" checked>
                            Not Specified
                        </label>
                    </div
                    <div class="width_100">
                        <label for="rack_yes">
                            <input id="rack_yes" type="radio" name="rack_provided" value="Yes">
                            Yes
                        </label>
                        <div class="width_100">
                            <label for="rack_no">
                                <input id="rack_no" type="radio" name="rack_provided" value="No">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="width_100" style="margin-bottom: 1em;">
                        <p style="margin-bottom: 1em;">Will the part drawing(s) be provided?</p>
                        <div class="width_100">
                            <label for="drawings_ns">
                                <input id="drawings_ns" type="radio" name="drawings_provided" value="Not Specified" checked>
                                Not Specified
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="drawings_yes">
                                <input id="drawings_yes" type="radio" name="drawings_provided" value="Yes">
                                Yes
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="drawings_no">
                                <input id="drawings_no" type="radio" name="drawings_provided" value="No">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="width_100" style="margin-bottom: 1em;">
                        <p style="margin-bottom: 1em;">Will the floor plan(s) be provided?</p>
                        <div class="width_100">
                            <label for="floor_plans_ns">
                                <input id="floor_plans_ns" type="radio" name="floor_plans_provided" value="Not Specified" checked>
                                Not Specified
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="floor_plans_yes">
                                <input id="floor_plans_yes" type="radio" name="floor_plans_provided" value="Yes">
                                Yes
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="floor_plans_no">
                                <input id="floor_plans_no" type="radio" name="floor_plans_provided" value="No">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="width_100" style="margin-bottom: 1em;">
                        <p style="margin-bottom: 1em;">Will the machine, fixture, or tool drawing(s) be provided?</p>
                        <div class="width_100">
                            <label for="machine_ns">
                                <input id="machine_ns" type="radio" name="machine_provided" value="Not Specified" checked>
                                Not Specified
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="machine_yes">
                                <input id="machine_yes" type="radio" name="machine_provided" value="Yes">
                                Yes
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="machine_no">
                                <input id="machine_no" type="radio" name="machine_provided" value="No">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="width_100" style="margin-bottom: 1em;">
                        <p style="margin-bottom: 1em;">Will photo(s) or video(s) be provided?</p>
                        <div class="width_100">
                            <label for="photo_video_ns">
                                <input id="photo_video_ns" type="radio" name="photo_video_provided" value="Not Specified" checked>
                                Not Specified
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="photo_video_yes">
                                <input id="photo_video_yes" type="radio" name="photo_video_provided" value="Yes">
                                Yes
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="photo_video_no">
                                <input id="photo_video_no" type="radio" name="photo_video_provided" value="No">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="width_100" style="margin-bottom: 1em;">
                        <p style="margin-bottom: 1em;">Will approval drawings be be required?</p>
                        <div class="width_100">
                            <label for="approval_ns">
                                <input id="approval_ns" type="radio" name="approval_provided" value="Not Specified" checked>
                                Not Specified
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="approval_yes">
                                <input id="approval_yes" type="radio" name="approval_provided" value="Yes">
                                Yes
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="approval_no">
                                <input id="approval_no" type="radio" name="approval_provided" value="No">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="width_100" style="margin-bottom: 1em;">
                        <p style="margin-bottom: 1em;">Will installation drawings be be required?</p>
                        <div class="width_100">
                            <label for="installation_ns">
                                <input id="installation_ns" type="radio" name="installation" value="Not Specified" checked>
                                Not Specified
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="installation_yes">
                                <input id="installation_yes" type="radio"  name="installation" value="Yes">
                                Yes
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="installation_no">
                                <input id="installation_no" type="radio" name="installation" value="No">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="width_100" style="margin-bottom: 1em;">
                        <p style="margin-bottom: 1em;">Will drawing be required on customer paper?</p>
                        <div class="width_100">
                            <label for="customer_paper_ns">
                                <input id="customer_paper_ns" type="radio" name="customer_paper" value="Not Specified" checked>
                                Not Specified
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="customer_paper_yes">
                                <input id="customer_paper_yes" type="radio" name="customer_paper" value="Yes">
                                Yes
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="customer_paper_no">
                                <input id="customer_paper_no" type="radio" name="customer_paper" value="No">
                                No
                            </label>
                        </div>
                    </div>
                    <div class="width_100" style="margin-bottom: 1em;">
                        <p style="margin-bottom: 1em;">Will customer review(s) be be required?</p>
                        <div class="width_100">
                            <label for="customer_reviews_ns">
                                <input id="customer_reviews_ns" type="radio" name="customer_reviews" value="Not Specified" checked>
                                Not Specified
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="customer_reviews_yes">
                                <input id="customer_reviews_yes" type="radio" name="customer_reviews" value="Yes">
                                Yes
                            </label>
                        </div>
                        <div class="width_100">
                            <label for="customer_reviews_no">
                                <input id="customer_reviews_no" type="radio" name="customer_reviews" value="No">
                                No
                            </label>
                        </div>
                        <div class="width_100" style="margin-top: .5em;">
                            <label>If yes, please explain: <label class='charNum'></label></label>
                            <textarea class="notes" id="customer_reviews_explain" name="customer_reviews_explain" rows="3" maxlength="700"></textarea>
                        </div>
                    </div>
                    <div class="width_100">
                        <label>Special Requirements or Additional Comments: <label class='charNum'></label></label>
                        <textarea class="notes" id="special_requirements" name="special_requirements" rows="4" maxlength="700"></textarea>
                    </div>
                    <div class="width_100">
                        <label>If others are bidding or if budgetary numbers are known, please explain: <label class='charNum'></label></label>
                        <textarea class="notes" id="budgetary_numbers" name="budgetary_numbers" rows="4" maxlength="700"></textarea>
                    </div>
                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                    <input class="action-button" type="submit" name="" onclick="" />
            </fieldset>
        </form>
        <!-- Temporarily used to generate fields -->
        <button type="button" id="btn_GenerateFields">Generate Test</button>
        <p><a href="./login.php">Admin</a></p>
    </body>
</html>
