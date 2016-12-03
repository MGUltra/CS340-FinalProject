<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","OSUNAME-db","PASSWORD","OSUNAME-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div>
	<table>
		<tr>
			<td>Exercise</td>
		</tr>
		<tr>
			<td>Name</td>
			<td>Type</td>
			<td>Resistance (if cardio)</td>
			<td>push/pull (if strength)</td>
			<td>Compound/Isolation</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT exercise_name, exercise_type, resistance, push_pull, compound_isolation FROM exercise"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($exercise_name, $exercise_type, $resistance, $push_pull, $compound_isolation)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $exercise_name . "\n</td>\n<td>\n" . $exercise_type . "\n</td>\n<td>\n" . $resistance . "\n</td>\n<td>\n" . $push_pull . "\n</td>\n<td>\n" . $compound_isolation . "\n</td>\n</tr>";
}
$stmt->close();
?>		
	</table>	
</div>
</br></br>
<div>
	<table>
		<tr>
			<td>Exercise/muscle groups</td>
		</tr>
		<tr>
			<td>Exercise ID</td>
			<td>Muscle Group ID</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT e_id, mg_id FROM exercise_muscle_groups"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($e, $mg)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $e . "\n</td>\n<td>\n" . $mg . "\n</td>\n</tr>";
}
$stmt->close();
?>		
	</table>	
</div>

</br></br>
<div>
	<table>
		<tr>
			<td>Muscle groups</td>
		</tr>
		<tr>
			<td>group name</td>
			<td>included muscles</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT group_name, included_muscles FROM muscle_groups"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($gn, $im)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $gn . "\n</td>\n<td>\n" . $im . "\n</td>\n</tr>";
}
$stmt->close();
?>		
	</table>	
</div>




</body>
</html>