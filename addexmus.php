<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","OSUNAME-db","PASSWORD","OSUNAME-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

	if(!($stmt = $mysqli->prepare("INSERT INTO exercise_muscle_groups(e_id, mg_id) VALUES (?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ii",$_POST['exMus'],$_POST['musEx']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to exercise_muscle_groups.";
}
?>

<!--
CREATE TABLE `exercise_muscle_groups` (
`e_id` int(11) NOT NULL,
`mg_id` int(11) NOT NULL,
PRIMARY KEY(`e_id`,`mg_id`),
FOREIGN KEY (`e_id`) REFERENCES `exercise` (`id`),
FOREIGN KEY (`mg_id`) REFERENCES `muscle_groups` (`id`)

)ENGINE=InnoDB
-->