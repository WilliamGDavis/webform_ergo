<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ergomatic Form</title>
        <script src="../js/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="../js/masked_input.js" type="text/javascript"></script>
        <script src="../js/functions.js" type="text/javascript"></script>
        <link href="../css/normalize.css" rel="stylesheet" type="text/css" />
        <style>
            *{box-sizing: border-box;}
            #sidebar_left{
                width: 30%;
                float: left;
                border: 1px solid red;
            }
            #sidebar_right{
                width: 70%;
                float: left;
                border: 1px solid blue;
            }
        </style>
    </head>
    <body>
        <div>
            <div id="sidebar_left">
                <button type="button" id="btn_GetRFQ">Get RFQs</button>
            </div>
            <div id="sidebar_right">
                <!-- Widgets placeholder -->
                <div id="widget_rfq"></div>
                <div id="widget_"></div>
            </div>
        </div>
    </body>
</html>
