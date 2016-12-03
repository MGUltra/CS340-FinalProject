<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","OSUNAME-db","PASSWORD","OSUNAME-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

	
if(!($stmt = $mysqli->prepare("INSERT INTO day(exact_date, day_of_week) VALUES (?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ss",$_POST['theDate'],$_POST['dayWeek']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Added " . $stmt->affected_rows . " rows to day.";
}
?>

<!--
CREATE TABLE `day` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`exact_date` date NOT NULL,
`day_of_week` varchar(255),
PRIMARY KEY (`id`),
UNIQUE KEY (`exact_date`)

)ENGINE=InnoDB;
-->