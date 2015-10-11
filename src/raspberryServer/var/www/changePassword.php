<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Change Password</title>
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
        <a href='statusConfiguration.php'>Please, Login.</a>
    <?php
        echo '</body></html>';
        return;
      }
    ?>

    <?php
      //If here, the username and pass are correct.
      if (isset($_POST["passNew"]) ) {
        $passNew  = $_POST["passNew"];
        try {
          $db = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "UPDATE `users` SET `password`=:passNew WHERE `username`=:userU";
          $stmt = $db->prepare($sql);
          $stmt->bindParam(':userU',   $userU);
          $stmt->bindParam(':passNew', $passNew);
          $stmt->execute();
        } catch (PDOException $e) {
          echo 'Error in sql: ' . $e->getMessage();
        }
        //Close connection.
        $dbh = null;
    ?>
        <h3> Password Changed. <h3>
        <form method="POST" action="statusConfiguration.php">
          <input type="hidden" name="userU" value="<?php echo $userU; ?>" />
          <input type="hidden" name="passU" value="<?php echo $passNew; ?>" />
          <input type="submit" name="submit" value="Go to configuration page."/>
        </form>
    <?php
      } else {
    ?>
        <form method="POST" action="statusConfiguration.php">
          <input type="hidden" name="userU" value="<?php echo $userU; ?>" />
          <input type="hidden" name="passU" value="<?php echo $passU; ?>" />
          <input type="submit" name="submit" value="Go back"/>
        </form>
        
        <form method="POST" action="">
          <table>
            <tr> <td>New Password: </td> <td><input type="text" name="passNew" value="<?php echo $passU; ?>"></td> </tr>
            <tr> <td> <input type="submit" name="submit" value="Save"/> </td> <td></td></tr>
          </table>
          <input type="hidden" name="userU" value="<?php echo $userU; ?>" />
          <input type="hidden" name="passU" value="<?php echo $passU; ?>" />
        </form>
    <?php
      }
    ?>
  </body>
</html>
