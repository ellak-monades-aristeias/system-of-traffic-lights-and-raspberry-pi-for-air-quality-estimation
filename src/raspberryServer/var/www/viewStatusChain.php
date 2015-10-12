<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Status chain configuration</title>
  </head>
  <body>

    <?php
      include_once 'config.php';
      $userU = NULL;
      $passU = NULL;
      //Check if the user name and password have been set.
      if (isset($_POST["userU"]) && isset($_POST["passU"]) ) {
        $userU  = $_POST["userU"];
        $passU  = $_POST["passU"];
      } else if (isset($_GET["userU"]) && isset($_GET["passU"]) ) {
        $userU  = $_GET["userU"];
        $passU  = $_GET["passU"];
      }
      if ($userU!=NULL && $passU!=NULL) {
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
        <form method="POST" action="viewStatusChain.php">
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
    ?>

    <form method="POST" action="statusConfiguration.php">
      <input type="hidden" name="userU" value="<?php echo $userU; ?>" />
      <input type="hidden" name="passU" value="<?php echo $passU; ?>" />
      <input type="submit" name="submit" value="Go back"/>
    </form>

    <?php
      //Check if we must delete a statusChain record.
      if (isset($_GET["delete"]) && $_GET["delete"]=="true" && isset($_GET["statusIdNow"])) {
        $statusIdNow =    $_GET["statusIdNow"];
        
        try {
          $db = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "DELETE FROM `statusChain` WHERE `statusIdNow`=:statusIdNow";
          $stmt = $db->prepare($sql);
          $stmt->bindParam(':statusIdNow',    $statusIdNow);
          $stmt->execute();
        } catch (PDOException $e) {
          echo 'Error in sql: ' . $e->getMessage();
        }
        //Close connection.
        $dbh = null;
      }
    ?>

    <?php
      //Check if the a new status chain is provided.
      $statusIdNow  = NULL;
      $statusIdNext = NULL;
      if (isset($_POST['statusIdNow']) && isset($_POST['statusIdNext'])) {
        $statusIdNow  = $_POST['statusIdNow'];
        $statusIdNext = $_POST['statusIdNext'];

        try {
          $db = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
          $sql = "INSERT INTO `statusChain`(`statusIdNow`, `statusIdNext`) "
          ."VALUES (:statusIdNow, :statusIdNext)";
          $stmt = $db->prepare($sql);
          $stmt->bindParam(':statusIdNow',  $statusIdNow);
          $stmt->bindParam(':statusIdNext', $statusIdNext);
          $stmt->execute();
          $statusIdNow  = NULL;
          $statusIdNext = NULL;
        } catch (PDOException $e) {
          echo 'Error in sql: ' . $e->getMessage();
        }
        //Close connection.
        $dbh = null;
      }
    ?>

    <form method="POST" action="viewStatusChain.php">
      <table border="1">
        <tr>
          <td>StatusId Now: </td>
          <td><input type="text" name="statusIdNow" value="<?php echo $statusIdNow; ?>" /></td>
        </tr>
        <tr>
          <td>StatusId Next: </td>
          <td><input type="text" name="statusIdNext" value="<?php echo $statusIdNext; ?>" /></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="submit" value="Add Status Chain"/></td>
        </tr>
      </table>
      <input type="hidden" name="userU" value="<?php echo $userU; ?>" />
      <input type="hidden" name="passU" value="<?php echo $passU; ?>" />
    </form>

    <h2>Status Chain</h2>

    <table border="1">
      <tr>
        <td>StatusID Now</td>
        <td>StatusID Next</td>
        <td></td>
      </tr>
      <?php
        //Show previous status chains.

        try {
          $db = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "SELECT `statusIdNow`, `statusIdNext` FROM `statusChain` ORDER BY `statusIdNow`;";
          $stmt = $db->prepare($sql);
          $stmt->execute();

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $statusIdNow  = $row['statusIdNow'];
            $statusIdNext = $row['statusIdNext'];

            echo "<tr>";
            echo "<td>$statusIdNow</td>";
            echo "<td>$statusIdNext</td>";
            echo "<td><a href='viewStatusChain.php?userU=$userU&passU=$passU&delete=true&statusIdNow=$statusIdNow'> Delete </a></td>";
            echo "</tr>";
          }
        } catch (PDOException $e) {
          echo 'Error in sql: ' . $e->getMessage();
        }
        //Close connection.
        $dbh = null;
      ?>
    </table>

  </body>
</html>
