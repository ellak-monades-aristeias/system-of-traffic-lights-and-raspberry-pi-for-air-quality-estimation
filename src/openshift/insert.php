<?php
  include_once 'config.php';

  $userU = NULL;
  $passU = NULL;
  //Check if the user name and password have been set.
  if (isset($_GET["userU"]) && isset($_GET["passU"]) ) {
    $userU  = $_GET["userU"];
    $passU  = $_GET["passU"];
  }

  if ($userU!=NULL && $passU!=NULL) {
    //Check if they are correct.
    try {
      $db = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT count(*) AS `c` FROM `users` WHERE `username`=:userU AND `password`=:passU";
      $stmt = $db->prepare($sql);
      $stmt->bindParam(':userU', $userU);
      $stmt->bindParam(':passU', $passU);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row['c']!=1) {
        //Wrong username or password.
        $userU = NULL;
        $passU = NULL;
      }
    } catch (PDOException $e) {
      echo 'Error in sql: ' . $e->getMessage();
    }
    //Close connection.
    $dbh = null;
  }

  if (is_null($userU) or is_null($passU)) {
    echo "Wrong user name or password";
    return;
  }

  $time   = NULL;
  $no2    = NULL;
  $co     = NULL;
  $volume = NULL;
  if (isset($_GET['time']) && isset($_GET['no2']) && isset($_GET['co']) && isset($_GET['volume'])) {
    $time   = $_GET['time'];
    $no2    = $_GET['no2'];
    $co     = $_GET['co'];
    $volume = $_GET['volume'];

    try {
      $db = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $sql = "INSERT INTO `measurements`(`time`, `no2`, `co`, `volume`) "
      ."VALUES (:time, :no2, :co, :volume)";
      $stmt = $db->prepare($sql);
      $stmt->bindParam(':time',  $time);
      $stmt->bindParam(':no2', $no2);
      $stmt->bindParam(':co',  $co);
      $stmt->bindParam(':volume', $volume);
      $stmt->execute();
      $statusIdNow  = NULL;
      $statusIdNext = NULL;
      echo "Insert OK";
    } catch (PDOException $e) {
      echo 'Error in sql: ' . $e->getMessage();
    }
    //Close connection.
    $$dbh = null;
  }
?>
