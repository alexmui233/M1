<?php
require_once "header.php";
checklogin();

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("UPDATE user SET username= ? , nickname = ? , email = ? , password = ? , image = ?  WHERE uid = ?;");

    $param_image = $_FILES["image"];
    $image_name = upload_img($param_image);
    $param_username = test_input($_POST['username']);
    $param_nickname = test_input($_POST['nickname']);
    $param_email = test_input($_POST['email']);
    $param_password = password_hash(test_input($_POST['password']), PASSWORD_DEFAULT); // Creates a password hash

    //Bind variables to the prepared statement as parameters
    $stmt->bindParam(1, $param_username, PDO::PARAM_STR);
    $stmt->bindParam(2, $param_nickname, PDO::PARAM_STR);
    $stmt->bindParam(3, $param_email, PDO::PARAM_STR);
    $stmt->bindParam(4, $param_password, PDO::PARAM_STR);
    $stmt->bindParam(5, $image_name, PDO::PARAM_STR);
    $stmt->bindParam(6, $_SESSION['uid'], PDO::PARAM_INT);

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Redirect to myprofile page
        header("location: myprofile.php");
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $GLOBALS["appConfig"]["appTitle"] ?><?php echo (!empty($pageTitle) ? ' - ' . $pageTitle : '') ?></title>
    <!--CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/allpoll.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS only -->


    <!-- JS -->
    <script src="js/wellcome.js"></script>

</head>

<body>

    <div style="height: 100vh;  width: 100%; background-color:#39ac37; padding: 60px;">

        <div style="background-color: white; width: max-content; height: max-content; margin: 0px auto; padding: 20px; border-radius: 10px">
            <div class="profilediv">
                <h1 style="color: #39ac37;">Edit Profile</h1>
                <h2 class="">Your can edit your account information in here.</h2>
                <form class="reform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            </div>
            <br><br>

            <?php

            $stmt = $pdo->prepare("SELECT * FROM `user` WHERE uid = ?;");

            //Bind variables to the prepared statement as parameters
            $stmt->bindParam(1, $_SESSION['uid'], PDO::PARAM_INT);


            $stmt->execute();

            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $row) {

                print('<div>
                            <form class="reform" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post" enctype="multipart/form-data">
                                <fieldset class="refieldset">
                                    <div class="reformdiv">
                                        <label for="" style="">Username: </label>
                                        <input class="reformdivinput" type="text" name="username" value="' . $row['username'] . '"><br>
                                        <label for="" style="">Nickname: </label>
                                        <input class="reformdivinput" type="text" name="nickname" value="' . $row['nickname'] . '">
                                        <br>
                                        <label for="" style="">Email: </label>
                                        <input class="reformdivinput" type="email" name="email" value="' . $row['email'] . '">
                                        <br>
                                        <label for="" style="">Password: </label>
                                        <input class="reformdivinput" type="password" name="password" value="' . $row['password'] . '">
                                        <br><br>
                                        <label for="" style="">Image: </label>
                                        <img src="' . $row['image'] . '" alt="" width="60px" height="60px">
                                        <input type="file" name="image"  id="image" accept="image/jpg, image/jpeg, image/png"
                                        class="form-control" style="line-height:50px;">
                                        <br>
                                        <input class="submitbtn" type="submit" value="Update" style="cursor: pointer;">
                                        </div>
                                </fieldset>
                            </form>
                        </div>');
            }

            ?>

        </div>

    </div>

    </div>

</body>

</html>