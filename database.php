<?php
//access to class database
//$classDB->query([some query])
$classDB = new mysqli("tethys.cse.buffalo.edu",
	"orionpal@cheshire.cse.buffalo.edu",
	"50150490",
	"cse442_542_2019_summer_teamc_db")


//Stores a generated code with a paired email to an appropriate table on the class database
function storeCode(&$code, &$email){
	return "storeCode works with $email and $code"
}
//Checks that an email is in the table that stores all students in the class
function checkEmail(&$email){
	return "checkEmail works with $email"
}
//Checks that a code is in the table that stores codes and that that code has been submitted within 15minutes of generation
function checkCode(&$code){
	return "checkCode works with $code"
}


?>