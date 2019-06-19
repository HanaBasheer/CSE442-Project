<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/emailStyle.css">
</head>

<body>
<?php

include"database.php";

#$email = $_POST["address"]; //takes the email given to the server via HTTP POST request

if(!empty($_POST["address"])) {
  $email = $_POST["address"];
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);

  $random_code = mt_rand(100000, 9999999999); // Example from https://www.expertsphp.com

  // Validate e-mail
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("A confirmation code has been sent to $email<br>");
	$return_bool = storeCode($random_code, $email);
    }
	else 
	  {
	  echo '<div style="font-size:1.25em;color:red;">email is not a valid email address, try again...<br> </div>';
	  header("refresh:1; url=index.html");
      }
    mail($email, "Confirmation", "Your Confirmation code is : $random_code");
}


/* Below example taken from
*https://www.w3schools.com/php/filter_validate_email.asp
*/

// Remove all illegal characters from email
//calls mail() function to send along to the given email --Zack


	?>
<form action ="checkCode.php" method = "post"> 

Enter Code: <input type="text" name="code"><br>
<input type = "submit" value = "Submit">
</form>

<br><br>
<a href="index.html">Click here to return to email entry!</a>

</body>
</html>
