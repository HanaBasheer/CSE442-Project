<?php
//access to database
//information from https://www.php.net/manual/en/mysqli.examples-basic.php

$server = "tethys.cse.buffalo.edu";
$user = "orionpal";
$password = "50150490";
$database = "cse442_542_2019_summer_teamc_db";


//Stores a generated code with a paired email to an appropriate table on the class database, will not add duplicate codes
function storeCode(&$code, &$email){
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
	$insert = "INSERT IGNORE INTO Codes (code, email, tstamp) VALUES ('" . $code . "', '" . $email . "', '" . $timestamp . "');";
	//echo $insert;
	if (!$result = $mainDB->query($insert)){
		echo "Something went wrong with inserting";
		$mainDB->close();
		return FALSE;
	}/*else{
		echo "yay";
	}*/
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
	$find = "SELECT email FROM Codes WHERE code='$code' and TIMESTAMPDIFF(MINUTE, tstamp, '$timestamp')<15";

	if (!$result = $mainDB->query($find)){
		echo "Something went wrong with finding emails";
		$mainDB->close();
		return FALSE;
	}
	if ($result->num_rows === 0){
		echo "This is not a valid code";
		$mainDB->close();
		return FALSE;
	}else{
		$email = $result->fetch_assoc();
		echo "The email matching this code is " . $email['email'];
		

		$mainDB->close();
		return $email;	
	}
	
}
/*
$testemail = "mickledickle@buffalo.eddy";
$testcode = 1234;
$falsecode = 2352435;
storeCode($testcode, $testemail);
checkCode($testcode);
checkCode($falsecode);
*/
?>