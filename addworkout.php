<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","OSUNAME-db","PASSWORD","OSUNAME-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

	
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
?>

<!--
CREATE TABLE `workout` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`did` int(11) NOT NULL,
`name` varchar(255) NOT NULL,
`total_time_in_min` int(11),
`time_of_day` varchar(255),
PRIMARY KEY (`id`),
FOREIGN KEY (`did`) REFERENCES `day` (`id`)
)ENGINE=InnoDB;
-->