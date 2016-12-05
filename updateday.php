<!-- This page recieves a POST call from index.php and then makes a query updating the -->
<!-- entry for a date selected by a user. They can then update the day of the week the day-->
<!-- records any workouts happening, if they have been added. a prompt will inform the user -->
<!-- that a row has been update if it is successful -->

<!-- PHP template from provided lecture files -->
<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","OSUNAME-db","PASSWORD","OSUNAME-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}




if(!($stmt = $mysqli->prepare("UPDATE day SET day_of_week=? WHERE id=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("si",$_POST['dayWeek'],$_POST['eDate']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
	echo "Updated " . $stmt->affected_rows . " rows in day.";
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
