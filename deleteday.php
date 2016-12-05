<!-- This page recieves a POST call from index.php and then makes a query deleting a row -->
<!-- in the day table corresponding to the date chosen by the user. This deletion will-->
<!-- cascade to workout and workout_exercise, removing all entries from that days workouts -->
<!-- a prompt will inform the user of the deletion of a row from day if it is successful -->


<!-- PHP template from provided lecture files -->
<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","OSUNAME-db","PASSWORD","OSUNAME-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

	
if(!($stmt = $mysqli->prepare("DELETE FROM day Where id=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("i",$_POST['dayId']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Deleted " . $stmt->affected_rows . " row from day.";
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
