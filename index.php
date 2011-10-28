<?php 
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Captcha Sample</title>
        <style>
            html, body, div {
                border: 0 none;
                font: inherit;
                margin: 0;
                outline: 0 none;
                padding: 0;
                vertical-align: baseline;
            }

            body {
            }

            header {
                text-align: center;
            }

            h1 {
                font-size: 2em;
                letter-spacing: -2px;
                line-height: 1;
                word-spacing: 2px;
            }

            div#content {
                background: none repeat scroll 0 0 #FFFFFF;
                padding: 30px 0 0;
                margin: 0 auto;
                width: 600px;
            }

            code {
                background: #F0F0F0;
                border: 1px solid #CCC;
                display: block;
                font-family: Monaco, Consolas, monospace;
                font-size: 12px;
                padding: 20px;
                margin: 0 auto;
            }
        </style>
    </head>

    <body>
        <header>
            <h1>Captcha Sample</h1>
        </header>
        <div id="content">
            <img src="./code.php" />
            <br/>
            <?php
            $content = highlight_file('code.php');
            ?>
            <br style="clear: both" />
        </div>
    </body>
</html>

