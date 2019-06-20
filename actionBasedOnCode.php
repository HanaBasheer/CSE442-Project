<!DOCTYPE html>
<html>
<body>
<?php
include"database.php";


if(!empty($_POST["code"])) {
  $code = $_POST["code"];
}

$code=preg_replace('/\s+/', '', $code);

#$code = $_POST["code"];
#$return_function = checkCode($code); //print statement for testing --ztperini
#echo $return_function;


if(checkCode($code) == 0) {
   header("refresh:0; url=invalidCode.html");
}

else {
    header("refresh:0; url=evalForm.php"); // modified
}

?>

</body>
</html>
