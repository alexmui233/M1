<?php 
session_start(); 
// Include config file
require_once "config.php";
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $GLOBALS["appConfig"]["appTitle"] ?></title>
        <!--CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/wellcome.css" rel="stylesheet">
        <link href="css/events.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <!-- CSS only -->
        
        
        <!-- JS -->
        <script src="js/wellcome.js"></script>
        <script src="js/events.js"></script>
        <!-- JavaScript Bundle with Popper -->
        <style>
            .divcre {
                padding: 3.5rem 0;
                background: #39ac37;
                text-align: center;
                color: white;
            }
            h1{
                margin-bottom: 30px;
                max-width: 50rem;
                margin-left: auto;
                margin-right: auto;
                font: bold 50px "SlidoSansFont","SlidoSansFont-fallback",verdana,arial,sans-serif;
            }
            p{
                font-size: 30px; 
                font-weight: bold;
            }
            .gologinbtn{
                background-color: white;
                padding: 16px 24px; 
                border: none; 
                border-radius: 5px;
                cursor: pointer;
                margin-bottom: 15px;
                text-decoration: none;
            }
        </style>
        
    </head>
    <body>
    
        <div class="divcre">
            <h1>Register Sucessfull</h1>
            <p>Let log in to join the polls</p>
            <a class="gologinbtn" href="login.php">Log in</a>
        </div>
         
    </body>
</html>
