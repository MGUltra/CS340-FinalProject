
<!-- PHP template from provided lecture files -->
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

<!-- This page recieves a POST call from index.php and then makes a query and builds a table -->
<!-- Showing all the exercises that target a specific muscle group. The idea is that this query-->
<!-- can be used in conjunction with the query displaying all muscle groups worked out on a day -->
<!-- to help fill any gaps in a workout -->

<div>
	<table>
		<tr>
			<td>Exercises targeting selected Muscle Group</td>
		</tr>
		<tr>
			<td>Exercise Name</td>
			<td>Exercise Type</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT exercise_name, exercise_type FROM exercise e INNER JOIN exercise_muscle_groups emg ON emg.e_id = e.id INNER JOIN muscle_groups mg ON mg.id = emg.mg_id WHERE mg.id=?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['mgroupID']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($eName, $eType)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $eName . "\n</td>\n<td>\n" . $eType . "\n</td>\n</tr>";
}
$stmt->close();
?>
		</table>	
</div>

<!-- Link Back home -->
</br></br>
<a href="http://web.engr.oregonstate.edu/~garnemat/test/index.php">Back</a>




</body>
</html>	
		
		
		
		
		
		
		
		
		
		
		
		
		