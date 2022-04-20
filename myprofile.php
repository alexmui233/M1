<?php
require_once "header.php";
checklogin();
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
    <script src="js/events.js"></script>
    <!-- JavaScript Bundle with Popper -->
</head>

<body>


    <div style="height: 100vh;  width: 100%; background-color:#39ac37; padding: 60px;" >

        <div style="background-color: white; width: max-content; height: max-content; margin: 0px auto; padding: 20px;  border-radius: 10px">
            <div class="profilediv">
                <h1 style="color: #39ac37;">My Profile</h1>
                <h2 class="">Your can view your account information in here.</h2>
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
                            <form class="reform" action="">
                                    <fieldset class="refieldset">
                                        
                                        <div class="reformdiv">
                                            <label for="" style="">Username: </label>
                                            <input class="reformdivinput" type="text" name="username" value="' . $row['username'] . '" readonly><br>
                                            <label for="" style="">Nickname: </label>
                                            <input class="reformdivinput" type="text" name="nickname" value="' . $row['nickname'] . '" readonly>
                                            <br>
                                            <label for="" style="">Email: </label>
                                            <input class="reformdivinput" type="email" name="email" value="' . $row['email'] . '" readonly>
                                            <br>
                                            <label for="" style="">Password: </label>
                                            <input class="reformdivinput" type="password" name="password" value="' . $row['password'] . '" readonly>
                                            <br><br>
                                            <label for="" style="">Image: </label>
                                            <img src="' . $row['image'] . '" alt="" width="60px" height="60px">
                                            
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