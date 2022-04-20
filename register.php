<?php 
require_once "header.php";

// Check if the user is already logged in, if yes then redirect him to event page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
}

// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = $nickname = "";
$username_err = $password_err = $confirm_password_err = $email_err = $nickname_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate username
    if(empty(test_input($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', test_input($_POST["username"]))){//check the username valid
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT uid FROM user WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = test_input($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = test_input($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Validate nickname
    if(empty(test_input($_POST["nickname"]))){
        $nickname_err = "Please enter a nickname.";     
    } else{
        $nickname = test_input($_POST["nickname"]);  
    }

    // Validate email
    if(empty(test_input($_POST["email"]))){
        $email_err = "Please enter a email.";     
    }else if (!filter_var(test_input($_POST["email"]), FILTER_VALIDATE_EMAIL))  {
        // check if e-mail address is well-formed
        $email_err = "Invalid email format";
    } else{
        // Prepare a select statement
        $sql = "SELECT uid FROM user WHERE email = :email";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = test_input($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = test_input($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }


    // Validate password
    if(empty(test_input($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(test_input($_POST["password"])) < 3){//check password length
        $password_err = "Password must have at least 3 characters.";
    } else{
        $password = test_input($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(test_input($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = test_input($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){//check the password match confirm password
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)  && empty($nickname_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user (`username`, `nickname`, `email`, `password`, `image`) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $param_image = $_FILES["image"];
            $image_name = upload_img($param_image);

            // Set parameters
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->bindParam(2, $nickname, PDO::PARAM_STR);
            $stmt->bindParam(3, $email, PDO::PARAM_STR);
            $stmt->bindParam(4, $param_password, PDO::PARAM_STR);
            $stmt->bindParam(5, $image_name, PDO::PARAM_STR);

            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to register success page
                header("location: registersuccess.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <title><?php echo $GLOBALS["appConfig"]["appTitle"] ?><?php echo (!empty($pageTitle) ? ' - ' . $pageTitle : '') ?></title>
        <link href="css/register.css" rel="stylesheet">
        
    </head>
    <body>
        <div style="height: 100vh;  width: 100%; background-color:#39ac37">
            
            <div style="background-color: white; width: 700px; height: 1000px; margin: 0 auto;">
                <div class="rediv">
                        <h1 style="color: #39ac37;">Happy Polling</h1>
                        <h2 class="">Register as a user <br> to join the polls.</h2>
                        <p style="font-size: bold;">or aleady have an account, let <a href="login.php">log in</a> your account.</p>
                </div>
                    <div>
                        <form class="reform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                <fieldset class="refieldset" style="height: 590px;">
                                    
                                    <div class="reformdiv">
                                        <input class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" type="text" name="username" placeholder="username">
                                        <br>
                                        <span class="" style="color:red; font-size: 17px"><?php echo $username_err; ?></span>
                                        <br>
                                        <input class="form-control <?php echo (!empty($nickname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nickname; ?>" type="text" name="nickname" placeholder="Nick Name">
                                        <br>
                                        <span class="" style="color:red; font-size: 17px"><?php echo $nickname_err; ?></span>
                                        <br>
                                        <input class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" type="email" name="email" placeholder="Email">
                                        <br>
                                        <span class="" style="color:red; font-size: 17px"><?php echo $email_err; ?></span>
                                        <br>
                                        <input class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" type="password" name="password" placeholder="Password">
                                        <br>
                                        <span class="" style="color:red; font-size: 17px"><?php echo $password_err; ?></span>
                                        <br>
                                        <input class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" type="password" name="confirm_password" placeholder="Confirm Password">
                                        <br>
                                        <span class="" style="color:red; font-size: 17px"><?php echo $confirm_password_err; ?></span>
                                        <br>
                                        <input type="file" name="image"  id="image" accept="image/jpg, image/jpeg, image/png"
                                        class="form-control <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>"style="line-height:50px;">
                                        <br>
                                        <span class="" style="color:red; font-size: 17px"><?php ?></span>
                                        <br>
                                        <input class="submitbtn" type="submit" value="Create account" style="border: none; cursor: pointer;">
                                    </div>
                                </fieldset>
                        </form>
                    </div>
            </div>
            
        
        </div>
        
    </body>
</html>