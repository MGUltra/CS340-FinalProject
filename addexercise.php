<!-- This page recieves a POST call from index.php and then makes a query adding the user -->
<!-- selected exercise to the exercise table table. There is a prompt if this happens-->
<!-- successfully. A second Query inserts a row into the relationship table exercise_muscle_groups-->
<!-- targeting the newly created exercise as well as the muscle group chosen by the user-->


<!-- PHP template from provided lecture files -->
<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","OSUNAME-db","PASSWORD","OSUNAME-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

// insert into exercise	
if(!($stmt = $mysqli->prepare("INSERT INTO exercise(exercise_name, exercise_type, resistance, push_pull,compound_isolation) VALUES (?,?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("sssss",$_POST['exerciseName'],$_POST['exerciseType'],$_POST['resistance'],$_POST['pushPull'],$_POST['compoundIsolation']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to exercise.";
}

// insert into exercise_muscle_groups	
if(!($stmt = $mysqli->prepare("INSERT INTO exercise_muscle_groups(e_id, mg_id) VALUES ((SELECT id FROM exercise WHERE exercise_name=?),?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("si",$_POST['exerciseName'],$_POST['musEx']))){
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

