<!DOCTYPE html>
<html>
<body>
<?php
echo "test email";
/*
//form validation attempt-->DID NOT WORK YET Zack
//Code here mostly taken from https://www.w2schools.com/php/php_form_validation.asp"
$email = "";
if ($_SERVER['REQUEST_METHOD']== 'POST'){
	$email = input_validation($_POST)["address"];
}
echo "email";
function input_validation($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
echo $data;*/

$email = $_POST["address"]; //takes the email given to the server via HTTP POST request

mail($email, "Confirmation", "Your Confirmation code is : X9h7J4");//calls mail() function to send along to the given email --Zack
	?>
</body>
</html>
