<?php
require_once "header.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $GLOBALS["appConfig"]["appTitle"] ?></title>
    <!--CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/events.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- JS -->
    <script src="js/events.js"></script>
    <style>
        
        .divcre a:hover {
            background-color: black;
            color: white;
        }

        .divall a:hover {
            background-color: black;
            color: white;
        }

        .joinbtn {
            width: 250px;
            margin: 0 auto;
            background-color: #39ac37;
            border-radius: 10px;
            border-color: #39ac37;
            padding: 15px 25px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

</head>

<body>
    <div class="bg" style="background-image: url('picture/wellcomebg.jpg');">
    
        <div style="margin: 0 auto; width: max-content; height:max-content;">
        <p class="" style="margin: 0 auto; font-size: 70px; padding: 3.5rem 0; padding-top: 200px;">Wellcome to Happy polling.</p>
        </div>
    </div>
    <div class="divcre">
        <h1 style="width: 1100px; text-align: center;">Get Ready To Create A New Poll?</h1>
        <p>Here you can create your own poll events.
            <br><br>
            Let click the button to create!
        </p>
        <a class="createbtn" href="createpoll.php" style="font-size: 20px; text-decoration: none;">Create</a>
    </div>

    <div class="divall" style="padding: 3.5rem 0; background-color: #f5f5f5; text-align: center; color: #39ac37;">
        <h1 style="width: 1100px; text-align: center;">DO you want to join any poll events?</h1>

        <p style="text-align: center;">Here you can view all poll events.
            <br><br>
            Let click the button to view and join!
        </p>
        <a class="joinbtn" href="allpoll.php" style="font-size: 20px; text-decoration: none;">Join</a>
    </div>
    <div class="divall" style="padding: 3.5rem 0; background-color: white; text-align: center; color: black;">
        <h1 style="width: 1100px; text-align: center;">Already have a poll events?</h1>

        <p style="text-align: center;">Here you can view your own poll events.
            <br><br>
            Let click the button to view!
        </p>
        <a class="joinbtn" href="mypoll.php" style="font-size: 20px; text-decoration: none;">View</a>
    </div>
</body>

</html>