<?php
session_start();
//unset($_SESSION["username"]);
$destroy = array_keys($_SESSION);
    foreach ($destroy as $key){
        unset($_SESSION[$key]);
    }
setcookie("usernmae", "", time()-3600);
setcookie("password", "", time()-3600);
header("Location:login.php");
?>