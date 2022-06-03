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
  <link href="css/mypoll.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <!-- CSS only -->


  <!-- JS -->
  <script src="js/wellcome.js"></script>
  <script src="js/events.js"></script>
  <!-- JavaScript Bundle with Popper -->
</head>

<body style="background-color: #DFDFDF;">

  <div class="apdiv" style="background-color: #DFDFDF;">
    <h1>Your responded poll are here</h1>
    <h2>You can see what poll you responded are listed below</h2>

    <br>
    </h2>
  </div>

  <?php

  $stmt = $pdo->prepare("SELECT `rid`, `eid`, `aid`, `uid`, (SELECT `content` FROM `answer` WHERE answer.aid = record.aid) as answer, (SELECT `title` FROM `events` WHERE events.eid = record.eid) as title, (SELECT `question` FROM `events` WHERE events.eid = record.eid) as question FROM `record` WHERE uid = ?;");

  //Bind variables to the prepared statement as parameters
  $stmt->bindParam(1, $_SESSION['uid'], PDO::PARAM_INT);


  $stmt->execute();

  // set the resulting array to associative
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


  foreach ($data as $row) {
    print(' <div class="apbox">
              <div class="apboxcon"  style="background-color: white;">
                <div class="apboxdiv"  style="width: 440px; background-color: white;">
                        <div style="width: max-content; height: max-content; float: right;">
                          <a class="apbtn" href="update.php?eid=' . $row['eid'] . '">update</a>
                        </div>
                        <div style="width: 400px;">
                            title: ' . $row['title'] . ' <br> 
                            <div >question: ' . $row['question'] . '<br>
                            answer: ' . $row['answer'] . '
                            </div>
                        </div>
                </div>              
              </div>
            </div>
          ');
  }

  ?>

  </div>

</body>

</html>