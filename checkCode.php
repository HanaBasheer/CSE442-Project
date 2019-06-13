<!DOCTYPE html>
<html>
<body>
<?php
include"database.php";


if(!empty($_POST["code"])) {
  $code = $_POST["code"];
}

#$code = $_POST["code"];
#$return_function = checkCode($code); //print statement for testing --ztperini
#echo $return_function;


if(checkCode($code) == 1) {
   #header("Location: evalForm.php");
   header("refresh:1; url=evalForm.php");
}

else {
   header("refresh:1; url=email.php");
}

?>

</body>
</html>