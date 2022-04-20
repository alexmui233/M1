<?php
require_once "header.php";
checklogin();

// Define variables and initialize with empty values
$title = $question = $uid = $anseid = $answer1 = $answer2 = $answer3 = $answer4 = "";
$title_err = $question_err = $answer1_err = $answer2_err = $answer3_err = $answer4_err = "";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate title
    if (empty(test_input($_POST["title"]))) {
        $title_err = "Please enter a title.";
    } else {
        $title = test_input($_POST["title"]);
    }

    // Validate question
    if (empty(test_input($_POST["question"]))) {
        $question_err = "Please enter a question.";
    } else {
        $question = test_input($_POST["question"]);
    }

    $ans1 = "";
    // Validate answer
    if (empty(test_input($_POST["answer1"]))) {
        $answer1_err = "Please enter question 1.";
    } 
    if (empty(test_input($_POST["answer2"]))) {
        $answer2_err = "Please enter question 2.";
    } 
    if (empty(test_input($_POST["answer3"]))) {
        $answer3_err = "Please enter question 3.";
    }
    if (empty(test_input($_POST["answer4"]))) {
        $answer4_err = "Please enter question 4.";
    } 
    if(empty($answer1_err) && empty($answer2_err) && empty($answer3_err) && empty($answer4_err)) {
        $answer1 = test_input($_POST["answer1"]);
        $answer2 = test_input($_POST["answer2"]);
        $answer3 = test_input($_POST["answer3"]);
        $answer4 = test_input($_POST["answer4"]);
    }


    $uid = $_SESSION['uid'];
    // Check input errors before inserting in database
    if (empty($title_err) && empty($question_err) && empty($answer1_err) && empty($answer2_err) && empty($answer3_err) && empty($answer4_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO events ( `title`, `question`, `uid`) VALUES ( ? , ? , ? );";

        if ($stmt = $pdo->prepare($sql)) {

            // Set parameters
            $stmt->bindParam(1, $title, PDO::PARAM_STR);
            $stmt->bindParam(2, $question, PDO::PARAM_STR);
            $stmt->bindParam(3, $uid, PDO::PARAM_INT);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }


        $sql = "SELECT max(eid) as eid FROM events";

        if ($stmt = $pdo->prepare($sql)) {

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $geteid = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($geteid) {
                    // show the publishers
                    foreach ($geteid as $addeid) {
                        //echo $addeid['eid'] . '<br>';
                        $anseid = $addeid['eid'];
                    }
                }
                //echo $anseid . '<br>';
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }

        for ($x = 0; $x < 4; $x++) {
            $sql = "INSERT INTO answer(`content`, `eid`) VALUES ( ?, ?)";
            if ($stmt = $pdo->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                switch ($x) {
                    case "0":
                        $stmt->bindParam(1, $answer1, PDO::PARAM_STR);
                        break;
                    case "1":
                        $stmt->bindParam(1, $answer2, PDO::PARAM_STR);
                        break;
                    case "2":
                        $stmt->bindParam(1, $answer3, PDO::PARAM_STR);
                        break;
                    case "3":
                        $stmt->bindParam(1, $answer4, PDO::PARAM_STR);
                        break;
                }

                $stmt->bindParam(2, $anseid, PDO::PARAM_STR);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Redirect to allpoll page
                    header("location: allpoll.php");
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                unset($stmt);
            }
        }
    }

    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="css/createpoll.css" rel="stylesheet">

    <!-- JS -->
    <script src="js/events.js"></script>

</head>

<body>


    <div style="height: 100vh;  width: 100%; background-color:#39ac37">
        <div style="background-color: white; width: 1000px; height: 1000px; margin: 0 auto;">
            <div class="rediv">
                <h1 style="color: #39ac37;">Create Polling</h1>
                <h2 class="">Create a new poll event to our online polling system.</h2>
            </div>
            <div>
                <form class="reform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <fieldset class="refieldset">
                        <div class="reformdiv" style="margin: 0 auto; width: 450px;">
                            <input class="<?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" type="text" name="title" placeholder=" title" style="cursor: text; width: 450px;" value="<?php echo $title; ?>">
                            <br>
                            <span class="" style="color:red; font-size: 17px"><?php echo $title_err; ?></span>
                            <br>
                            <input class="<?php echo (!empty($question_err)) ? 'is-invalid' : ''; ?>" type="text" name="question" placeholder=" question" style="cursor: text; width: 450px;" value="<?php echo $question; ?>">
                            <br>
                            <span class="" style="color:red; font-size: 17px"><?php echo $question_err; ?></span>
                            <br>
                            <input class="<?php echo (!empty($answer1_err)) ? 'is-invalid' : ''; ?>" type="text" name="answer1" placeholder=" answer 1" style="cursor: text; width: 450px;" value="<?php echo $answer1; ?>">
                            <br>
                            <span class="" style="color:red; font-size: 17px"><?php echo $answer1_err; ?></span>
                            <br>
                            <input class="<?php echo (!empty($answer2_err)) ? 'is-invalid' : ''; ?>" type="text" name="answer2" placeholder=" answer 2" style="cursor: text; width: 450px;" value="<?php echo $answer2; ?>">
                            <br>
                            <span class="" style="color:red; font-size: 17px"><?php echo $answer2_err; ?></span>
                            <br>
                            <input class="<?php echo (!empty($answer3_err)) ? 'is-invalid' : ''; ?>" type="text" name="answer3" placeholder=" answer 3" style="cursor: text; width: 450px;" value="<?php echo $answer3; ?>">
                            <br>
                            <span class="" style="color:red; font-size: 17px"><?php echo $answer3_err; ?></span>
                            <br>
                            <input class="<?php echo (!empty($answer4_err)) ? 'is-invalid' : ''; ?>" type="text" name="answer4" placeholder=" answer 4" style="cursor: text; width: 450px;" value="<?php echo $answer4; ?>">
                            <br>
                            <span class="" style="color:red; font-size: 17px"><?php echo $answer4_err; ?></span>
                            <br>
                            <input class="submitbtn" type="submit" value="Create" style="border: 0; padding: 0; width: 100%;">

                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

</body>

</html>