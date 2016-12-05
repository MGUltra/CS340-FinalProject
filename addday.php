<!-- This page recieves a POST call from index.php and then makes a query adding the user -->
<!-- selected date and day of the week to the day table. There is a prompt if this happens-->
<!-- successfully. -->

<!-- PHP template from provided lecture files -->
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


<!-- Link Back home -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
</br></br>
<a href="http://web.engr.oregonstate.edu/~garnemat/test/index.php">Back</a>
</body>
</html>
