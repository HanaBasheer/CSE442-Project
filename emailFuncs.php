<?php 


function generateCode(){
	$random_code = mt_rand(100000, 9999999999);
	$range = array_merge(range('A', 'Z'),range('a', 'z'));
	$index = array_rand($range, 1);
	$random_code = $random_code . $range[$index];
	return $random_code;
}


function storeAndEmailCode(&$random_code, $email){
	
	$message = "Your confirmation code is $random_code <br><a href='https://www-student.cse.buffalo.edu/CSE442-542/2019-Summer/cse-442c/Testing-Zack/email.php'>Click Here to Enter Confirmation Code!</a>";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("A confirmation code has been sent to $email<br>");
	$return_bool = storeCode($random_code, $email);
    }
	else 
	  {
	  echo '<div style="font-size:1.25em;color:red;">email is not a valid email address, try again...<br> </div>';
	  header("refresh:1; url=index.html");
      }
	  
	  mail($email, "Confirmation", $message, $headers);
}
	





?>