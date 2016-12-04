<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","OSUNAME-db","PASSWORD","OSUNAME-db");
if(!$mysqli || $msqli->connect_errno){
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
			<td>Muscles targeted</td>
		</tr>
		<tr>
			<td>Muscle Groups</td>
			<td>Included Muscles</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT mg.group_name, mg.included_muscles FROM muscle_groups mg INNER JOIN exercise_muscle_groups emg ON emg.mg_id = mg.id INNER JOIN exercise e ON e.id=emg.e_id INNER JOIN workout_exercise we ON we.e_id = e.id INNER JOIN workout w ON w.id = we.w_id INNER JOIN day on day.id = w.did WHERE day.id = ? GROUP BY group_name"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['dayID']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($mGroup, $iMus)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $mGroup . "\n</td>\n<td>\n" . $iMus . "\n</td>\n</tr>";
}
$stmt->close();
?>
		</table>	
</div>


</br></br>
<a href="http://web.engr.oregonstate.edu/~garnemat/test/index.php">Back</a>




</body>
</html>	