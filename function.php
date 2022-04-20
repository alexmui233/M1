<?php
 
function checklogin(){
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(!isset($_SESSION["loggedin"])){
        header("location: login.php");
        exit;
    }

}

function upload_img($profile_image){
    
    $profileImageName = time().'-'.$profile_image["name"]; //set the image name with time
    $target_dir = $_SERVER['DOCUMENT_ROOT']."/M1/upload/"; //The path to save image
    $move_file = $_SERVER['DOCUMENT_ROOT']."/M1/upload/" . basename($profileImageName); //The path to save image plus the image name
    $target_file = "upload/".basename($profileImageName); //the image name in database 

    if(is_writable($target_dir)){//checks whether the specified filename is writable
        move_uploaded_file($profile_image["tmp_name"],$move_file);
        return $target_file;
    }else
    {
        return "The directory cannot write.";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
