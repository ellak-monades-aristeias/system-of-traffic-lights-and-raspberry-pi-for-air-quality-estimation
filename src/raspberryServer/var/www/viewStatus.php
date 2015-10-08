<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Status configuration</title>
  </head>
  <body>

    <?php
      include_once 'config.php';
      $userU = NULL;
      $passU = NULL;
      //Check if the user name and password have been set.
      if (isset($_POST["userU"]) && isset($_POST["passU"]) ) {
        $userU   = $_POST["userU"];
        $passU  = $_POST["passU"];
        //Check if they are correct.
        try {
          $db = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "SELECT count(*) AS c FROM users WHERE `username`=:userU AND `password`=:passU";
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
    ?>

    <?php
      //If the password or username is not set or are not correct, display the login form.
      if (is_null($userU) or is_null($passU)) {
    ?>
        <form method="POST" action="">
          <table>
            <tr>
              <td>UserId: </td>
              <td><input type="text" name="userU"></td>
            </tr>
            <tr>
              <td>Password: </td>
              <td><input type="text" name="passU"></td>
            </tr>
            <tr>
              <td> <input type="submit" name="submit1" value="Login"/> </td>
              <td></td>
            </tr>
          </table>
        </FORM>
    <?php
        echo '</body></html>';
        return;
      }
    ?>

    <?php
      //If here, the username and pass are correct.

      //Check if the a new status is provided.

      $statusId = NULL;
      $straightGreen1  = false;
      $straightYellow1 = false;
      $straightRed1    = false;
      $leftGreen1      = false;
      $leftYellow1     = false;
      $leftRed1        = false;
      $rightGreen1     = false;
      $rightYellow1    = false;
      $rightRed1       = false;
      $walkLrGreen1    = false;
      $walkLrRed1      = false;
      $walkUdGreen1    = false;
      $walkUdRed1      = false;

      $straightGreen2  = false;
      $straightYellow2 = false;
      $straightRed2    = false;
      $leftGreen2      = false;
      $leftYellow2     = false;
      $leftRed2        = false;
      $rightGreen2     = false;
      $rightYellow2    = false;
      $rightRed2       = false;
      $walkLrGreen2    = false;
      $walkLrRed2      = false;
      $walkUdGreen2    = false;
      $walkUdRed2      = false;

      $straightGreen3  = false;
      $straightYellow3 = false;
      $straightRed3    = false;
      $leftGreen3      = false;
      $leftYellow3     = false;
      $leftRed3        = false;
      $rightGreen3     = false;
      $rightYellow3    = false;
      $rightRed3       = false;
      $walkLrGreen3    = false;
      $walkLrRed3      = false;
      $walkUdGreen3    = false;
      $walkUdRed3      = false;

      $straightGreen4  = false;
      $straightYellow4 = false;
      $straightRed4    = false;
      $leftGreen4      = false;
      $leftYellow4     = false;
      $leftRed4        = false;
      $rightGreen4     = false;
      $rightYellow4    = false;
      $rightRed4       = false;
      $walkLrGreen4    = false;
      $walkLrRed4      = false;
      $walkUdGreen4    = false;
      $walkUdRed4      = false;
      if (isset($_POST['statusId'])) {
        $statusId = $_POST['statusId'];

        if (isset($_POST['straightGreen1'])) {
          $straightGreen1 = true;
        }
        if (isset($_POST['straightYellow1'])) {
          $straightYellow1 = true;
        }
        if (isset($_POST['straightRed1'])) {
          $straightRed1 = true;
        }
        if (isset($_POST['leftGreen1'])) {
          $leftGreen1 = true;
        }
        if (isset($_POST['leftYellow1'])) {
          $leftYellow1 = true;
        }
        if (isset($_POST['leftRed1'])) {
          $leftRed1 = true;
        }
        if (isset($_POST['rightGreen1'])) {
          $rightGreen1 = true;
        }
        if (isset($_POST['rightYellow1'])) {
          $rightYellow1 = true;
        }
        if (isset($_POST['rightRed1'])) {
          $rightRed1 = true;
        }
        if (isset($_POST['walkLrGreen1'])) {
          $walkLrGreen1 = true;
        }
        if (isset($_POST['walkLrRed1'])) {
          $walkLrRed1 = true;
        }
        if (isset($_POST['walkUdGreen1'])) {
          $walkUdGreen1 = true;
        }
        if (isset($_POST['walkUdRed1'])) {
          $walkUdRed1 = true;
        }

        if (isset($_POST['straightGreen2'])) {
          $straightGreen2 = true;
        }
        if (isset($_POST['straightYellow2'])) {
          $straightYellow2 = true;
        }
        if (isset($_POST['straightRed2'])) {
          $straightRed2 = true;
        }
        if (isset($_POST['leftGreen2'])) {
          $leftGreen2 = true;
        }
        if (isset($_POST['leftYellow2'])) {
          $leftYellow2 = true;
        }
        if (isset($_POST['leftRed2'])) {
          $leftRed2 = true;
        }
        if (isset($_POST['rightGreen2'])) {
          $rightGreen2 = true;
        }
        if (isset($_POST['rightYellow2'])) {
          $rightYellow2 = true;
        }
        if (isset($_POST['rightRed2'])) {
          $rightRed2 = true;
        }
        if (isset($_POST['walkLrGreen2'])) {
          $walkLrGreen2 = true;
        }
        if (isset($_POST['walkLrRed2'])) {
          $walkLrRed2 = true;
        }
        if (isset($_POST['walkUdGreen2'])) {
          $walkUdGreen2 = true;
        }
        if (isset($_POST['walkUdRed2'])) {
          $walkUdRed2 = true;
        }

        if (isset($_POST['straightGreen3'])) {
          $straightGreen3 = true;
        }
        if (isset($_POST['straightYellow3'])) {
          $straightYellow3 = true;
        }
        if (isset($_POST['straightRed3'])) {
          $straightRed3 = true;
        }
        if (isset($_POST['leftGreen3'])) {
          $leftGreen3 = true;
        }
        if (isset($_POST['leftYellow3'])) {
          $leftYellow3 = true;
        }
        if (isset($_POST['leftRed3'])) {
          $leftRed3 = true;
        }
        if (isset($_POST['rightGreen3'])) {
          $rightGreen3 = true;
        }
        if (isset($_POST['rightYellow3'])) {
          $rightYellow3 = true;
        }
        if (isset($_POST['rightRed3'])) {
          $rightRed3 = true;
        }
        if (isset($_POST['walkLrGreen3'])) {
          $walkLrGreen3 = true;
        }
        if (isset($_POST['walkLrRed3'])) {
          $walkLrRed3 = true;
        }
        if (isset($_POST['walkUdGreen3'])) {
          $walkUdGreen3 = true;
        }
        if (isset($_POST['walkUdRed3'])) {
          $walkUdRed3 = true;
        }

        if (isset($_POST['straightGreen4'])) {
          $straightGreen4 = true;
        }
        if (isset($_POST['straightYellow4'])) {
          $straightYellow4 = true;
        }
        if (isset($_POST['straightRed4'])) {
          $straightRed4 = true;
        }
        if (isset($_POST['leftGreen4'])) {
          $leftGreen4 = true;
        }
        if (isset($_POST['leftYellow4'])) {
          $leftYellow4 = true;
        }
        if (isset($_POST['leftRed4'])) {
          $leftRed4 = true;
        }
        if (isset($_POST['rightGreen4'])) {
          $rightGreen4 = true;
        }
        if (isset($_POST['rightYellow4'])) {
          $rightYellow4 = true;
        }
        if (isset($_POST['rightRed4'])) {
          $rightRed4 = true;
        }
        if (isset($_POST['walkLrGreen4'])) {
          $walkLrGreen4 = true;
        }
        if (isset($_POST['walkLrRed4'])) {
          $walkLrRed4 = true;
        }
        if (isset($_POST['walkUdGreen4'])) {
          $walkUdGreen4 = true;
        }
        if (isset($_POST['walkUdRed4'])) {
          $walkUdRed4 = true;
        }

        //Insert int database.
        try {
          $db = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
          $sql = "INSERT INTO `status`(`id`, "
          ."`straightGreen1`, `straightYellow1`, `straightRed1`, `leftGreen1`, `leftYellow1`, `leftRed1`, `rightGreen1`, `rightYellow1`, `rightRed1`, `walkLrGreen1`, `walkLrRed1`, `walkUdGreen1`, `walkUdRed1`, "
          ."`straightGreen2`, `straightYellow2`, `straightRed2`, `leftGreen2`, `leftYellow2`, `leftRed2`, `rightGreen2`, `rightYellow2`, `rightRed2`, `walkLrGreen2`, `walkLrRed2`, `walkUdGreen2`, `walkUdRed2`, "
          ."`straightGreen3`, `straightYellow3`, `straightRed3`, `leftGreen3`, `leftYellow3`, `leftRed3`, `rightGreen3`, `rightYellow3`, `rightRed3`, `walkLrGreen3`, `walkLrRed3`, `walkUdGreen3`, `walkUdRed3`, "
          ."`straightGreen4`, `straightYellow4`, `straightRed4`, `leftGreen4`, `leftYellow4`, `leftRed4`, `rightGreen4`, `rightYellow4`, `rightRed4`, `walkLrGreen4`, `walkLrRed4`, `walkUdGreen4`, `walkUdRed4`"
          .") VALUES (:statusId, "
          .":straightGreen1, :straightYellow1, :straightRed1, :leftGreen1, :leftYellow1, :leftRed1, :rightGreen1, :rightYellow1, :rightRed1, :walkLrGreen1, :walkLrRed1, :walkUdGreen1, :walkUdRed1, "
          .":straightGreen2, :straightYellow2, :straightRed2, :leftGreen2, :leftYellow2, :leftRed2, :rightGreen2, :rightYellow2, :rightRed2, :walkLrGreen2, :walkLrRed2, :walkUdGreen2, :walkUdRed2, "
          .":straightGreen3, :straightYellow3, :straightRed3, :leftGreen3, :leftYellow3, :leftRed3, :rightGreen3, :rightYellow3, :rightRed3, :walkLrGreen3, :walkLrRed3, :walkUdGreen3, :walkUdRed3, "
          .":straightGreen4, :straightYellow4, :straightRed4, :leftGreen4, :leftYellow4, :leftRed4, :rightGreen4, :rightYellow4, :rightRed4, :walkLrGreen4, :walkLrRed4, :walkUdGreen4, :walkUdRed4"
          .")";
          $stmt = $db->prepare($sql);
          $stmt->bindParam(':statusId',        $statusId);
          $stmt->bindParam(':straightGreen1',  $straightGreen1);
          $stmt->bindParam(':straightYellow1', $straightYellow1);
          $stmt->bindParam(':straightRed1',    $straightRed1);
          $stmt->bindParam(':leftGreen1',      $leftGreen1);
          $stmt->bindParam(':leftYellow1',     $leftYellow1);
          $stmt->bindParam(':leftRed1',        $leftRed1);
          $stmt->bindParam(':rightGreen1',     $rightGreen1);
          $stmt->bindParam(':rightYellow1',    $rightYellow1);
          $stmt->bindParam(':rightRed1',       $rightRed1);
          $stmt->bindParam(':walkLrGreen1',    $walkLrGreen1);
          $stmt->bindParam(':walkLrRed1',      $walkLrRed1);
          $stmt->bindParam(':walkUdGreen1',    $walkUdGreen1);
          $stmt->bindParam(':walkUdRed1',      $walkUdRed1);
          $stmt->bindParam(':straightGreen2',  $straightGreen2);
          $stmt->bindParam(':straightYellow2', $straightYellow2);
          $stmt->bindParam(':straightRed2',    $straightRed2);
          $stmt->bindParam(':leftGreen2',      $leftGreen2);
          $stmt->bindParam(':leftYellow2',     $leftYellow2);
          $stmt->bindParam(':leftRed2',        $leftRed2);
          $stmt->bindParam(':rightGreen2',     $rightGreen2);
          $stmt->bindParam(':rightYellow2',    $rightYellow2);
          $stmt->bindParam(':rightRed2',       $rightRed2);
          $stmt->bindParam(':walkLrGreen2',    $walkLrGreen2);
          $stmt->bindParam(':walkLrRed2',      $walkLrRed2);
          $stmt->bindParam(':walkUdGreen2',    $walkUdGreen2);
          $stmt->bindParam(':walkUdRed2',      $walkUdRed2);
          $stmt->bindParam(':straightGreen3',  $straightGreen3);
          $stmt->bindParam(':straightYellow3', $straightYellow3);
          $stmt->bindParam(':straightRed3',    $straightRed3);
          $stmt->bindParam(':leftGreen3',      $leftGreen3);
          $stmt->bindParam(':leftYellow3',     $leftYellow3);
          $stmt->bindParam(':leftRed3',        $leftRed3);
          $stmt->bindParam(':rightGreen3',     $rightGreen3);
          $stmt->bindParam(':rightYellow3',    $rightYellow3);
          $stmt->bindParam(':rightRed3',       $rightRed3);
          $stmt->bindParam(':walkLrGreen3',    $walkLrGreen3);
          $stmt->bindParam(':walkLrRed3',      $walkLrRed3);
          $stmt->bindParam(':walkUdGreen3',    $walkUdGreen3);
          $stmt->bindParam(':walkUdRed3',      $walkUdRed3);
          $stmt->bindParam(':straightGreen4',  $straightGreen4);
          $stmt->bindParam(':straightYellow4', $straightYellow4);
          $stmt->bindParam(':straightRed4',    $straightRed4);
          $stmt->bindParam(':leftGreen4',      $leftGreen4);
          $stmt->bindParam(':leftYellow4',     $leftYellow4);
          $stmt->bindParam(':leftRed4',        $leftRed4);
          $stmt->bindParam(':rightGreen4',     $rightGreen4);
          $stmt->bindParam(':rightYellow4',    $rightYellow4);
          $stmt->bindParam(':rightRed4',       $rightRed4);
          $stmt->bindParam(':walkLrGreen4',    $walkLrGreen4);
          $stmt->bindParam(':walkLrRed4',      $walkLrRed4);
          $stmt->bindParam(':walkUdGreen4',    $walkUdGreen4);
          $stmt->bindParam(':walkUdRed4',      $walkUdRed4);
          $stmt->execute();
          
          //If executed sucessfully, do not show them on the input fields.
          $statusId = NULL;
          $straightGreen1  = false;
          $straightYellow1 = false;
          $straightRed1    = false;
          $leftGreen1      = false;
          $leftYellow1     = false;
          $leftRed1        = false;
          $rightGreen1     = false;
          $rightYellow1    = false;
          $rightRed1       = false;
          $walkLrGreen1    = false;
          $walkLrRed1      = false;
          $walkUdGreen1    = false;
          $walkUdRed1      = false;

          $straightGreen2  = false;
          $straightYellow2 = false;
          $straightRed2    = false;
          $leftGreen2      = false;
          $leftYellow2     = false;
          $leftRed2        = false;
          $rightGreen2     = false;
          $rightYellow2    = false;
          $rightRed2       = false;
          $walkLrGreen2    = false;
          $walkLrRed2      = false;
          $walkUdGreen2    = false;
          $walkUdRed2      = false;

          $straightGreen3  = false;
          $straightYellow3 = false;
          $straightRed3    = false;
          $leftGreen3      = false;
          $leftYellow3     = false;
          $leftRed3        = false;
          $rightGreen3     = false;
          $rightYellow3    = false;
          $rightRed3       = false;
          $walkLrGreen3    = false;
          $walkLrRed3      = false;
          $walkUdGreen3    = false;
          $walkUdRed3      = false;

          $straightGreen4  = false;
          $straightYellow4 = false;
          $straightRed4    = false;
          $leftGreen4      = false;
          $leftYellow4     = false;
          $leftRed4        = false;
          $rightGreen4     = false;
          $rightYellow4    = false;
          $rightRed4       = false;
          $walkLrGreen4    = false;
          $walkLrRed4      = false;
          $walkUdGreen4    = false;
          $walkUdRed4      = false;
        } catch (PDOException $e) {
          echo 'Error in sql: ' . $e->getMessage();
        }
        //Close connection.
        $dbh = null;
      }
    ?>

    <form method="POST" action="statusConfiguration.php">
      <input type="hidden" name="userU" value="<?php echo $userU; ?>" />
      <input type="hidden" name="passU" value="<?php echo $passU; ?>" />
      <input type="submit" name="submit" value="Go back"/>
    </form>
    
    <form method="POST" action="">
      <table border="1">
        <tr>
          <td>Light</td>
          <td colspan="3">Straight</td>
          <td colspan="3">Left</td>
          <td colspan="3">Right</td>
          <td colspan="2">LeftRightWalk</td>
          <td colspan="2">UpDownWalk</td>
        </tr>
        <tr>
          <td></td>
          <td>Green</td>
          <td>Yellow</td>
          <td>Red</td>
          <td>Green</td>
          <td>Yellow</td>
          <td>Red</td>
          <td>Green</td>
          <td>Yellow</td>
          <td>Red</td>
          <td>Green</td>
          <td>Red</td>
          <td>Green</td>
          <td>Red</td>
        </tr>
        <tr>
          <td>1</td>
          <td> <input type="checkbox" name="straightGreen1"  value="1" <?php  if($straightGreen1) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="straightYellow1" value="1" <?php  if($straightYellow1) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="straightRed1"    value="1" <?php  if($straightRed1) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="leftGreen1"      value="1" <?php  if($leftGreen1) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="leftYellow1"     value="1" <?php  if($leftYellow1) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="leftRed1"        value="1" <?php  if($leftRed1) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="rightGreen1"     value="1" <?php  if($rightGreen1) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="rightYellow1"    value="1" <?php  if($rightYellow1) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="rightRed1"       value="1" <?php  if($rightRed1) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkLrGreen1"    value="1" <?php  if($walkLrGreen1) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkLrRed1"      value="1" <?php  if($walkLrRed1) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkUdGreen1"    value="1" <?php  if($walkUdGreen1) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkUdRed1"      value="1" <?php  if($walkUdRed1) echo 'checked="1"'; ?>/> </td>
        </tr>
        <tr>
          <td>2</td>
          <td> <input type="checkbox" name="straightGreen2"  value="1" <?php  if($straightGreen2) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="straightYellow2" value="1" <?php  if($straightYellow2) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="straightRed2"    value="1" <?php  if($straightRed2) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="leftGreen2"      value="1" <?php  if($leftGreen2) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="leftYellow2"     value="1" <?php  if($leftYellow2) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="leftRed2"        value="1" <?php  if($leftRed2) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="rightGreen2"     value="1" <?php  if($rightGreen2) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="rightYellow2"    value="1" <?php  if($rightYellow2) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="rightRed2"       value="1" <?php  if($rightRed2) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkLrGreen2"    value="1" <?php  if($walkLrGreen2) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkLrRed2"      value="1" <?php  if($walkLrRed2) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkUdGreen2"    value="1" <?php  if($walkUdGreen2) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkUdRed2"      value="1" <?php  if($walkUdRed2) echo 'checked="1"'; ?>/> </td>
        </tr>
        <tr>
          <td>3</td>
          <td> <input type="checkbox" name="straightGreen3"  value="1" <?php  if($straightGreen3) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="straightYellow3" value="1" <?php  if($straightYellow3) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="straightRed3"    value="1" <?php  if($straightRed3) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="leftGreen3"      value="1" <?php  if($leftGreen3) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="leftYellow3"     value="1" <?php  if($leftYellow3) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="leftRed3"        value="1" <?php  if($leftRed3) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="rightGreen3"     value="1" <?php  if($rightGreen3) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="rightYellow3"    value="1" <?php  if($rightYellow3) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="rightRed3"       value="1" <?php  if($rightRed3) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkLrGreen3"    value="1" <?php  if($walkLrGreen3) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkLrRed3"      value="1" <?php  if($walkLrRed3) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkUdGreen3"    value="1" <?php  if($walkUdGreen3) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkUdRed3"      value="1" <?php  if($walkUdRed3) echo 'checked="1"'; ?>/> </td>
        </tr>
        <tr>
          <td>4</td>
          <td> <input type="checkbox" name="straightGreen4"  value="1" <?php  if($straightGreen4) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="straightYellow4" value="1" <?php  if($straightYellow4) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="straightRed4"    value="1" <?php  if($straightRed4) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="leftGreen4"      value="1" <?php  if($leftGreen4) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="leftYellow4"     value="1" <?php  if($leftYellow4) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="leftRed4"        value="1" <?php  if($leftRed4) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="rightGreen4"     value="1" <?php  if($rightGreen4) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="rightYellow4"    value="1" <?php  if($rightYellow4) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="rightRed4"       value="1" <?php  if($rightRed4) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkLrGreen4"    value="1" <?php  if($walkLrGreen4) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkLrRed4"      value="1" <?php  if($walkLrRed4) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkUdGreen4"    value="1" <?php  if($walkUdGreen4) echo 'checked="1"'; ?>/> </td>
          <td> <input type="checkbox" name="walkUdRed4"      value="1" <?php  if($walkUdRed4) echo 'checked="1"'; ?>/> </td>
        </tr>
        <tr>
          <td colspan="4">Status ID:</td>
          <td colspan="6"><input type="text" name="statusId" value="<?php echo $statusId; ?>" /></td>
          <td colspan="4"><input type="submit" name="submit" value="Add status"/></td>
        </tr>
      </table>

      <input type="hidden" name="userU" value="<?php echo $userU; ?>" />
      <input type="hidden" name="passU" value="<?php echo $passU; ?>" />
    </form>

  </body>
</html>
