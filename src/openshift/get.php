<?php
  include_once 'config.php';

  try {
    $db = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //The currne tstatis is on the statusNow table.
    $sql = "SELECT `time`, `no2`, `co`, `volume` FROM `measurements` ORDER BY `time` DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $jsonData = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $jsonData[] = $row;
    }
    echo json_encode($jsonData);
  } catch (PDOException $e) {
    echo 'Error in sql: ' . $e->getMessage();
  }
  //Close connection.
  $dbh = null;
?>
