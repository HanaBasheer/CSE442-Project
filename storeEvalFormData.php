<?php 

session_start();
include"database.php";

$email = $_SESSION['emailAddress'];
$class = $_SESSION['classChoice'];

#echo "<script type='text/javascript'>alert('User email address is: $email');</script>";

if(isset($_POST['teammates'])) {
    $teammates = $_POST['teammates'];
	#echo $teammates;
}

#echo "<script type='text/javascript'>alert('teammate is: $teammates');</script>";

if(isset($_POST['r1'])) {
    $r1 = $_POST['r1'];
	#echo $r1;
}
#echo "<script type='text/javascript'>alert('Role value is: $r1');</script>";

if(isset($_POST['r2'])) {
    $r2 = $_POST['r2'];
	#echo $r2;
}
#echo "<script type='text/javascript'>alert('Leadership value is: $r2');</script>";

if(isset($_POST['r3'])) {
    $r3 = $_POST['r3'];
	#echo $r3;
}

#echo "<script type='text/javascript'>alert('Participation value is: $r3');</script>";

if(isset($_POST['r4'])) {
    $r4 = $_POST['r4'];
	#echo $r4;
}

#echo "<script type='text/javascript'>alert('Professionalism value is: $r4');</script>";

if(isset($_POST['r5'])) {
    $r5 = $_POST['r5'];
	#echo $r5;
}

#echo "<script type='text/javascript'>alert('Quality value is: $r5');</script>";
#$email = "ztperini@buffalo.edu"; //testing sake, don't know how to pass this
	
#echo "<script type='text/javascript'>alert('Class Choice is: $class');</script>";

$peers = getTeammates($email, $class);

#echo "<script type='text/javascript'>alert('teammate 1 is $peers[0]');</script>";
#echo "<script type='text/javascript'>alert('teammate 2 is $peers[1]');</script>";

$team = getTeamName($email, $class);

/*
foreach ($peers as $peer) {
    echo "$peer\n";
}
*/


if ($teammates == "t1"){
	$tm = $peers[0];
}
else if ($teammates == "t2"){$tm = $peers[1];}

else if ($teammates == "t3"){$tm = $peers[2];}
else if ($teammates == "t4"){$tm = $peers[3];}


else {$tm = $peers[4];}

if ($tm == NULL){
	echo "<script type='text/javascript'>alert('No teammate selected. Returning to evaluation form');</script>";
	header("refresh:0; url = evalForm.php");
}
#echo "<script type='text/javascript'>alert('teammate name is: $tm');</script>";
if (storeFormData($email, $tm, $class,$team, $r1, $r2, $r3, $r4, $r5) == TRUE){ header("refresh:0; url = evalForm.php");}

else{
echo 'didnt work';}	





?>