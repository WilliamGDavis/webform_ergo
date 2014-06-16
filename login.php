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
                width: 50%;
                margin: 10% auto;
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
            #msform input[type=password],
            #msform textarea,
            #msform select{
                width: 60%;
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
        <script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
    </head>
    <body>
        <form id='msform' action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <img src="logo.png" style='margin-bottom: 3em;'/>
                <input type="text" placeholder='username' style='text-align: center; padding: .25em .5em;' />
                <input type="password" placeholder='password' style='text-align: center; padding: .25em .5em;' />
                <input class="action-button" type="submit" name="btn_login" onclick="location.href = './admin/index.php';" style="margin: 1em auto; display: block;" />
            </fieldset>
        </form>
    </body>
</html>
