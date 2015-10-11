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
        <form method="POST" action="viewStatus.php">
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

  </body>
</html>
