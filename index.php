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

<!-- Adding a new Day into the day table -->
<div>
	<form method="post" action="addday.php"> 

		<fieldset>
			<legend>Add a new Workout Day</legend>
			
			<p>Date: <input type="date" name="theDate" /></p>
			
			<p>Day of the week:
			<select name="dayWeek">
				<option value="Sunday">Sunday</option>
				<option value="Monday">Monday</option>
				<option value="Tuesday">Tuesday</option>
				<option value="Wednesday">Wednesday</option>
				<option value="Thursday">Thursday</option>
				<option value="Friday">Friday</option>
				<option value="Saturday">Saturday</option>
			</select>
			</p>
			<p><input type="submit" /></p>
		</fieldset>
	</form>
	
</div>


<!-- Adding a new Workout into the workout table -->
<div>
	<form method="post" action="addworkout.php"> 

		<fieldset>
			<legend>Add a new Workout</legend>
			
			<p>Select Date:</p>
			<select name="eDate">
<?php			
if(!($stmt = $mysqli->prepare("SELECT id, exact_date FROM day"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $edate)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value="'. $id .'"> ' . $edate . '</option>\n';
}
$stmt->close();
?>
			
			</select>			
			

			<p>Workout Name(Ex."Leg Day"): <input type="text" name="wName" /></p>
			
			<p>Total length of workout in minutes: <input type="number" name="toTime" /></p>
			
			<p>Time of Day:
			<select name="tDay">
				<option value="Morning">Morning</option>
				<option value="Afternoon">Afternoon</option>
				<option value="Evening">Evening</option>
			</select>
			</p>
			<p><input type="submit" /></p>
		</fieldset>
	</form>
	
</div>

<!-- Adding a Workout/Exercise relationship into workout_exercise table -->
<div>
	<form method="post" action="addworkex.php"> 

		<fieldset>
			<legend>Add an exercise to a Workout</legend>
			
			<p>Select Workout by name</p>
			<select name="wName">
<?php			
if(!($stmt = $mysqli->prepare("SELECT id, name FROM workout"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $wname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $wname . '</option>\n';
}
$stmt->close();
?>

			</select>
			
			</br>
			
			<p>Select Exercise</p>
			<select name="eName">
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
			
			
			</p>
			<p><input type="submit" /></p>
		</fieldset>
	</form>
	
</div>


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





<!-- Displays -->







</body>
</html>