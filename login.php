<?php
require_once "header.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
}

// Processing form data when form is submitted
//Define variables and initalise with empty values
$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!filter_input(INPUT_POST, "username")) {

        $username_err = "Please enter a username.";
    } else {
        $sql = "SELECT uid FROM user WHERE username = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $_POST['username'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                $username = $_POST["username"];
            }
        }

        // Close statement
        unset($stmt);
    }

    // Validate password
    if (!filter_input(INPUT_POST, "password")) {
        $password_err = "Please enter a password.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', test_input($_POST["password"]))) { //check the password valid
        $password_err = "Password can only contain letters, numbers, and underscores.";
    } else {
        $password = $_POST["password"];
    }

    //Validate credentials
    if (empty($username_err) && empty($password_err)) {
        //Prepare a select statement
        $sql = "SELECT uid, username, password FROM user WHERE username = ?";

        if ($stmt = $pdo->prepare($sql)) {
            //Bind variables to the prepared statement as parameters
            $stmt->bindParam(1, $username, PDO::PARAM_STR);

            //Attempt to execute the prepared statement
            if ($stmt->execute()) {

                //Check if username exists, if yes then verify password
                if ($stmt->rowCount() == 1) {
                    $fetch = $stmt->fetch();
                    $id = $fetch["uid"];
                    $username = $fetch["username"];
                    $hashed_password = $fetch["password"];

                    if (password_verify($_POST['password'], $fetch['password'])) {

                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION['username'] = $username;
                        $_SESSION['uid'] = $fetch['uid'];
                        
                        setcookie('username', $username, time() + 3600, "/", "", true, true);
                        setcookie('uid', $fetch['uid'], time() + 3600, "/", "", true, true);    
                        header("location: index.php");
                    } else {

                        $password_err = "The password you entered was not valid.";
                    }
                } else {
                    //Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close statement
    unset($stmt);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $GLOBALS["appConfig"]["appTitle"] ?><?php echo (!empty($pageTitle) ? ' - ' . $pageTitle : '') ?></title>
    <link href="css/login.css" rel="stylesheet">

</head>

<body>
    <div style="height: 100vh;  width: 100%; background-color:#39ac37">

        <div style="background-color: white; width: 600px; height: 100vh; margin: 0 auto;">
            <div class="rediv">
                <h1 style="color: #39ac37;">Happy Polling</h1>
                <h2 class="">log in <br> to join the polls.</h2>
                <p>Haven???t register yet? <a href="register.php">create your account</a></p>
            </div>
            <div>
                <form class="reform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <fieldset class="refieldset" style="height: 260px;">

                        <div class="reformdiv">
                            <input class="form-control<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" type="text" name="username" placeholder="username">
                            <br>
                            <span style="color:red; font-size: 17px"><?php echo $username_err; ?></span>
                            <br>
                            <input class="form-control<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" type="password" name="password" placeholder="Password">
                            <br>
                            <span style="color:red; font-size: 17px"><?php echo $password_err; ?></span>
                            <br>
                            <input type="hidden" name="csrf" value="<?php echo $_SESSION['token'] ?>">
                            <input type="submit" name="submit" value="Log in" style="background-color: #39ac37; padding: 16px 24px; border: none; color: white; cursor: pointer;">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>


    </div>

</body>

</html>