<?php
//access to database
//information from https://www.php.net/manual/en/mysqli.examples-basic.php

$server = "tethys.cse.buffalo.edu";
$user = "orionpal";
$password = "50150490";
$database = "cse442_542_2019_summer_teamc_db";


//Stores a generated code with a paired email to an appropriate table on the class database, will not add duplicate codes
function storeCode(&$code, &$email){
	$strcode = "$code";
	//connect to database
	$mainDB = new mysqli($GLOBALS["server"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
	
	if ($mainDB->connect_error){
		echo "Error with storeCode: " . $mainDB->connect_error . "\n";
		$mainDB->close();
		return FALSE;
	}/*else{
		echo "Connected to " . $GLOBALS['database'] . " successfully!\n";
	}*/
	
	$timestamp = date("Y-m-d H:i:s");
	$insert = $mainDB->prepare("INSERT IGNORE INTO Codes (code, email, tstamp) VALUES (?, ?, ?)");
	$insert->bind_param("sss", $strcode, $email, $timestamp);
	
	if (!$insert->execute()){
		echo "Something went wrong with inserting";
		$mainDB->close();
		return FALSE;
	}else{
		//echo "Successfully stored $code $email at $timestamp";
	}
	$mainDB->close();
	return TRUE;

}
//Checks that a code is in the table that stores codes and that that code has been submitted within 15minutes of generation
function checkCode(&$code){
	$mainDB = new mysqli($GLOBALS["server"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);

	if ($mainDB->connect_error){
		echo "Error with checkCode: " . $mainDB->connect_error . "\n";
		$mainDB->close();
		return FALSE;
	}

	$timestamp = date("Y-m-d H:i:s");
	$find = $mainDB->prepare("SELECT email FROM Codes WHERE code = ? and TIMESTAMPDIFF(MINUTE, tstamp, ?)<15");
	$find->bind_param("ss", $code, $timestamp);

	if (!$find->execute()){
		echo "Something went wrong with finding emails";
		$mainDB->close();
		return FALSE;
	}

	$find->store_result();

	if ($find->num_rows == 0){
		echo '<div style="font-size:1.25em;">Please enter a valid code...<br> </div>';
		$mainDB->close();
		return FALSE;
	}else{
		$find->bind_result($email);
		$find->fetch();
		//echo "The email matching this code is " . $email['email'];
		$mainDB->close();
		return TRUE;	//should change back to $email return 
	}
	
}

//Checks that an email is in the table that stores all students in the class, returns false if no student
function checkEmail(&$email){
	$mainDB = new mysqli($GLOBALS["server"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
	if ($mainDB->connect_error){
		echo "Error with checkingEmail: " . $mainDB->connect_error . "\n";
		$mainDB->close();
		return FALSE;
	}
	$mainDB->close();

	return "checkEmail reads $email";
}

//returns list of Teammate emails based on another email
function getTeammates(&$email){
	$mainDB = new mysqli($GLOBALS["server"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);

	if ($mainDB->connect_error){
		echo "Error with checkCode: " . $mainDB->connect_error . "\n";
		$mainDB->close();
		return FALSE;
	}
	//find the team associated with this email
	$getTeam = $mainDB->prepare("SELECT Team FROM Students WHERE Email = ?");
	$getTeam->bind_param("s", $email);
	if (!$getTeam->execute()){
		echo "Something went wrong with getting team name";
		$mainDB->close();
		return FALSE;
	}
	$getTeam->store_result();
	if ($getTeam->num_rows==0){
		//this student is not part of a Team or isn't in the class
		$mainDB->close();
		return FALSE;
	}else{
		$getTeam->bind_result($team);
		$getTeam->fetch();
		//echo "$team";
	}
	$getTeam->free_result();
	$getTeam->close();

	//get teammates emails associated with previously found team
	$getMates = $mainDB->prepare("SELECT Email FROM Students WHERE Team = ? and Email != ?");
	$getMates->bind_param("ss", $team, $email);
	if (!$getMates->execute()){
		echo "Something went wrong with checking form data";
		$mainDB->close();
		return FALSE;
	}
	$getMates->store_result();
	$getMates->bind_result($mate);
	$results = array();
	while ($getMates->fetch()){
		array_push($results, $mate);
	}
	return $results;
}

//Storing Form Data
function storeFormData(&$email, &$peer, &$team, &$role, &$lead, &$par, &$prof, &$qual){	
	$mainDB = new mysqli($GLOBALS["server"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);

	if ($mainDB->connect_error){
		echo "Error with checkCode: " . $mainDB->connect_error . "\n";
		$mainDB->close();
		return FALSE;
	}
	//check if there is already form data, if there is then update
	$check = $mainDB->prepare("SELECT * FROM Forms WHERE Owner = ? AND Peer = ? AND Team = ?");
	$check->bind_param("sss", $email, $peer, $team);

	if (!$check->execute()){
		echo "Something went wrong with checking form data";
		$mainDB->close();
		return FALSE;
	}

	$check->store_result();
	//if something was found then update that row and return true
	if ($check->num_rows != 0){
		$update = $mainDB->prepare("UPDATE Forms SET Role = ?, Leadership = ?, Participation = ?, Professionalism = ?, Quality = ? WHERE Owner = ? AND Peer = ? AND Team = ?");
		$update->bind_param("iiiiisss", $role, $lead, $par, $prof, $qual, $email, $peer, $team);
		if (!$update->execute()){
			echo "Something went wrong with updating form data";
			$mainDB->close();
			return FALSE;		
		}
		$mainDB->close();
		return TRUE;
	}
	$check->free_result();
	$check->close();

	//otherwise just store the new data
	$store = $mainDB->prepare("INSERT INTO Forms (Owner, Peer, Team, Role, Leadership, Participation, Professionalism, Quality) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	$store->bind_param("sssiiiii", $email, $peer, $team, $role, $lead, $par, $prof, $qual);

	if (!$store->execute()){
		echo "Something went wrong with storing form data";
		$mainDB->close();
		return FALSE;
	}

	$mainDB->close();
	return TRUE;
}

//returns list of the score for each form category (with structure: [Role, Leadership, Participation, Professionalism, Quality])
function getFormData(&$email, &$peer, &$team){
	$mainDB = new mysqli($GLOBALS["server"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);

	if ($mainDB->connect_error){
		echo "Error with checkCode: " . $mainDB->connect_error . "\n";
		$mainDB->close();
		return FALSE;
	}
	$get = $mainDB->prepare("SELECT * FROM Forms WHERE Owner = ? AND Peer = ? AND Team = ?");
	$get->bind_param("sss", $email, $peer, $team);

	if (!$get->execute()){
		echo "Something went wrong with getting form data";
		$mainDB->close();
		return FALSE;
	}

	$get->store_result();

	if ($get->num_rows==0){
		$mainDB->close();
		return FALSE;
	}else{
		$get->bind_result($o, $p, $t, $c1, $c2, $c3, $c4, $c5);
		$get->fetch();
		//echo "The results for $email and $peer of team $team are $c1  $c2  $c3  $c4  $c5";
		$mainDB->close();
		$result = array($c1, $c2, $c3, $c4, $c5);
		return $result;	//should change back to $email return 
	}
}
?>