<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","OSUNAME-db","PASSWORD","OSUNAME-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

	
if(!($stmt = $mysqli->prepare("INSERT INTO workout_exercise(w_id, e_id) VALUES (?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ii",$_POST['wName'],$_POST['eName']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to workout_exercise.";
}
?>

<!--
CREATE TABLE `workout_exercise` (
`w_id` int(11) NOT NULL,
`e_id` int(11) NOT NULL,
PRIMARY KEY(`w_id`,`e_id`),
FOREIGN KEY (`w_id`) REFERENCES `workout` (`id`),
FOREIGN KEY (`e_id`) REFERENCES `exercise` (`id`)
)ENGINE=InnoDB;
-->