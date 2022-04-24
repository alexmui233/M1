<?php
session_start();
// Include config file
require_once "config.php";
require_once "function.php";

//create a key for hash_hmac function
if (empty($_SESSION['token'])){
    $_SESSION['token'] = md5(uniqid(mt_rand(), true));
}

//validate token
$token = filter_input(INPUT_POST, 'token');

?>

<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/events.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $GLOBALS["appConfig"]["appTitle"] ?><?php echo (!empty($pageTitle) ? ' - ' . $pageTitle : '') ?></title>
    <!-- JS -->
    <script src="js/events.js"></script>
</head>

<body>
    <div class="navbar">
        <a class="webname">Happy Polling</a>
        <a href="index.php">Home</a>
        <a href="createpoll.php">Create Poll</a>
        <a href="allpoll.php">All Poll</a>
        <a href="mycreatepoll.php">My Own Poll</a>
        <a href="mypoll.php">My responded Poll</a>
        <div class="dropdown" style="float: right;">
            <?php if (isset($_SESSION["username"])) { ?>
                <button class="dropbtn" onclick="droplist()">
                    <i class="bi-person-square"></i>
                    <?php echo $_SESSION['username']; ?>
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="myprofile.php">My Profile</a>
                    <a href="editprofile.php">Edit Profile</a>
                    <a href="logout.php">Log Out</a>
                </div>
            <?php } else {
            ?>
                <a href='login.php'>Log In</a>
                <a href='register.php'>Sign Up</a>
            <?php } ?>
        </div>



    </div>
</body>

</html>