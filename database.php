<?php
//access to database
//information from https://www.php.net/manual/en/mysqli.examples-basic.php

$server = "tethys.cse.buffalo.edu";
$user = "orionpal";
$password = "50150490";
$database = "cse442_542_2019_summer_teamc_db";


//Stores a generated code with a paired email to an appropriate table on the class database
function storeCode(&$code, &$email){
	//connect to database
	$mainDB = new mysqli($GLOBALS["server"],$GLOBALS["user"],$GLOBALS["password"],$GLOBALS["database"]);
	
	if ($mainDB->connect_error){
		echo "Error: " . $mainDB->connect_error . "\n";
		exit;
	}else{
		echo "Connected to $database successfully!";
	}
	/*
	$insert = "INSERT INTO `$database`.`Codes` (`code`, `email`) VALUES ('$code', '$email');";
	echo $insert;

*/
}
//Checks that an email is in the table that stores all students in the class
function checkEmail(&$email){
	return "checkEmail works with $email";
}
//Checks that a code is in the table that stores codes and that that code has been submitted within 15minutes of generation
function checkCode(&$code){

	return "checkCode works with $code";
}

$testemail = "mickledickle@buffalo.eddy";
$testcode = 1234;
storeCode($testcode, $testemail);

?>