<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","OSUNAME-db","PASSWORD","OSUNAME-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

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
?>



<!--
CREATE TABLE `exercise` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`exercise_name` varchar(255) NOT NULL,
`exercise_type` varchar(255) NOT NULL, -- cardio or weight training
`resistance` varchar(255),             -- yes/no for cardio resistance
`push_pull` varchar(255),              -- push or pull for weight training
`compound_isolation` varchar(255),     -- compound or isolation for weight training
PRIMARY KEY(`id`)

)ENGINE=InnoDB;
-->