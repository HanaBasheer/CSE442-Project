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

//Checks that an email is in the table that stores all students in the class
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
		return TRUE;
	}


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

function getFormData(&$email, &$peer, &$team){
	return FALSE;
}
//storeCode and checkCode tests
/*
$testemail = "orionpal@buffalo.edu";
$testcode = 1234;
$falsecode = 4321;
storeCode($testcode, $testemail);
checkCode($testcode);
checkCode($falsecode);
*/
//storeForm tests
/*
$testemail = "orionpal@buffalo.edu";
$testpeer = "hanab@buffalo.edu";
$testteam = "c";
$trole = 3;
$tlead = 3;
$tpar = 3;
$tprof = 3;
$tqual = 3;
storeFormData($testemail, $testpeer, $testteam, $trole, $tlead, $tpar, $tprof, $tqual);
$trole = 2;
$tlead = 2;
$tpar = 2;
$tprof = 2;
$tqual = 2;
storeFormData($testemail, $testpeer, $testteam, $trole, $tlead, $tpar, $tprof, $tqual);
*/
?>