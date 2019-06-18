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
   header("refresh:0; url=evalForm.html"); // modified
}

else {
   header("refresh:0; url=invalidCode.html");
}

?>

</body>
</html>
