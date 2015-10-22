<?php
  include_once 'config.php';

  try {
    $db = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //The currne tstatis is on the statusNow table.
    $sql = "SELECT `time`, `no2`, `co`, `volume` FROM `measurements` ORDER BY `time` DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    echo "<table>";
    echo "<tr> <td>Time</td> <td>NO2</td> <td>CO</td> <td>Volume</td> </tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $time   = $row['time'];
      $no2    = $row['no2'];
      $co     = $row['co'];
      $volume = $row['volume'];
      echo "<tr> <td>$time</td> <td>$no2</td> <td>$co</td> <td>$volume</td> </tr>";
    }
    echo "</table>";
  } catch (PDOException $e) {
    echo 'Error in sql: ' . $e->getMessage();
  }
  //Close connection.
  $dbh = null;
?>
