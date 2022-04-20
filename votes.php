<?php
require_once "header.php";
checklogin();

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $eid = $_POST['eid'];
    $aid = $_POST['mc'];

    // Prepare an select statement
    $stmt = $pdo->prepare("INSERT INTO `record`(`eid`, `aid`, `uid`) VALUES (?, ?, ?);");

    $stmt->bindParam(1, $eid, PDO::PARAM_STR);
    $stmt->bindParam(2, $aid, PDO::PARAM_STR);
    $stmt->bindParam(3, $_SESSION['uid'], PDO::PARAM_STR);

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Redirect to mypoll page
        header("location: mypoll.php");
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

    <link href="css/votes.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS only -->


    <!-- JS -->
    <script src="js/wellcome.js"></script>
    <script src="js/events.js"></script>
    <!-- JavaScript Bundle with Popper -->


</head>

<body>

    <div style="height: 100vh;  width: 100%; background-color:#39ac37">

        <div style="background-color: white; width: 800px; height: 100vh; margin: 0 auto;">
            <div class="votesdiv">
                <h1 style="padding-top: 33.5px;">Poll Respond</h1>
                <h2>You can respond the below poll and<br>
                    submit the result by respond button</h2>
            </div>
            <div>
                <form class="reform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <fieldset class="refieldset">
                        <div class="reformdiv section1">
                            <?php
                            if (isset($_GET["eid"])) {
                                $eid = $_GET["eid"];

                                // Prepare an select statement
                                $stmt = $pdo->prepare("SELECT `eid`, `title`, `question`, (SELECT `username`FROM `user` WHERE user.uid = events.uid) as owner, (SELECT COUNT(uid) FROM record WHERE record.eid = events.eid) as votes FROM `events`  WHERE eid = ?");

                                $stmt->bindParam(1, $eid, PDO::PARAM_STR);
                                $stmt->execute();

                                // set the resulting array to associative
                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


                                foreach ($data as $row) {
                                    print(' <label for="" style="width: max-content;">title: ' . $row['title'] . '</label><br>
                                                            <label for="" style="width: max-content;">owner: ' . $row['owner'] . '</label><br>
                                                            <label for="" style="width: max-content;">question: ' . $row['question'] . '</label>
                                                            <br>
                                                        ');
                                }
                                // Close statement
                                unset($stmt);
                                // Prepare an select statement
                                $stmt = $pdo->prepare("SELECT `aid`, `content`, `eid` FROM `answer` WHERE eid = ?;");

                                $stmt->bindParam(1, $eid, PDO::PARAM_STR);

                                // Attempt to execute the prepared statement
                                if ($stmt->execute()) {
                                    // set the resulting array to associative
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($data as $row) {
                                        print(' <input type="radio" id="' . $row['content'] . '" name="mc" value="' . $row['aid'] . '">
                                                                <label for="' . $row['content'] . '">' . $row['content'] . '</label><br>
                                                        
                                                            ');
                                    }
                                    print('<input class="submitbtn" type="submit" value="Respond">
                                                           <input type="text" name="eid" value="' . $eid . '" style="display: none">
                                                        ');
                                } else {
                                    echo "Oops! Something went wrong. Please try again later.";
                                }
                            }
                            ?>

                        </div>
                    </fieldset>
                </form>
            </div>

        </div>

    </div>

</body>

</html>