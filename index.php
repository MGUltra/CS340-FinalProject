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
<body>

<!-- Adding an Exercise into exercise table -->

<div>
	<form method="post" action="addexercise.php"> 

		<fieldset>
			<legend>Add a new Exercise</legend>
			
			<p>Exercise Name: <input type="text" name="exerciseName" /></p>
			
			<p>Exercise Type:
			<select name="exerciseType">
				<option value="Cardio">Cardio</option>
				<option value="Strength">Strength</option>
			</select>
			</p>
			
			<p>Resistance on? (if Cardio):
			<select name="resistance">
				<option value="N/A">N/A</option>
				<option value="Yes">Yes</option>
				<option value="no">No</option>
			</select>
			</p>
			
			<p>Push or Pull? (if Strength):
			<select name="pushPull">
				<option value="N/A">N/A</option>
				<option value="Push">Push</option>
				<option value="Pull">Pull</option>
			</select>
			</p>
			
			<p>Compound or Isolation?:
			<select name="compoundIsolation">
				<option value="Compound">Compound</option>
				<option value="Isolation">Isolation</option>
			</select>
			</p>			
		 <p><input type="submit" /></p>
	
		</fieldset>
	
	</form>
</div>

</br></br>


<!-- Adding a Muscle Group into into muscle_groups table -->
<div>
	<form method="post" action="addmuscle.php"> 

		<fieldset>
			<legend>Add a new Muscle Group</legend>
			
			<p>Muscle Group Name: <input type="text" name="groupName" /></p>
			
			<p>List Included Muscles: <input type="text" name="includedMuscles" /></p>
			

		 <p><input type="submit" /></p>
	
		</fieldset>
	
	</form>
</div>


</br></br>


<!-- Adding an exercise/ Muscle Group relationship into exercise_muscle_groups table -->

<div>
	<form method="post" action="addexmus.php"> 

		<fieldset>
			<legend>Connect a muscle group to an exercise that targets it</legend>
			
			<p>Select Exercise</p>
			<select name="exMus">
<?php			
if(!($stmt = $mysqli->prepare("SELECT id, exercise_name FROM exercise"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $ename)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $ename . '</option>\n';
}
$stmt->close();
?>
			
			</select>
			
			
			<p>Select Muscle Group Targeted</p>
			<select name="musEx">
<?php			
if(!($stmt = $mysqli->prepare("SELECT id, group_name FROM muscle_groups"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $mname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $mname . '</option>\n';
}
$stmt->close();
?>					
			</select>
			

		 <p><input type="submit" /></p>
	
		</fieldset>
	
	</form>
</div>









</body>
</html>