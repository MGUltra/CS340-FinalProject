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
<body>


<h2>Insertion Queries</h2>



<!-- Adding a new Day into the day table -->

<div>
	<form method="post" action="addday.php"> 

		<fieldset>
			<legend>Add a new Workout Day</legend>
			
			<!-- Select Date -->
			<p>Date: <input type="date" name="theDate" /></p>
			
			<!-- Select Day of the week -->
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
</br></br>



<!-- Adding a new Workout into the workout table -->

<div>
	<form method="post" action="addworkout.php"> 

		<fieldset>
			<legend>Add a new Workout</legend>
			
			<!-- Select Date from dropdown menu populated by query to day table -->
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
			
			<!-- Enter Workout Name -->
			<p>Workout name must be unique for each workout Ex: Leg Day 1, Leg Day 2, etc.</p>
			<p>Workout Name: <input type="text" name="wName" /></p>
			
			<!-- Enter Length in minutes of workout -->
			<p>Total length of workout in minutes: <input type="number" name="toTime" /></p>
			
			<!-- Select Time of Day -->
			<p>Time of Day:
			<select name="tDay">
				<option value="Morning">Morning</option>
				<option value="Afternoon">Afternoon</option>
				<option value="Evening">Evening</option>
			</select>
			</p>
			
			<!-- Select Exercise from dropdown menu populated from query to exercise table -->
			<p>Select Exercise to add</p>
			<select name="exID">
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
</br></br>




<!-- Adding a Workout/Exercise relationship into workout_exercise table -->

<div>
	<form method="post" action="addworkex.php"> 

		<fieldset>
			<legend>Add an exercise to a Workout</legend>
			
			<!-- Select workout by name from dropdown menu populated from query to workout table -->
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
			
			<!-- Select exercise by name from dropdown menu populated from query to exercise -->
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
</br></br>




<!-- Adding an Exercise into exercise table -->

<div>
	<form method="post" action="addexercise.php"> 

		<fieldset>
			<legend>Add a new Exercise</legend>
			
			<!-- Enter Exercise Name -->
			<p>Exercise Name: <input type="text" name="exerciseName" /></p>
			
			<!-- Select Exercise Type -->
			<p>Exercise Type:
			<select name="exerciseType">
				<option value="Cardio">Cardio</option>
				<option value="Strength">Strength</option>
			</select>
			</p>
			
			<!-- Select Resistance value -->			
			<p>Resistance on? (if Cardio):
			<select name="resistance">
				<option value="N/A">N/A</option>
				<option value="Yes">Yes</option>
				<option value="no">No</option>
			</select>
			</p>
			
			<!-- Select whether strength exercise is push or pull-->
			<p>Push or Pull? (if Strength):
			<select name="pushPull">
				<option value="N/A">N/A</option>
				<option value="Push">Push</option>
				<option value="Pull">Pull</option>
			</select>
			</p>
			
			<!-- Select whether strength exercise is push or pull-->
			<p>Compound or Isolation?:
			<select name="compoundIsolation">
				<option value="Compound">Compound</option>
				<option value="Isolation">Isolation</option>
			</select>
			</p>
			
			<!-- Select target muscle group from list populated by query to muscle-groups-->
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
		</br>
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
			
			<!-- Enter name of new Muscle Group -->
			<p>Muscle Group Name: <input type="text" name="groupName" /></p>
			
			<!-- Include a list of individual muscles in the group if you desire-->
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
			
			
			<!-- Select exercise by name from dropdown menu populated from query to exercise -->
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
			
			<!-- Select muscle group from list populated by query to muscle-groups-->
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
</br></br>




<h2>Delete Query</h2>


<!-- Delete a row from table day, cascades through workout and workout_exercise -->

<div>
	<form method="post" action="deleteday.php"> 

		<fieldset>
			<legend>Delete a workout</legend>

			<!-- Select date from list populated by query to day -->
			<p>Select Date:</p>
			<select name="dayId">
<?php			
if(!($stmt = $mysqli->prepare("SELECT id, exact_date FROM day"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $wdate)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value="'. $id .'"> ' . $wdate . '</option>\n';
}
$stmt->close();
?>
			
			</select>			
			</p>
			<p><input type="submit" /></p>
		</fieldset>
	</form>
</div>
</br></br>



<h2>Update Query</h2>


<!-- Update the day of the week n an existing row in the Day table -->

<div>
	<form method="post" action="updateday.php"> 

		<fieldset>
			<legend>Update the Day of the week in an Existing Day entry</legend>
			
			
			<!-- Select date from list populated by query to day -->
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
			</br>
			
			<!-- Select day of week as the update value -->
			<p>Select new Day of the week:
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
</br></br>



<h2>Selection Queries</h2>


<!-- Displays all muscle groups targeted on a specific date chosen by the user -->

<div>
	<form method="post" action="displaymusdate.php"> 

		<fieldset>
			<legend>Display Muscle Groups Targeted on a Specific Day</legend>
			
			
			<!-- Select date from list populated by query to day -->
			<p>Select Date</p>
			<select name="dayID">
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
		
			</p>
			<p><input type="submit" /></p>
		</fieldset>
	</form>
</div>
</br></br>



<!-- Displays all Exercises targeting on a specific Muscle Group chosen by the user -->
<div>
	<form method="post" action="displaymusex.php"> 

		<fieldset>
			<legend>Display Exercises that target a specific Muscle Group</legend>
			
			<!-- Select Muscle Group from list populated by query to muscle_groups -->
			<p>Select Muscle Group</p>
			<select name="mgroupID">
<?php			
if(!($stmt = $mysqli->prepare("SELECT id, group_name FROM muscle_groups"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $gName)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value="'. $id .'"> ' . $gName . '</option>\n';
}
$stmt->close();
?>
			
			</select>			
		
			</p>
			<p><input type="submit" /></p>
		</fieldset>
	</form>
</div>
</br></br>





<!-- This page displays the result of a select query to all tables to show current state of all of them  -->
<a href="http://web.engr.oregonstate.edu/~garnemat/test/testtable.php">Click for current state of all Tables</a>
</br></br>

</body>
</html>