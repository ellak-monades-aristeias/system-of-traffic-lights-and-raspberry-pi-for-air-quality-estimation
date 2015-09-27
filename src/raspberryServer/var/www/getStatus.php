<?php
  include_once 'config.php';
  try {
    $db = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//The currne tstatis is on the statusNow table.
	$sql = "SELECT "
	     . "`straightGreen1`, `straightYellow1`, `straightRed1`, `leftGreen1`, `leftYellow1`, `leftRed1`, `rightGreen1`, `rightYellow1`, `rightRed1`, `walkLrGreen1`, `walkLrRed1`, `walkUdGreen1`, `walkUdRed1`, "
	     . "`straightGreen2`, `straightYellow2`, `straightRed2`, `leftGreen2`, `leftYellow2`, `leftRed2`, `rightGreen2`, `rightYellow2`, `rightRed2`, `walkLrGreen2`, `walkLrRed2`, `walkUdGreen2`, `walkUdRed2`, "
	     . "`straightGreen3`, `straightYellow3`, `straightRed3`, `leftGreen3`, `leftYellow3`, `leftRed3`, `rightGreen3`, `rightYellow3`, `rightRed3`, `walkLrGreen3`, `walkLrRed3`, `walkUdGreen3`, `walkUdRed3`, "
	     . "`straightGreen4`, `straightYellow4`, `straightRed4`, `leftGreen4`, `leftYellow4`, `leftRed4`, `rightGreen4`, `rightYellow4`, `rightRed4`, `walkLrGreen4`, `walkLrRed4`, `walkUdGreen4`, `walkUdRed3` "
	     . "FROM `status`, `statusNow` "
	     . "WHERE `statusIdNow`=`id`";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($row) {
		//Send the status as a json stirng.
		echo json_encode($row);
	}
  } catch (PDOException $e) {
    echo 'Error in sql: ' . $e->getMessage();
  }
  //Close connection.
  $dbh = null;
?>