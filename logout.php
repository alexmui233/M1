<?php
session_start();
//unset($_SESSION["username"]);
$destroy = array_keys($_SESSION);
    foreach ($destroy as $key){
        unset($_SESSION[$key]);
    }
header("Location:login.php");
?>