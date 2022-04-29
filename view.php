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
        <link href="css/view.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        
        <!-- CSS only -->
        
        
        <!-- JS -->
        <script src="js/wellcome.js"></script>
        <script src="js/events.js"></script>
        <!-- JavaScript Bundle with Popper -->
  </head>
  <body>
     
        <div style="height: 100vh;  width: 100%; background-color:#39ac37">
            
            <div style="background-color: white; width: 1000px; height: 100vh; margin: 0 auto;">
                <div class="rediv">
                        <h1 style="color: #39ac37;">Poll Result</h1>
                        <h2 class="">You can see the detail and result of poll below</h2>
                </div>
                    <div>
                        <form class="reform" action="" method="post">
                                <fieldset class="refieldset">
                                    <?php 
                                    if(isset($_GET["eid"])){
                                        $eid = $_GET["eid"];
                                        
                                        // Prepare an select statement
                                        $stmt = $pdo->prepare("SELECT `title`, `question`, (SELECT COUNT(uid) FROM record WHERE record.eid = events.eid) as votes FROM `events` WHERE eid = ?;");
                                        
                                        $stmt->bindParam(1, $eid, PDO::PARAM_STR);
                                        $stmt->execute();

                                        // set the resulting array to associative
                                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        
                                        foreach($data as $row) {
                                            print(' <div class="reformdiv" style="margin: 10px auto;">
                                                        <p style="float: left; width: 150px; margin: 0px; font-size: 16px;">title: ' . $row['title'] .'</p><p style="float: right;  margin: 0px; font-size: 16px;"> voters: ' . $row['votes'] . '<img src="picture\people.svg" alt="" class="svgpic"></p>
                                                        <br>
                                                        <p style=" margin: 0px; font-size: 16px;">question: ' . $row['question'] . '</p>
                                                        <hr>
                                                    </div>
                                                    
                                                ');
                                        }
                                        // Close statement
                                        unset($stmt);

                                        // Prepare an select statement
                                        $stmt = $pdo->prepare("SELECT answer.content, (count(record.aid) * 100.0 / sum(count(record.aid)) over()) as per FROM answer LEFT JOIN record ON answer.aid = record.aid WHERE answer.eid = ? GROUP BY answer.aid;");
                                                                                
                                        $stmt->bindParam(1, $eid, PDO::PARAM_STR);
                                        $stmt->execute();

                                        // set the resulting array to associative
                                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach($data as $row) {
                                            print(' <div class="reformdiv" style="margin: 10px auto;">
                                                        <label style="width: 550px; display: flex; justify-content: space-between;  margin: 10px auto; padding:0px">
                                                            <span>'. $row['content'] .'</span>
                                                            <span id="viewper">' . number_format($row['per'], 2). '%</span>
                                                        </label>
                                                        <div style=" display: flex; height: 1rem; overflow: hidden; line-height: 0; font-size: .75rem; background-color: #e9ecef; border-radius: 0.25rem;">
                                                            <div class="" style="width: ' . number_format($row['per'], 2). '%; background-color: #39ac37; background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
                                                                    background-size: 1rem 1rem;"></div>
                                                        </div>
                                                        <br>
                                                    </div>
                                                ');
                                        }
                                     }?>
                                        
                                </fieldset>
                        </form>
                    </div>
            </div>
            
        
        </div>

  </body>
</html>