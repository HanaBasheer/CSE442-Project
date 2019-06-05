<!DOCTYPE html>
<html>
<body>
<?php


$email = $_POST["address"]; //takes the email given to the server via HTTP POST request
echo "A confirmation has been sent to $email<br>";
/* Below example taken from
*https://www.w3schools.com/php/filter_validate_email.asp
*/

// Remove all illegal characters from email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

$random_code = mt_rand(100000, 999999); // Example from https://www.expertsphp.com

// Validate e-mail
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo("$email is a valid email address");
} else {
    echo("$email is not a valid email address");
}
mail($email, "Confirmation", "Your Confirmation code is : $random_code");//calls mail() function to send along to the given email --Zack
	?>
</body>
</html>
