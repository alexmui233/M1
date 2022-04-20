<?php
require_once "header.php";
checklogin();
?>

<!DOCTYPE html>
<html>

<head>
  
  <!--CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="css/allpoll.css" rel="stylesheet">
  <link href="css/mypoll.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

</head>

<body style="background-color: #DFDFDF;">

  <div class="apdiv" style="background-color: #DFDFDF;">
    <h1>All the poll are here</h1>
    <h2>
      Let click the repond button to vote <br>
      or view button to view the record of the poll!
      <br>
    </h2>
  </div>

  <div>
    <?php

    $stmt = $pdo->prepare("SELECT `eid`, `title`, `question`, (SELECT `username`FROM `user` WHERE user.uid = events.uid) as owner, (SELECT COUNT(uid) FROM record WHERE record.eid = events.eid) as votes FROM `events` WHERE uid != ?;");

    //Bind variables to the prepared statement as parameters
    $stmt->bindParam(1, $_SESSION['uid'], PDO::PARAM_INT);

    $stmt->execute();

    // set the resulting array to associative
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach ($data as $row) {
      print(' <div class="apbox">
                <div class="apboxcon" style="background-color: white;">
                  <div class="apboxdiv"  style="width: 440px; background-color: white;">
                    <div style="width: max-content; height: max-content; float: right;">
                      <a class="apbtn" href="view.php?eid=' . $row['eid'] . '">view</a>
                      <a class="apbtn" href="votes.php?eid=' . $row['eid'] . '">respond</a>
                    </div>
                    <div style="width: 300px;">
                        title: ' . $row['title'] . ' 
                        owner: ' . $row['owner'] . '<br>
                        votes: ' . $row['votes'] . ' <img class="svgpic" src="picture\people.svg" alt="votespic"><br>
                        <div >question: ' . $row['question'] . '</div>
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