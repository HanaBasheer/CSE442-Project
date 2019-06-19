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
/*
$testemail = "orionpal@buffalo.edu";
$testcode = 1234;
$falsecode = 4321;
storeCode($testcode, $testemail);
checkCode($testcode);
checkCode($falsecode);
*/
?>