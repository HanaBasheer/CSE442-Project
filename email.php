<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="styles/email.css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Serif+SC&display=swap" rel="stylesheet">
</head>

<body>

  <div class="top-strip">

    <img class="ub-logo" src="http://www.buffalo.edu/content/www/brand/identity/university-logo-and-marks/_jcr_content/par/image_10.img.447.auto.png/1460126233828.png" alt="UB-Logo">

  </div>

  <div class="code-sent">

<?php

include"database.php";
include "emailFuncs.php";

$random_code = generateCode();

if(!empty($_POST["address"])) {
  $email = $_POST["address"]; //takes the email given to the server via HTTP POST request
  
  if (checkEmail($email) == FALSE){
	  
	  header("refresh:0; url=invalidEmail.html");
  }
  storeAndEmailCode($random_code, $email); 
}


/* Below example taken from
*https://www.w3schools.com/php/filter_validate_email.asp
*/

// Remove all illegal characters from email
//calls mail() function to send along to the given email --Zack


	?>
  </div>

  <div class="enter-code">
    <form action ="actionBasedOnCode.php" method = "post"> 

    Enter Code: <input type="text" name="code">
    <input type = "submit" value = "Submit">
    </form>

<br><br>
<a href="index.html">Click here to return to email entry!</a>

  </div>

</body>
</html>
