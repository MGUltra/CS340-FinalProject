<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","OSUNAME-db","PASSWORD","OSUNAME-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

	
if(!($stmt = $mysqli->prepare("INSERT INTO muscle_groups(group_name, included_muscles) VALUES (?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ss",$_POST['groupName'],$_POST['includedMuscles']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to muscle_groups.";
}
?>

<!--
CREATE TABLE `muscle_groups` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`group_name` varchar(255) NOT NULL,
`included_muscles` varchar(255),
PRIMARY KEY(`id`)

)ENGINE=InnoDB;
-->