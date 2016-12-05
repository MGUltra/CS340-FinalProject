<!-- This page recieves a POST call from index.php and then makes a query adding the user -->
<!-- selected workout to the workout table. There is a prompt if this happenssuccessfully. A -->
<!-- second Query inserts a row into the relationship table workout_exercise targeting the -->
<!-- newly created workout as well as the exercise chosen by the user-->

<!-- PHP template from provided lecture files -->
<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","OSUNAME-db","PASSWORD","OSUNAME-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

// insert into workout	
if(!($stmt = $mysqli->prepare("INSERT INTO workout(did, name, total_time_in_min, time_of_day) VALUES (?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("isis",$_POST['eDate'],$_POST['wName'],$_POST['toTime'],$_POST['tDay']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to workout.";
}

// insert into workout_exercise	
if(!($stmt = $mysqli->prepare("INSERT INTO workout_exercise(w_id, e_id) VALUES ((SELECT id FROM workout WHERE name=?),?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("si",$_POST['wName'],$_POST['exID']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "</br>Added " . $stmt->affected_rows . " rows to workout_exercise.";
}

?>

<!-- Link Back home -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
</br></br>
<a href="http://web.engr.oregonstate.edu/~garnemat/test/index.php">Back</a>
</body>
</html>